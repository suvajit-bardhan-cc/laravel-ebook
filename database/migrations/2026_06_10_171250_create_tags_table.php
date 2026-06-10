<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('fa_icon')->unique();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        DB::table('tags')->insert([
            ['name' => 'Featured Title', 'slug' => 'featured-title', 'fa_icon' => 'fas fa-star', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Best Seller', 'slug' => 'best-seller', 'fa_icon' => 'fas fa-trophy', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Popular', 'slug' => 'popular', 'fa_icon' => 'fas fa-fire', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
