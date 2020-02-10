<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLTEntDepartmentDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lt_ent_department_departments', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('lt_ent_department_id');            
            $table->foreign('lt_ent_department_id')
            ->references('id')
            ->on('lt_ent_departments')
            ->onDelete('cascade');
            
            $table->unsignedInteger('department_id');            
            $table->foreign('department_id')
            ->references('id')
            ->on('departments')
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
        Schema::dropIfExists('lt_ent_department_departments');
    }
}
