<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AlterEmployeeWorkingDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement("TRUNCATE TABLE employee_working_days");
        DB::statement("ALTER TABLE employee_working_days MODIFY monday ENUM('full', 'half', 'off', 'rest') NOT NULL DEFAULT 'full'");
        DB::statement("ALTER TABLE employee_working_days MODIFY tuesday ENUM('full', 'half', 'off', 'rest') NOT NULL DEFAULT 'full'");
        DB::statement("ALTER TABLE employee_working_days MODIFY wednesday ENUM('full', 'half', 'off', 'rest') NOT NULL DEFAULT 'full'");
        DB::statement("ALTER TABLE employee_working_days MODIFY thursday ENUM('full', 'half', 'off', 'rest') NOT NULL DEFAULT 'full'");
        DB::statement("ALTER TABLE employee_working_days MODIFY friday ENUM('full', 'half', 'off', 'rest') NOT NULL DEFAULT 'full'");
        DB::statement("ALTER TABLE employee_working_days MODIFY saturday ENUM('full', 'half', 'off', 'rest') NOT NULL DEFAULT 'full'");
        DB::statement("ALTER TABLE employee_working_days MODIFY sunday ENUM('full', 'half', 'off', 'rest') NOT NULL DEFAULT 'full'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('employee_working_days', function (Blueprint $table) {
            $table->dropColumn('monday');
            $table->dropColumn('tuesday');
            $table->dropColumn('wednesday');
            $table->dropColumn('thursday');
            $table->dropColumn('friday');
            $table->dropColumn('saturday');
            $table->dropColumn('sunday');
        });

        Schema::table('employee_working_days', function (Blueprint $table) {
            $table->decimal('monday', 8,1)->nullable(false);
            $table->decimal('tuesday', 8,1)->nullable(false);
            $table->decimal('wednesday', 8,1)->nullable(false);
            $table->decimal('thursday', 8,1)->nullable(false);
            $table->decimal('friday', 8,1)->nullable(false);
            $table->decimal('saturday', 8,1)->nullable(false);
            $table->decimal('sunday', 8,1)->nullable(false);
        });
    }
}
