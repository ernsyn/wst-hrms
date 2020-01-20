<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeDisciplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_disciplines', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('discipline_title');
            $table->string('discipline_desc');
            $table->date('discipline_date');
            $table->integer('emp_id')->unsigned();
            $table->integer('created_by')->unsigned();
        });
        Schema::table('employee_disciplines', function($table) {
            $table->foreign('emp_id')->references('id')->on('employees');
        });
        Schema::table('employee_disciplines', function($table) {
            $table->foreign('created_by')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_disciplines');
    }
}
