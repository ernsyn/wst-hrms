<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLTEntPositionEmployeePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lt_ent_position_employee_positions', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('lt_ent_position_id');
            $table->foreign('lt_ent_position_id')
            ->references('id')
            ->on('lt_ent_positions')
            ->onDelete('cascade');
            
            $table->unsignedInteger('position_id');
            $table->foreign('position_id')
            ->references('id')
            ->on('employee_positions')
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
        Schema::dropIfExists('lt_ent_position_employee_positions');
    }
}
