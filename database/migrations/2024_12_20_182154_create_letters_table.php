<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_letters_table.php
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
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Title of the letter
            $table->text('body'); // Content of the letter
            // Define the foreign key that references the 'users' table
            $table->foreignId('user_id')
                ->constrained('users') // Explicitly reference the 'users' table
                ->onDelete('cascade'); // Ensure letters are deleted if the user is deleted
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
