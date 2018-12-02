<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCemployeeReportToNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_report_to', function (Blueprint $table) {
            $table->string('notes')->nullable()->change();
        });


    Schema::table('employee_experiences', function (Blueprint $table) {
        $table->string('notes')->nullable()->change();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_report_to', function (Blueprint $table) {
            //
        });
    }
}
