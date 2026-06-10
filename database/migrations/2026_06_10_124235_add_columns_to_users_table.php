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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('id')->constrained()->nullOnDelete();
        });

        // Update existing users with default roles
        \App\Models\User::where('id', 1)->update(['role_id' => 1]);
        \App\Models\User::where('id', 2)->update(['role_id' => 4]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->removeForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
