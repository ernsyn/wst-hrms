<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobAttachsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_attachs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('job_attach');
            $table->foreign('emp_job_id')->unsigned()
            ->references('id')->on('employee_jobs');
            ->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_attachs');
    }
}
