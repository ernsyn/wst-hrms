<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epfs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('category');


            $table->string('employer', 100)->nullable();
            $table->string('employee', 100)->nullable();

			$table->decimal('salary', 10, 2)->nullable();
 
           // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('epfs');
    }
}
