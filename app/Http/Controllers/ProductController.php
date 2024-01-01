<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Events\ProductPurchased;
use App\Jobs\SendNewProductEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->limit(20)->get();
        return view('dashboard.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {

            $categories = Category::get();
            // User is logged in, display the dashboard
            return view('dashboard.pages.product.create', compact('categories'));
        } else {
            // User is not logged in, redirect to the login page 
            return redirect()->route('user.login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCreateRequest $request)
    {
        $validated = $request->only(['category_id', 'name', 'price', 'quantity']);
        try {
            $product =  Product::create([
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'price' => $validated['price'],
                'quantity' => $validated['quantity'],
            ]);
            SendNewProductEmail::dispatch(Auth::user());
        } catch (Exception $e) {
            Log::error($e);
        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product->load('category');
        if (Auth::check()) {
            $categories = Category::get();
            return view('dashboard.pages.product.edit', compact('product', 'categories'));
        } else {
            return redirect()->route('user.login')->with('error', 'You need to log in to perform this action.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        $product->category_id = $validated['category_id'];
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->quantity = $validated['quantity'];
        $product->update();
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (Auth::check()) {
            $product->delete();
            return redirect()->route('product.index');
        } else {
            return redirect()->route('user.login')->with('error', 'You need to log in to perform this action.');
        }
    }

    public function purchase(Product $product)
    {
        // Dispatch the ProductPurchased event
        event(new ProductPurchased($product));
        return redirect()->route('product.index');
    }

    public function importExportForm()
    {
        // return view('import-export');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        Excel::import(new ProductsImport, $request->file('file'));

        return redirect()->route('product.index')->with('success', 'Products imported successfully.');
    }

    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
}
