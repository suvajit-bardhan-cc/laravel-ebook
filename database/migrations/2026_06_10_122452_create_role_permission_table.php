<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('role_permission', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->foreignId('permission_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['role_id', 'permission_id']);
        });

        // Assign permissions to Super Admin role (role_id = 1)
        $permissions = DB::table('permissions')->pluck('id');
        foreach ($permissions as $permissionId) {
            DB::table('role_permission')->insert([
                'role_id' => 1, // Super Admin
                'permission_id' => $permissionId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Assign limited permissions to Admin role (role_id = 2)
        $adminPermissions = DB::table('permissions')
            ->whereNotIn('slug', ['view-roles', 'create-roles', 'edit-roles', 'delete-roles'])
            ->pluck('id');
        
        foreach ($adminPermissions as $permissionId) {
            DB::table('role_permission')->insert([
                'role_id' => 2, // Admin
                'permission_id' => $permissionId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Assign basic permissions to Editor role (role_id = 3)
        $editorPermissions = DB::table('permissions')
            ->whereIn('slug', ['view-books', 'create-books', 'edit-books', 'delete-books', 'view-categories', 'create-categories', 'edit-categories'])
            ->pluck('id');
        
        foreach ($editorPermissions as $permissionId) {
            DB::table('role_permission')->insert([
                'role_id' => 3, // Editor
                'permission_id' => $permissionId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('role_permission');
    }
};