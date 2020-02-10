<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLTEntTeamTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lt_ent_team_teams', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('lt_ent_team_id');
            $table->foreign('lt_ent_team_id')
            ->references('id')
            ->on('lt_ent_teams')
            ->onDelete('cascade');
            
            $table->unsignedInteger('team_id');
            $table->foreign('team_id')
            ->references('id')
            ->on('teams')
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
        Schema::dropIfExists('lt_ent_team_teams');
    }
}
