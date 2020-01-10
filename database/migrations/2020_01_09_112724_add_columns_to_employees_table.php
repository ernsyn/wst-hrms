<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->date('join_group_date')->nullable()->after('basic_salary');
            $table->date('join_company_date')->nullable()->after('join_group_date');
            $table->integer('cost_centre_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('section_id')->nullable();
            $table->integer('position_id')->nullable();
            $table->integer('team_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('area_id')->nullable();
            $table->integer('grade_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->dropColumn('position');
            $table->dropColumn('leave_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('join_group_date');
            $table->dropColumn('join_company_date');
            $table->dropColumn('cost_centre_id');
            $table->dropColumn('department_id');
            $table->dropColumn('section_id');
            $table->dropColumn('position_id');
            $table->dropColumn('team_id');
            $table->dropColumn('branch_id');
            $table->dropColumn('area_id');
            $table->dropColumn('grade_id');
            $table->dropColumn('category_id');
            $table->string('position')->nullable();
            $table->datetime('leave_date')->nullable()->after('resignation_date');
        });
    }
}
