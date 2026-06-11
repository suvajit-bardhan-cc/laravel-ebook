<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Static Page routes
Route::view('/about', 'pages.about')->name('about');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/contact', 'pages.contact')->name('contact');

// Bookmark routes
Route::get('/bookmark', [AuthController::class, 'bookmark'])->name('bookmark');


// Book Details page
Route::get('/book/{id}', [AuthController::class, 'show'])
    ->name('book.details')
    ->where('id', '[0-9]+');

Route::get('/books/{encryptedId}', [AuthController::class, 'show'])
    ->name('books.show');
    

// Admin routes
require __DIR__.'/admin.php';
