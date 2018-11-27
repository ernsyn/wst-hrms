<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socsos', function (Blueprint $table) {
            $table->increments('id');
      
            $table->string('first_category_employer', 100)->nullable();
            $table->string('first_category_employee', 100)->nullable();

            $table->decimal('salary', 10, 2)->nullable();
            
             
            $table->timestamps();
            $table->softDeletes();
			$table->string('created_by', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socsos');
    }
}
