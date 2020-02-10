<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLTEntGradeEmployeeGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lt_ent_grade_employee_grades', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('lt_ent_grade_id');
            $table->foreign('lt_ent_grade_id')
            ->references('id')
            ->on('lt_ent_grades')
            ->onDelete('cascade');
            
            $table->unsignedInteger('grade_id');
            $table->foreign('grade_id')
            ->references('id')
            ->on('employee_grades')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lt_ent_grade_employee_grades');
    }
}
