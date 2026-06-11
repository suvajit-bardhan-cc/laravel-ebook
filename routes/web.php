<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\DashboardController;
use App\Http\Controllers\Front\BookController;

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
});

// Static Page routes
Route::view('/about', 'front.pages.about')->name('about');
Route::view('/privacy', 'front.pages.privacy')->name('privacy');
Route::view('/terms', 'front.pages.terms')->name('terms');
Route::view('/contact', 'front.pages.contact')->name('contact');

// Bookmark routes
Route::get('/bookmark', [AuthController::class, 'bookmark'])->name('bookmark');

// Book Details page
// Route::get('/book/{id}', [AuthController::class, 'show'])
//     ->name('book.details')
//     ->where('id', '[0-9]+');

Route::get('/books/{encryptedId}', [BookController::class, 'show'])
    ->name('books.show');

// Admin routes
require __DIR__.'/admin.php';