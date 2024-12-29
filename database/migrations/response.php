<?php 

/*use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// Create a migration for responses table
Schema::create('responses', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('letter_id');
    $table->unsignedBigInteger('user_id');
    $table->text('content');
    $table->timestamps();

    $table->foreign('letter_id')->references('id')->on('letters')->onDelete('cascade');
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});
*/

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('letter_id'); // Foreign key
            $table->unsignedBigInteger('user_id');   // Foreign key
            $table->text('content');                // Content of the response
            $table->timestamps();                   // Created_at and updated_at columns

            // Add foreign key constraints
            $table->foreign('letter_id')->references('id')->on('letters')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responses');
    }
}
