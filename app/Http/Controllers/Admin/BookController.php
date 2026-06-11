<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request): View
    {
        $query = Book::with('categories', 'tags');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author_name', 'like', "%{$search}%")
                  ->orWhere('language', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('categories.id', $request->category);
            });
        }

        // Tag filter
        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('tags.id', $request->tag);
            });
        }

        // Language filter
        if ($request->filled('language')) {
            $query->where('language', $request->language);
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Sorting
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortField, $sortDirection);

        // Pagination
        $books = $query->paginate(15)->withQueryString();

        // Get unique languages for filter
        $languages = Book::select('language')
            ->distinct()
            ->whereNotNull('language')
            ->pluck('language');

        // Get all categories for filter
        $categories = Category::where('status', 'active')->get();

        // Get all tags for filter
        $tags = Tag::where('status', 'active')->get();

        return view('admin.books.index', compact('books', 'languages', 'categories', 'tags'));
    }

    public function create(): View
    {
        $categories = Category::where('status', 'active')->get();
        $tags = Tag::where('status', 'active')->get();
        return view('admin.books.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'language' => 'nullable|string|max:100',
            'about' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('book-covers', 'public');
            $validated['cover_image'] = $path;
        }

        $book = Book::create($validated);

        // Attach categories
        if ($request->has('categories')) {
            $book->categories()->attach($request->categories);
        }

        // Attach tags
        if ($request->has('tags')) {
            $book->tags()->attach($request->tags);
        }

        return redirect()->route('admin.books.index')
            ->with('success', 'Book created successfully!');
    }

    public function edit(Book $book): View
    {
        $categories = Category::where('status', 'active')->get();
        $bookCategories = $book->categories->pluck('id')->toArray();
        $tags = Tag::where('status', 'active')->get();
        $bookTags = $book->tags->pluck('id')->toArray();
        return view('admin.books.edit', compact('book', 'categories', 'bookCategories', 'tags', 'bookTags'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'language' => 'nullable|string|max:100',
            'about' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $path = $request->file('cover_image')->store('book-covers', 'public');
            $validated['cover_image'] = $path;
        }

        $book->update($validated);

        // Sync categories
        $book->categories()->sync($request->categories ?? []);

        // Sync tags
        $book->tags()->sync($request->tags ?? []);

        return redirect()->route('admin.books.index')
            ->with('success', 'Book updated successfully!');
    }

    public function destroy(Book $book)
    {
        // Delete cover image if exists
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }
        
        $book->categories()->detach();
        $book->delete();
        
        return redirect()->route('admin.books.index')
            ->with('success', 'Book deleted successfully.');
    }
}