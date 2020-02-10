<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLTEntCostCentreCostCentresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lt_ent_cost_centre_cost_centres', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('lt_ent_cost_centre_id');            
            $table->foreign('lt_ent_cost_centre_id')
            ->references('id')
            ->on('lt_ent_cost_centres')
            ->onDelete('cascade');
            
            $table->unsignedInteger('cost_centre_id');            
            $table->foreign('cost_centre_id')
            ->references('id')
            ->on('cost_centres')
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
        Schema::dropIfExists('lt_ent_cost_centre_cost_centres');
    }
}
