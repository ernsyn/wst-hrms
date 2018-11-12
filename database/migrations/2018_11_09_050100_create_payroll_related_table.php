<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePayrollRelatedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('addition_master', function(Blueprint $table)
	    {
	        $table->bigInteger('id', true);
	        $table->bigInteger('company_id');
	        $table->string('code')->unique('code');
	        $table->string('name');
	        $table->string('type');
	        $table->integer('day');
	        $table->decimal('amount', 9);
	        $table->string('statutory')->nullable();
	        $table->bigInteger('ea_form_id');
	        $table->integer('confirmed_employee');
	        $table->integer('status');
	        $table->bigInteger('created_by');
	        $table->timestamps();
	    });
	    
		Schema::create('addition_applies_to', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('addition_master_id');
			$table->bigInteger('job_master_id');
		});
		
		Schema::create('deduction_master', function(Blueprint $table)
		{
		    $table->bigInteger('id', true);
		    $table->bigInteger('company_id');
		    $table->string('code')->unique('code');
		    $table->string('name');
		    $table->string('type');
		    $table->integer('day');
		    $table->decimal('amount', 9);
		    $table->string('statutory')->nullable();
		    $table->integer('confirmed_employee');
		    $table->integer('status');
		    $table->bigInteger('created_by');
		    $table->timestamps();
		});
		
		Schema::create('deduction_applies_to', function(Blueprint $table)
		{
		    $table->bigInteger('id', true);
		    $table->bigInteger('deduction_master_id');
		    $table->bigInteger('job_master_id');
		});
		
		Schema::create('eis', function(Blueprint $table)
		{
		    $table->bigInteger('id', true);
		    $table->decimal('salary', 9);
		    $table->decimal('employer', 9);
		    $table->decimal('employee', 9);
		    $table->timestamps();
		});
		
		Schema::create('epf', function(Blueprint $table)
		{
		    $table->bigInteger('id', true);
		    $table->string('category');
		    $table->decimal('salary', 9);
		    $table->decimal('employer', 9);
		    $table->decimal('employee', 9);
		    $table->timestamps();
		});
		
		Schema::create('pcb', function(Blueprint $table)
		{
		    $table->bigInteger('id', true);
		    $table->decimal('salary', 9);
		    $table->integer('category');
		    $table->integer('number_of_children', 9);
		    $table->decimal('amount', 9);
		    $table->timestamps();
		});
		
		Schema::create('socso', function(Blueprint $table)
		{
		    $table->bigInteger('id', true);
		    $table->decimal('salary', 9);
		    $table->decimal('first_category_employer', 9);
		    $table->decimal('first_category_employee', 9);
		    $table->timestamps();
		});
		
		Schema::create('payroll_master', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->bigInteger('company_id');
		    $table->date('year_month');
		    $table->smallInteger('period');
		    $table->smallInteger('status');
		    $table->bigInteger('created_by');
		    $table->bigInteger('updated_by');
		    $table->timestamps();
		});
		
	    Schema::create('payroll_trx', function (Blueprint $table) {
	        $table->bigIncrements('id');
	        $table->unsignedBigInteger('payroll_master_id');
	        $table->bigInteger('employee_id');
	        $table->decimal('employee_epf', 9);
	        $table->decimal('employee_eis', 9);
	        $table->decimal('employee_socso', 9);
	        $table->decimal('employee_pcb', 9);
	        $table->decimal('employer_epf', 9);
	        $table->decimal('employer_eis', 9);
	        $table->decimal('employer_socso', 9);
	        $table->decimal('kpi', 9);
	        $table->decimal('bonus', 9);
	        $table->decimal('seniority_pay', 9);
	        $table->decimal('basic_salary', 9);
	        $table->decimal('take_home_pay', 9);
	        $table->longText('note')->nullable();
	        $table->bigInteger('created_by');
	        $table->integer('updated_by');
	        $table->timestamps();
	    });
	    
        Schema::create('payroll_trx_addition', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('payroll_trx_id');
            $table->bigInteger('addition_master_id');
            $table->decimal('amount', 9);
            $table->integer('days');
            $table->bigInteger('created_by');
            $table->integer('updated_by');
            $table->timestamps();
        });
        
        Schema::create('payroll_trx_deduction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('payroll_trx_id');
            $table->bigInteger('deduction_master_id');
            $table->decimal('amount', 9);
            $table->integer('days');
            $table->bigInteger('created_by');
            $table->integer('updated_by');
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
	    Schema::dropIfExists('addition_master');
	    Schema::dropIfExists('addition_applies_to');
	    Schema::dropIfExists('deduction_master');
	    Schema::dropIfExists('deduction_applies_to');
	    Schema::dropIfExists('eis');
	    Schema::dropIfExists('epf');
	    Schema::dropIfExists('pcb');
	    Schema::dropIfExists('socso');
		Schema::dropIfExists('payroll_master');
		Schema::dropIfExists('payroll_trx');
		Schema::dropIfExists('payroll_trx_addition');
		Schema::dropIfExists('payroll_trx_deduction');
	}

}
