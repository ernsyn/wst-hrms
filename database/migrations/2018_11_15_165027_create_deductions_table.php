<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeductionsTable extends Migration {

/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('deductions', function(Blueprint $table)
		{
			$table->increments('id');
			
            $table->unsignedInteger('company_id', false)->nullable();
			$table->foreign('company_id')->references('id')->on('companies');
			
			$table->string('code');
			$table->string('name');
			$table->string('type');
			$table->decimal('amount', 9);
			$table->string('statutory')->nullable();
			$table->string('status');
			$table->boolean('confirmed_employee')->nullable();
			
			// Relationship to be created later
			$table->integer('ea_form_id')->nullable();
			
            $table->softDeletes();
			$table->string('created_by', 100)->nullable();
            $table->timestamps();
		});

		Schema::create('deduction_cost_centre', function (Blueprint $table) {
			$table->integer('deduction_id')->unsigned()->nullable();
			$table->foreign('deduction_id')->references('id')
				  ->on('deductions');
	  
			$table->integer('cost_centre_id')->unsigned()->nullable();
			$table->foreign('cost_centre_id')->references('id')
				  ->on('cost_centres');
		});

		Schema::create('deduction_employee_grade', function (Blueprint $table) {
			$table->integer('deduction_id')->unsigned()->nullable();
			$table->foreign('deduction_id')->references('id')
				  ->on('deductions');
	  
			$table->integer('employee_grade_id')->unsigned()->nullable();
			$table->foreign('employee_grade_id')->references('id')
				  ->on('employee_grades');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('deduction_cost_centre');
		Schema::dropIfExists('deduction_employee_grade');
		Schema::drop('deductions');
	}
}
