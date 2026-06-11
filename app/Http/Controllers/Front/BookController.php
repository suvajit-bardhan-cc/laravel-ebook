<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Book;
use App\Models\Category;

class BookController
{
    // Book details view
    public function show($id)
    {
        $bookId = Crypt::decrypt($id);
        $book = Book::with('categories')->findOrFail($bookId);
        $allBooksCount = Book::where('status', 'active')->count();

        $categories = Category::where('status', 'active')->withCount('books')->get();

        // Get popular categories (top 6 by book count)
        $popularCategories = Category::where('status', 'active')
            ->withCount('books')
            ->orderByDesc('books_count')
            ->limit(5)
            ->get();

        return view('front.books.show' , compact(
            'book',
            'allBooksCount',
            'categories',
            'popularCategories'
        ));
    }

    // Book details read
    public function read($id)
    {
        $bookId = Crypt::decrypt($id);
        $book = Book::with('categories')->findOrFail($bookId);
        $allBooksCount = Book::where('status', 'active')->count();

        $categories = Category::where('status', 'active')->withCount('books')->get();

        // Get popular categories (top 6 by book count)
        $popularCategories = Category::where('status', 'active')
            ->withCount('books')
            ->orderByDesc('books_count')
            ->limit(5)
            ->get();

        return view('front.books.read' , compact(
            'book',
            'allBooksCount',
            'categories',
            'popularCategories'
        ));
    }

}