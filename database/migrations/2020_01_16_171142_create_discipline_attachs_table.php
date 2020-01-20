<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisciplineAttachsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discipline_attachs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('discipline_attach');
            $table->integer('discipline_id')->unsigned();
        });
        Schema::table('discipline_attachs', function($table) {
            $table->foreign('discipline_id')->references('id')->on('employee_disciplines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discipline_attachs');
    }
}
