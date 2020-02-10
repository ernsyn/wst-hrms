<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLTEntAreaAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lt_ent_area_areas', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('lt_ent_area_id');
            $table->foreign('lt_ent_area_id')
            ->references('id')
            ->on('lt_ent_areas')
            ->onDelete('cascade');
            
            $table->unsignedInteger('area_id');
            $table->foreign('area_id')
            ->references('id')
            ->on('areas')
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
        Schema::dropIfExists('lt_ent_area_areas');
    }
}
