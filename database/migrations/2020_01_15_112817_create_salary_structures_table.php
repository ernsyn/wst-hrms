<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_structures', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('basic_salary');
            $table->integer('KPI');
            $table->integer('team_id')->unsigned();
            $table->integer('grade_id')->unsigned();
            $table->integer('categories_id')->unsigned();
        });
        Schema::table('salary_structures', function($table) {
            $table->foreign('team_id')->references('id')->on('teams');
        });
        Schema::table('salary_structures', function($table) {
            $table->foreign('grade_id')->references('id')->on('employee_grades');
        });
        Schema::table('salary_structures', function($table) {
            $table->foreign('categories_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary_structures');
    }
}
