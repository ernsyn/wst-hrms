<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayrollProcessedLeaveAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_processed_leave_attendance', function (Blueprint $table) {
            $table->bigIncrements('id', true);
            $table->unsignedBigInteger('payroll_trx_addition_id', false)->nullable();
            $table->unsignedBigInteger('payroll_trx_deduction_id', false)->nullable();
            $table->unsignedInteger('leave_request_id', false)->nullable();
            $table->unsignedInteger('employee_attendance_id', false)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_processed_leave_attendance');
    }
}
