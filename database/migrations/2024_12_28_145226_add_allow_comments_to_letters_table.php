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
            $table->boolean('allow_comments')->default(true); // Default to true if not provided
        });
    }

    public function down()
    {
        Schema::table('letters', function (Blueprint $table) {
            $table->dropColumn('allow_comments');
        });
    }

};
