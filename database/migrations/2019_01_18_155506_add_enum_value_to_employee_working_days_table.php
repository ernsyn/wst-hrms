<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnumValueToEmployeeWorkingDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_working_days', function (Blueprint $table) {
            //
            DB::statement("ALTER TABLE employee_working_days MODIFY monday ENUM('full', 'half', 'half_2', 'off', 'rest') NOT NULL DEFAULT 'full'");
            DB::statement("ALTER TABLE employee_working_days MODIFY tuesday ENUM('full', 'half', 'half_2', 'off', 'rest') NOT NULL DEFAULT 'full'");
            DB::statement("ALTER TABLE employee_working_days MODIFY wednesday ENUM('full', 'half', 'half_2', 'off', 'rest') NOT NULL DEFAULT 'full'");
            DB::statement("ALTER TABLE employee_working_days MODIFY thursday ENUM('full', 'half', 'half_2', 'off', 'rest') NOT NULL DEFAULT 'full'");
            DB::statement("ALTER TABLE employee_working_days MODIFY friday ENUM('full', 'half', 'half_2', 'off', 'rest') NOT NULL DEFAULT 'full'");
            DB::statement("ALTER TABLE employee_working_days MODIFY saturday ENUM('full', 'half', 'half_2', 'off', 'rest') NOT NULL DEFAULT 'full'");
            DB::statement("ALTER TABLE employee_working_days MODIFY sunday ENUM('full', 'half', 'half_2', 'off', 'rest') NOT NULL DEFAULT 'full'");
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
            //
            DB::statement("ALTER TABLE employee_working_days MODIFY monday ENUM('full', 'half', 'off', 'rest') NOT NULL DEFAULT 'full'");
            DB::statement("ALTER TABLE employee_working_days MODIFY tuesday ENUM('full', 'half', 'off', 'rest') NOT NULL DEFAULT 'full'");
            DB::statement("ALTER TABLE employee_working_days MODIFY wednesday ENUM('full', 'half', 'off', 'rest') NOT NULL DEFAULT 'full'");
            DB::statement("ALTER TABLE employee_working_days MODIFY thursday ENUM('full', 'half', 'off', 'rest') NOT NULL DEFAULT 'full'");
            DB::statement("ALTER TABLE employee_working_days MODIFY friday ENUM('full', 'half', 'off', 'rest') NOT NULL DEFAULT 'full'");
            DB::statement("ALTER TABLE employee_working_days MODIFY saturday ENUM('full', 'half', 'off', 'rest') NOT NULL DEFAULT 'full'");
            DB::statement("ALTER TABLE employee_working_days MODIFY sunday ENUM('full', 'half', 'off', 'rest') NOT NULL DEFAULT 'full'");
        });
    }
}
