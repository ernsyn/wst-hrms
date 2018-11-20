<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdditionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('additions', function(Blueprint $table)
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

		Schema::create('addition_cost_centre', function (Blueprint $table) {
			$table->integer('addition_id')->unsigned()->nullable();
			$table->foreign('addition_id')->references('id')
				  ->on('additions');
	  
			$table->integer('cost_centre_id')->unsigned()->nullable();
			$table->foreign('cost_centre_id')->references('id')
				  ->on('cost_centres');
		});

		Schema::create('addition_employee_grade', function (Blueprint $table) {
			$table->integer('addition_id')->unsigned()->nullable();
			$table->foreign('addition_id')->references('id')
				  ->on('additions');
	  
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
		Schema::dropIfExists('addition_cost_centre');
		Schema::dropIfExists('addition_employee_grade');
		Schema::drop('additions');
	}

}
