<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStartWorkTimeAndEndWorkTimeColumnsToEmployeeWorkingDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_working_days', function (Blueprint $table) {
            //Add two new column
            $table->time('start_work_time');
            $table->time('end_work_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_working_days', function (Blueprint $table) {
            //Remove Columns
            $table->dropColumn('start_work_time');
            $table->dropColumn('end_work_time');
        });
    }
}
