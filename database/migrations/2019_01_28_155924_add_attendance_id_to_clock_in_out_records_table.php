<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAttendanceIdToClockInOutRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_clock_in_out_records', function (Blueprint $table) {
            $table->unsignedInteger('emp_attendance_id', false)->nullable();
            $table->foreign('emp_attendance_id')->references('id')->on('employee_attendances');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_clock_in_out_records', function (Blueprint $table) {
            $table->dropForeign(['emp_attendance_id']);
            $table->dropColumn('emp_attendance_id');
        });
    }
}
