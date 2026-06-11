<?php

namespace App\Http\Controllers\Front;

use App\Models\Book;
use App\Models\UserBookmark;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class BookmarkController
{
    public function index()
    {
        $bookmarks = UserBookmark::with('book.categories')
            ->where('user_id', Auth::id())
            ->paginate(15);

        return view('front.bookmarks.index', compact('bookmarks'));
    }

    public function toggle($bookId): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to bookmark books',
                'requires_login' => true
            ], 401);
        }

        $book = Book::findOrFail($bookId);
        $userId = Auth::id();

        // Check if bookmark already exists
        $bookmark = UserBookmark::where('user_id', $userId)
            ->where('book_id', $book->id)
            ->first();

        if ($bookmark) {
            // Remove bookmark
            $bookmark->delete();
            return response()->json([
                'success' => true,
                'message' => 'Bookmark removed',
                'bookmarked' => false
            ]);
        } else {
            // Add bookmark
            UserBookmark::create([
                'user_id' => $userId,
                'book_id' => $book->id,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Book bookmarked',
                'bookmarked' => true
            ]);
        }
    }

    public function isBookmarked($bookId): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['bookmarked' => false]);
        }

        $bookmarked = UserBookmark::where('user_id', Auth::id())
            ->where('book_id', $bookId)
            ->exists();

        return response()->json(['bookmarked' => $bookmarked]);
    }
}
