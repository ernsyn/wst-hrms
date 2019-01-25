<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCostCentreAndEmployeeGradeToAdditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('additions', function (Blueprint $table) {
            $table->string('cost_centre')->nullable()->after('ea_form_id');
            $table->string('employee_grade')->nullable()->after('cost_centre');
        });
        Schema::table('deductions', function (Blueprint $table) {
            $table->string('cost_centre')->nullable()->after('ea_form_id');
            $table->string('employee_grade')->nullable()->after('cost_centre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('additions', function (Blueprint $table) {
            $table->dropColumn('cost_centre');
            $table->dropColumn('employee_grade');
        });
        Schema::table('deductions', function (Blueprint $table) {
            $table->dropColumn('cost_centre');
            $table->dropColumn('employee_grade');
        });
    }
}
