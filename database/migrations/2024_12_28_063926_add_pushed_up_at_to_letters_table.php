<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPushedUpAtToLettersTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('letters', 'pushed_up_at')) {
            Schema::table('letters', function (Blueprint $table) {
                $table->datetime('pushed_up_at')->nullable();
            });
        }
    }

    public function down()
    {
        Schema::table('letters', function (Blueprint $table) {
            $table->dropColumn('pushed_up_at');
        });
    }
}
