<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPayrollTrxIdToLeaveRequestApprovals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leave_request_approvals', function (Blueprint $table) {
            $table->bigInteger('payroll_trx_id')->nullable()->unsigned();;
            $table->foreign('payroll_trx_id')->references('id')->on('payroll_trx');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_request_approvals', function (Blueprint $table) {
            $table->dropColumn('payroll_trx_id');
        });
    }
}
