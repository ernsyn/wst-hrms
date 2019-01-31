<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJobIdToLeaveAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('leave_allocations', 'emp_job_id')) {
            Schema::table('leave_allocations', function (Blueprint $table) {
                $table->integer('emp_job_id')->unsigned()->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_allocations', function (Blueprint $table) {
            $table->dropColumn('emp_job_id');
        });
    }
}
