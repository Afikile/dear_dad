<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('letters', function (Blueprint $table) {
            // Only add 'locked' if it doesn't already exist
            if (!Schema::hasColumn('letters', 'locked')) {
                $table->boolean('locked')->default(false); // Lock status for the letter
            }
            // Add 'pushed_up_at' column
            $table->timestamp('pushed_up_at')->nullable(); // Timestamp for "push-up" functionality
        });
    }

    public function down()
    {
        Schema::table('letters', function (Blueprint $table) {
            $table->dropColumn(['locked', 'pushed_up_at']);
        });
    }
};
