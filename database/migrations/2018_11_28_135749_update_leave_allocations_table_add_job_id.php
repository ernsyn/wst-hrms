<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLeaveAllocationsTableAddJobId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leave_allocations', function (Blueprint $table) {
            //Add two new column
            $table->unsignedInteger('emp_job_id', false)->nullable();
            $table->foreign('emp_job_id')->references('id')->on('employee_jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_allocations', function (Blueprint $table) {
            $table->dropForeign(['emp_job_id']);
            $table->dropColumn('emp_job_id');
        });
    }
}
