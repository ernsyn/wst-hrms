<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBlacklistedAndReasonToEmployeeJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_jobs', function (Blueprint $table) {
        	$table->datetime('resignation_date')->nullable();
            $table->boolean('blacklisted')->default('0');
            $table->text('reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_jobs', function (Blueprint $table) {
        	$table->dropColumn('resignation_date');
            $table->dropColumn('blacklisted');
            $table->dropColumn('reason');
        });
    }
}
