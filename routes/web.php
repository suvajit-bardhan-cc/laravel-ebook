<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\DashboardController;
use App\Http\Controllers\Front\BookController;
use App\Http\Controllers\Front\BookmarkController;
use App\Http\Controllers\Front\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// Guest routes
Route::middleware('guest')->group(function () {
    // Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    // Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Auth routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');

    // Book routes (auth required to see the book page)
    Route::get('/books/{encryptedId}', [BookController::class, 'show'])->name('books.show');
    Route::get('/books/{encryptedId}/read', [BookController::class, 'read'])->name('books.read');

    // Bookmark API routes (auth required for toggle, but check handles unauthenticated users)
    Route::post('/api/bookmarks/{book}/toggle', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');
    Route::get('/api/bookmarks/{book}/check', [BookmarkController::class, 'isBookmarked'])->name('bookmarks.check');
});

// Static Page routes
Route::view('/about', 'front.pages.about')->name('about');
Route::view('/privacy', 'front.pages.privacy')->name('privacy');
Route::view('/terms', 'front.pages.terms')->name('terms');
Route::view('/contact', 'front.pages.contact')->name('contact');

// Book Details page
// Route::get('/book/{id}', [AuthController::class, 'show'])
//     ->name('book.details')
//     ->where('id', '[0-9]+');

// Admin routes
require __DIR__.'/admin.php';