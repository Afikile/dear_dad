<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
    {
        // In a migration file for comments table
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable();  // Allows a comment to have a parent (null means it's a direct reply to the post)
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');  // Set up the foreign key relationship
        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('parent_id');
        });
    }

};
