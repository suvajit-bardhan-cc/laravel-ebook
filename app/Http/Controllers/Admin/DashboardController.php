<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class DashboardController
{
    public function dashboard(): View
    {
        // Total counts
        $totalUsers = User::count();
        $totalBooks = Book::count();
        $totalCategories = Category::count();
        $activeUsers = User::where('status', 'active')->count();

        // Users by role
        $usersByRole = Role::withCount('users')->get();

        // Books by category
        $booksByCategory = Category::withCount('books')
            ->orderByDesc('books_count')
            ->limit(5)
            ->get();

        // Books by language
        $booksByLanguage = Book::selectRaw('language, COUNT(*) as count')
            ->groupBy('language')
            ->orderByDesc('count')
            ->limit(5)
            ->get();

        // Recent users (last 5)
        $recentUsers = User::orderByDesc('created_at')
            ->limit(5)
            ->get();

        // Recent books (last 5)
        $recentBooks = Book::orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalUsers',
            'totalBooks',
            'totalCategories',
            'activeUsers',
            'usersByRole',
            'booksByCategory',
            'booksByLanguage',
            'recentUsers',
            'recentBooks'
        ));
    }
}