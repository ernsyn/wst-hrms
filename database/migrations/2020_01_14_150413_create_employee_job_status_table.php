<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeJobStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_job_status', function (Blueprint $table) {
            $table->unsignedInteger('emp_job_id');
            $table->unsignedInteger('status_id');
            
            $table->foreign('emp_job_id')
            ->references('id')
            ->on('employee_jobs')
            ->onDelete('cascade');
            
            $table->foreign('status_id')
            ->references('id')
            ->on('employment_statuses')
            ->onDelete('cascade');
            
            $table->primary(['emp_job_id', 'status_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_job_status');
    }
}
