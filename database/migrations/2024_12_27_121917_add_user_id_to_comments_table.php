<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            // Check if the 'user_id' column already exists before adding it
            if (!Schema::hasColumn('comments', 'user_id')) {
                $table->foreignId('user_id')->after('letter_id')->constrained()->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            // Only drop the foreign key and column if they exist
            if (Schema::hasColumn('comments', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
}
