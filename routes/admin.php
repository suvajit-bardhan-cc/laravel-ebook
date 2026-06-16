<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;

Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->middleware('permission:access-dashboard')
        ->name('dashboard');

    // Profile Management
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])
            ->name('edit');
        Route::put('/edit', [ProfileController::class, 'update'])
            ->name('update');
    });

    // Users Management
    Route::prefix('users/')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])
            ->middleware('permission:view-users')
            ->name('index');
        Route::get('/create', [UserController::class, 'create'])
            ->middleware('permission:create-users')
            ->name('create');
        Route::post('/create', [UserController::class, 'store'])
            ->middleware('permission:create-users')
            ->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])
            ->middleware('permission:edit-users')
            ->name('edit');
        Route::put('/{user}/edit', [UserController::class, 'update'])
            ->middleware('permission:edit-users')
            ->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])
            ->middleware('permission:delete-users')
            ->name('destroy');
        Route::patch('/{user}/status', [UserController::class, 'updateStatus'])
            ->middleware('permission:edit-users')
            ->name('update-status');
    });

    // Books Management
    Route::prefix('books')->name('books.')->group(function () {
        Route::get('/', [BookController::class, 'index'])
            ->middleware('permission:view-books')
            ->name('index');
        Route::get('/create', [BookController::class, 'create'])
            ->middleware('permission:create-books')
            ->name('create');
        Route::post('/', [BookController::class, 'store'])
            ->middleware('permission:create-books')
            ->name('store');
        Route::get('/{book}/edit', [BookController::class, 'edit'])
            ->middleware('permission:edit-books')
            ->name('edit');
        Route::put('/{book}', [BookController::class, 'update'])
            ->middleware('permission:edit-books')
            ->name('update');
        Route::delete('/{book}', [BookController::class, 'destroy'])
            ->middleware('permission:delete-books')
            ->name('destroy');
        Route::get('/{book}', [BookController::class, 'show'])
            ->middleware('permission:view-books')
            ->name('show');
    });

    // Tags Management
    Route::prefix('tags')->name('tags.')->group(function () {
        Route::post('/', [TagController::class, 'store'])
            ->middleware('permission:create-books')
            ->name('store');
    });

    // Categories Management
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])
            ->middleware('permission:view-categories')
            ->name('index');
        Route::get('/create', [CategoryController::class, 'create'])
            ->middleware('permission:create-categories')
            ->name('create');
        Route::post('/', [CategoryController::class, 'store'])
            ->middleware('permission:create-categories')
            ->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])
            ->middleware('permission:edit-categories')
            ->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])
            ->middleware('permission:edit-categories')
            ->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])
            ->middleware('permission:delete-categories')
            ->name('destroy');
        Route::get('/{category}', [CategoryController::class, 'show'])
            ->middleware('permission:view-categories')
            ->name('show');
        Route::patch('/{category}/status', [CategoryController::class, 'updateStatus'])
            ->middleware('permission:edit-categories')
            ->name('update-status');
    });

    // Roles Management
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])
            ->middleware('permission:view-roles')
            ->name('index');
        Route::get('/create', [RoleController::class, 'create'])
            ->middleware('permission:create-roles')
            ->name('create');
        Route::post('/', [RoleController::class, 'store'])
            ->middleware('permission:create-roles')
            ->name('store');
        Route::get('/{role}', [RoleController::class, 'show'])
            ->middleware('permission:view-roles')
            ->name('show');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])
            ->middleware('permission:edit-roles')
            ->name('edit');
        Route::put('/{role}', [RoleController::class, 'update'])
            ->middleware('permission:edit-roles')
            ->name('update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])
            ->middleware('permission:delete-roles')
            ->name('destroy');
        Route::patch('/{role}/status', [RoleController::class, 'updateStatus'])
            ->middleware('permission:edit-roles')
            ->name('update-status');
    });

    // Permissions Management
    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])
            ->middleware('permission:view-roles')
            ->name('index');
        Route::get('/create', [PermissionController::class, 'create'])
            ->middleware('permission:create-roles')
            ->name('create');
        Route::post('/', [PermissionController::class, 'store'])
            ->middleware('permission:create-roles')
            ->name('store');
        Route::get('/{permission}', [PermissionController::class, 'show'])
            ->middleware('permission:view-roles')
            ->name('show');
        Route::get('/{permission}/edit', [PermissionController::class, 'edit'])
            ->middleware('permission:edit-roles')
            ->name('edit');
        Route::put('/{permission}', [PermissionController::class, 'update'])
            ->middleware('permission:edit-roles')
            ->name('update');
        Route::delete('/{permission}', [PermissionController::class, 'destroy'])
            ->middleware('permission:delete-roles')
            ->name('destroy');
    });
});