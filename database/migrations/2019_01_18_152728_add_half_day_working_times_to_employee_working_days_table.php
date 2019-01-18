<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHalfDayWorkingTimesToEmployeeWorkingDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_working_days', function (Blueprint $table) {
            //Add two new columns
            $table->time('half_1_start_work_time')->nullable();
            $table->time('half_1_end_work_time')->nullable();
            $table->time('half_2_start_work_time')->nullable();
            $table->time('half_2_end_work_time')->nullable();
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
            $table->dropColumn('half_1_start_work_time');
            $table->dropColumn('half_1_end_work_time');
            $table->time('half_2_start_work_time');
            $table->time('half_2_end_work_time');
        });
    }
}
