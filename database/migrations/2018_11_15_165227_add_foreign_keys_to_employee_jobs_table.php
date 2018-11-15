<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEmployeeJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('employee_jobs', function(Blueprint $table)
		{
			$table->foreign('branch_id')->references('id')->on('branches')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('contract_media_id')->references('id')->on('medias')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('cost_centre_id')->references('id')->on('cost_centres')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('department_id')->references('id')->on('departments')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('emp_grade_id')->references('id')->on('employee_grades')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('emp_id')->references('id')->on('employees')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('emp_mainposition_id')->references('id')->on('employee_positions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('team_id')->references('id')->on('teams')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('employee_jobs', function(Blueprint $table)
		{
			$table->dropForeign('employee_jobs_branch_id_foreign');
			$table->dropForeign('employee_jobs_contract_media_id_foreign');
			$table->dropForeign('employee_jobs_cost_centre_id_foreign');
			$table->dropForeign('employee_jobs_department_id_foreign');
			$table->dropForeign('employee_jobs_emp_grade_id_foreign');
			$table->dropForeign('employee_jobs_emp_id_foreign');
			$table->dropForeign('employee_jobs_emp_mainposition_id_foreign');
			$table->dropForeign('employee_jobs_team_id_foreign');
		});
	}

}
