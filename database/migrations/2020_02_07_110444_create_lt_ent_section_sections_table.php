<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLTEntSectionSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lt_ent_section_sections', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('lt_ent_section_id');
            $table->foreign('lt_ent_section_id')
            ->references('id')
            ->on('lt_ent_sections')
            ->onDelete('cascade');
            
            $table->unsignedInteger('section_id');
            $table->foreign('section_id')
            ->references('id')
            ->on('sections')
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
        Schema::dropIfExists('lt_ent_section_sections');
    }
}
