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

class DashboardController
{
    public function index(Request $request)
    {
        $search = $request->search;

        $books = Book::with('categories')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author_name', 'like', "%{$search}%");
                });
            })
            ->where('status', 'active')
            ->paginate(18);

        $categories = Category::where('status', 'active')->withCount('books')->get();

        // Get popular categories (top 6 by book count)
        $popularCategories = Category::where('status', 'active')
            ->withCount('books')
            ->orderByDesc('books_count')
            ->limit(5)
            ->get();

        $allTags = Tag::where('status', 'active')->get();

        return view('front.dashboard.index', compact(
            'books',
            'categories',
            'popularCategories',
            'allTags'
        ));
    }

}