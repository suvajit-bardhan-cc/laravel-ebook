<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\Category;
class AuthController
{
    /*
    // Show register form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
    */

    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // First check if user exists with these credentials
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $user = auth()->user();
            
            // Check if user is banned
            if ($user->status === 'banned') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account has been banned. Please contact support.',
                ]);
            }
            
            // Check if user is inactive
            if ($user->status === 'inactive') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account is inactive. Please contact support.',
                ]);
            }
            
            // Check if user is pending (email not verified or waiting for approval)
            if ($user->status === 'pending') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Your account is pending approval. You will be notified once approved.',
                ]);
            }
            
            // Only 'active' users can proceed
            if ($user->status !== 'active') {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Unable to login due to account status: ' . ucfirst($user->status),
                ]);
            }
            
            // Regenerate session for security
            $request->session()->regenerate();

            // Redirect based on user type
            if ($user->type === 1) {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('dashboard'));
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    // Dashboard
    // public function dashboard()
    // {
    //     $books = Book::with('categories')->paginate(12);
    
    //     $categories = Category::withCount('books')->get();
    
    //     return view('dashboard1', compact(
    //         'books',
    //         'categories'
    //     ));
    // }


    public function dashboard(Request $request)
    {
        $search = $request->search;

        $books = Book::with('categories')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author_name', 'like', "%{$search}%");
                });
            })
            ->paginate(12);

        $totalBooks = Book::count();

        $categories = Category::withCount('books')->get();

        $fictionCount = Category::where('name', 'like', '%Fiction%')
            ->withCount('books')
            ->first()?->books_count ?? 0;

        $classicsCount = Category::where('name', 'Classic')
            ->withCount('books')
            ->first()?->books_count ?? 0;

        $languageCount = Category::where('name', 'Language and Literature')
            ->withCount('books')
            ->first()?->books_count ?? 0;

        $warCount = Category::where('name', 'like','War')
            ->withCount('books')
            ->first()?->books_count ?? 0;

        $crimeCount = Category::where('name', 'like','Crime')
            ->withCount('books')
            ->first()?->books_count ?? 0;
        

        return view('dashboard1', compact(
            'books',
            'categories',
            'totalBooks',
            'fictionCount',
            'classicsCount',
            'languageCount',
            'warCount',
            'crimeCount'
        ));
    }


    // Bookmark
    public function bookmark()
    {
        return view('pages.bookmark');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

  






    
}