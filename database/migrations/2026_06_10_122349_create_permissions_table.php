<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('module')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert default permissions
        $permissions = [
            // User permissions
            ['name' => 'View Users', 'slug' => 'view-users', 'module' => 'users'],
            ['name' => 'Create Users', 'slug' => 'create-users', 'module' => 'users'],
            ['name' => 'Edit Users', 'slug' => 'edit-users', 'module' => 'users'],
            ['name' => 'Delete Users', 'slug' => 'delete-users', 'module' => 'users'],
            
            // Book permissions
            ['name' => 'View Books', 'slug' => 'view-books', 'module' => 'books'],
            ['name' => 'Create Books', 'slug' => 'create-books', 'module' => 'books'],
            ['name' => 'Edit Books', 'slug' => 'edit-books', 'module' => 'books'],
            ['name' => 'Delete Books', 'slug' => 'delete-books', 'module' => 'books'],
            
            // Category permissions
            ['name' => 'View Categories', 'slug' => 'view-categories', 'module' => 'categories'],
            ['name' => 'Create Categories', 'slug' => 'create-categories', 'module' => 'categories'],
            ['name' => 'Edit Categories', 'slug' => 'edit-categories', 'module' => 'categories'],
            ['name' => 'Delete Categories', 'slug' => 'delete-categories', 'module' => 'categories'],
            
            // Role permissions
            ['name' => 'View Roles', 'slug' => 'view-roles', 'module' => 'roles'],
            ['name' => 'Create Roles', 'slug' => 'create-roles', 'module' => 'roles'],
            ['name' => 'Edit Roles', 'slug' => 'edit-roles', 'module' => 'roles'],
            ['name' => 'Delete Roles', 'slug' => 'delete-roles', 'module' => 'roles'],
            
            // Dashboard access
            ['name' => 'Access Dashboard', 'slug' => 'access-dashboard', 'module' => 'dashboard'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert(array_merge($permission, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};