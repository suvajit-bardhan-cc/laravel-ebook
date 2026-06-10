<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Models\Book;
use App\Models\Category;
use App\Models\Tag;

class AuthController
{
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

            // Check if user has permission to access admin dashboard
            // Using the new RBAC system
            if ($user->hasPermission('access-dashboard')) {
                return redirect()->intended(route('admin.dashboard'));
            }

            // Regular user dashboard
            return redirect()->intended(route('dashboard'));
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    // User Dashboard (Frontend)
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
            ->paginate(18);

        // $totalBooks = Book::where('status', 'active')->count();
        $categories = Category::where('status', 'active')->withCount('books')->get();

        // Get popular categories (top 6 by book count)
        $popularCategories = Category::where('status', 'active')
            ->withCount('books')
            ->orderByDesc('books_count')
            ->limit(5)
            ->get();

        $allTags = Tag::where('status', 'active')->get();

        // $fictionCount = Category::where('name', 'like', '%Fiction%')
        //     ->withCount('books')
        //     ->first()?->books_count ?? 0;

        // $classicsCount = Category::where('name', 'Classic')
        //     ->withCount('books')
        //     ->first()?->books_count ?? 0;

        // $languageCount = Category::where('name', 'Language and Literature')
        //     ->withCount('books')
        //     ->first()?->books_count ?? 0;

        // $warCount = Category::where('name', 'like','War')
        //     ->withCount('books')
        //     ->first()?->books_count ?? 0;

        // $crimeCount = Category::where('name', 'like','Crime')
        //     ->withCount('books')
        //     ->first()?->books_count ?? 0;

        return view('dashboard', compact(
            'books',
            'categories',
            // 'totalBooks',
            'popularCategories',
            'allTags',
            // 'fictionCount',
            // 'classicsCount',
            // 'languageCount',
            // 'warCount',
            // 'crimeCount'
        ));
    }

    // Bookmark page
    public function bookmark()
    {
        return view('pages.bookmark');
    }

    // Book details view
    public function show($id)
    {
        $bookId = Crypt::decrypt($id);
        $book = Book::with('categories')->findOrFail($bookId);

        return view('pages.bookview' , compact('book'));
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