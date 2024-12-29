<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // database/migrations/xxxx_xx_xx_xxxxxx_add_parent_id_to_replies_table.php

    public function up()
    {
        Schema::table('replies', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable()->after('id'); // Add the parent_id column
            $table->foreign('parent_id')->references('id')->on('replies')->onDelete('cascade'); // Set foreign key to replies table itself
        });
    }

    public function down()
    {
        Schema::table('replies', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
        });
    }

};
