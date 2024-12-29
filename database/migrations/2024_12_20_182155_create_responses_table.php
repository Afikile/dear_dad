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
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('letter_id')->constrained()->onDelete('cascade'); // Response is tied to a letter
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Response is tied to a user
            $table->foreignId('parent_id')->nullable()->constrained('responses')->onDelete('cascade'); // Self-referential parent response
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('responses', function (Blueprint $table) {
            $table->dropForeign(['parent_id']); // Drop foreign key for parent_id
        });
        Schema::dropIfExists('responses');
    }
};
