<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFkEmpJobIdToLeaveAllocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('leave_allocations', function (Blueprint $table) {
            $table->dropForeign(['emp_job_id']);
            $table->foreign('emp_job_id')
            ->references('id')->on('employee_jobs')
            ->onDelete('cascade');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('leave_allocations', function (Blueprint $table) {
            $table->dropForeign(['emp_job_id']);
            $table->foreign('emp_job_id')
            ->references('id')->on('employee_jobs')
            ->onDelete('restrict');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
