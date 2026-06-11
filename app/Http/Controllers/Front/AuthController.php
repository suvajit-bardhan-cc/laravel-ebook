<?php

namespace App\Http\Controllers\Front;

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

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}