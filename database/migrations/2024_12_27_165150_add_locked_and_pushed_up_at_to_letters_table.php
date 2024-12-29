<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('letters', function (Blueprint $table) {
            if (!Schema::hasColumn('letters', 'locked')) {
                $table->boolean('locked')->default(false);
            }

            if (!Schema::hasColumn('letters', 'pushed_up_at')) {
                $table->timestamp('pushed_up_at')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('letters', function (Blueprint $table) {
            // Drop the columns when rolling back the migration
            $table->dropColumn(['locked', 'pushed_up_at']);
        });
    }
};
