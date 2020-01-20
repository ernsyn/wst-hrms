<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpReportToPPTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_report_to_pp', function (Blueprint $table) {
            $table->unsignedInteger('emp_report_to_id');
            $table->unsignedInteger('payroll_period_id');
            
            $table->foreign('emp_report_to_id')
            ->references('id')
            ->on('employee_report_to')
            ->onDelete('cascade');
            
            $table->foreign('payroll_period_id')
            ->references('id')
            ->on('payroll_period')
            ->onDelete('cascade');
            
            $table->primary(['emp_report_to_id', 'payroll_period_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emp_report_to_payroll_period');
    }
}
