<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeJobsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employee_jobs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('emp_id')->unsigned()->index('employee_jobs_emp_id_foreign');
			$table->integer('branch_id')->unsigned()->index('employee_jobs_branch_id_foreign');
			$table->integer('emp_mainposition_id')->unsigned()->nullable()->index('employee_jobs_emp_mainposition_id_foreign');
			$table->integer('department_id')->unsigned()->nullable()->index('employee_jobs_department_id_foreign');
			$table->integer('team_id')->unsigned()->nullable()->index('employee_jobs_team_id_foreign');
			$table->integer('cost_centre_id')->unsigned()->nullable()->index('employee_jobs_cost_centre_id_foreign');
			$table->integer('emp_grade_id')->unsigned()->nullable()->index('employee_jobs_emp_grade_id_foreign');
			$table->date('start_date');
			$table->date('end_date')->nullable();
			$table->decimal('basic_salary', 10);
			$table->text('specification', 65535);
			$table->integer('contract_media_id')->unsigned()->nullable()->index('employee_jobs_contract_media_id_foreign');
			$table->string('status', 30);
			$table->softDeletes();
			$table->string('created_by', 100)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employee_jobs');
	}

}
