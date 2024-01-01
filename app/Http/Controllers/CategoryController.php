<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoryCreateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('products')->get();
        return view('dashboard.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::check()) {
            // User is logged in, display the dashboard
            return view('dashboard.pages.category.create');
        } else {
            // User is not logged in, redirect to the login page 
            return redirect()->route('user.login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {
        $validated = $request->only(['name']);
        try {
            $category =  Category::create([
                'name' => $validated['name'],
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // if (Auth::check()) {
        //     $category = Category::findOrFail($id);
        //     return view('dashboard.pages.post.edit', compact('post'));
        // } else {
        //     return redirect()->route('user.login')->with('error', 'You need to log in to perform this action.');
        // }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // $validated = $request->only(['user', 'title', 'text', 'image']);

        // if (Auth::check()) {
        //     $post = Post::where('user', Auth::user()->id)->where('id', $id)->first();
        //     if (array_key_exists('image', $validated) && $post) {
        //         FileSystem::deleteFile($post['image']);
        //         $path = FileSystem::storeFile($validated['image'], 'post/image');
        //     }
        //     try {
        //         Post::where('user', Auth::user()->id)->where('id', $id)->update([
        //             'title' => $validated['title'],
        //             'text' => $validated['text'],
        //             'image' => array_key_exists('image', $validated) ? $path : $post['image'],
        //         ]);
        //         return redirect()->route('user.dashboard');
        //     } catch (Exception $e) {
        //         log::error($e);
        //     }
        // } else {
        //     return redirect()->route('user.login')->with('error', 'You need to log in to perform this action.');
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (Auth::check()) {
            $category->delete();
            return redirect()->route('category.index');
        } else {
            return redirect()->route('user.login')->with('error', 'You need to log in to perform this action.');
        }
    }
}
