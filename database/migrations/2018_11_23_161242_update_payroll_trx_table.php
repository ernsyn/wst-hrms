<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class UpdatePayrollTrxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payroll_trx', function ($table) {
            $table->decimal('gross_pay', 9)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payroll_trx', function($table) {
            $table->dropColumn('gross_pay');
            $table->dropColumn('commission');
        });
    }
}
