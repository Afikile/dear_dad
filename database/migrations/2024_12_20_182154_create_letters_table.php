<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_features_to_letters_table.php
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
        Schema::table('letters', function (Blueprint $table) {
            $table->boolean('comments_locked')->default(false); // Whether comments are locked
            $table->unsignedInteger('views_count')->default(0); // Number of times the letter has been viewed
            $table->boolean('pinned')->default(false); // Whether the letter is pinned
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('letters', function (Blueprint $table) {
            $table->dropColumn('comments_locked');
            $table->dropColumn('views_count');
            $table->dropColumn('pinned');
        });
    }
};
