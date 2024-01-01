<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegistrationRequest;


class UserController extends Controller
{
    public function dashboard()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            return view('dashboard.pages.index');
        } else {
            return redirect()->route('user.login');
        }
    }
    public function index()
    {
        $products = Product::with('category')->get();

        return view('user.pages.index', compact('products'));
    }
    // user registration form
    public function create()
    {
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        } else {
            return view('user.pages.registration');
        }
    }

    public function show(User $user)
    {
        //
    }

    // user log in form
    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('user.dashboard');
        } else {
            return view('user.pages.login');
        }
    }
    // user create
    public function store(UserRegistrationRequest $request)
    {
        $validated = $request->only(['name', 'email', 'password']);

        try {
            $user =  User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);
        } catch (Exception $e) {
            Log::error($e);
        }
        return redirect()->route('user.login');
    }
    public function edit(User $user)
    {
        // if (Auth::check()) {
        //     $category = Category::findOrFail($id);
        //     return view('dashboard.pages.post.edit', compact('post'));
        // } else {
        //     return redirect()->route('user.login')->with('error', 'You need to log in to perform this action.');
        // }
    }

    public function update(Request $request, User $user)
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
    public function destroy(User $user)
    {
        // if (Auth::check()) {
        //     $category->delete();
        //     return redirect()->route('category.index');
        // } else {
        //     return redirect()->route('user.login')->with('error', 'You need to log in to perform this action.');
        // }
    }
    // user log in
    public function login(UserLoginRequest $request)
    {
        $validated = $request->only(['email', 'password']);

        if (Auth::attempt($validated)) {
            // Authentication was successful
            $user = Auth::user(); // Retrieve the authenticated user
            return redirect()->intended(route('user.dashboard'));
        } else {
            // Authentication failed
            return redirect()->route('user.login')->with('error', 'Invalid email or password');
        }
    }
    // user log out
    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
