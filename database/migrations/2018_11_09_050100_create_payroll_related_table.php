<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollRelatedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    
		Schema::create('addition_applies_to', function(Blueprint $table)
		{
		    $table->bigIncrements('id', true);
			$table->bigInteger('additions_id');
			$table->bigInteger('job_master_id');
		});
		
		Schema::create('deduction_applies_to', function(Blueprint $table)
		{
		    $table->bigIncrements('id', true);
		    $table->bigInteger('deductions_id');
		    $table->bigInteger('job_master_id');
		});
		
		Schema::create('eis', function(Blueprint $table)
		{
		    $table->bigIncrements('id', true);
		    $table->decimal('salary', 9);
		    $table->decimal('employer', 9);
		    $table->decimal('employee', 9);
		    $table->integer('created_by');
		    $table->integer('updated_by')->nullable();
		    $table->timestamps();
		});
		
		Schema::create('epf', function(Blueprint $table)
		{
		    $table->bigIncrements('id', true);
		    $table->string('category');
		    $table->decimal('salary', 9);
		    $table->decimal('employer', 9);
		    $table->decimal('employee', 9);
		    $table->integer('created_by');
		    $table->integer('updated_by')->nullable();
		    $table->timestamps();
		});
		
		Schema::create('pcb', function(Blueprint $table)
		{
		    $table->bigIncrements('id', true);
		    $table->decimal('salary', 9);
		    $table->integer('category');
		    $table->integer('number_of_children');
		    $table->decimal('amount', 9);
		    $table->integer('created_by');
		    $table->integer('updated_by')->nullable();
		    $table->timestamps();
		});
		
		Schema::create('socso', function(Blueprint $table)
		{
		    $table->bigIncrements('id', true);
		    $table->decimal('salary', 9);
		    $table->decimal('first_category_employer', 9);
		    $table->decimal('first_category_employee', 9);
		    $table->integer('created_by');
		    $table->integer('updated_by')->nullable();
		    $table->timestamps();
		});
		
		Schema::create('payroll_master', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->unsignedInteger('company_id', false);
		    $table->date('year_month');
		    $table->smallInteger('period');
		    $table->smallInteger('status')->default(1);
		    $table->integer('created_by');
		    $table->integer('updated_by')->nullable();
		    $table->timestamps();
		    
		    $table->foreign('company_id')->references('id')->on('companies');
		});
		
	    Schema::create('payroll_trx', function (Blueprint $table) {
	        $table->bigIncrements('id');
	        $table->unsignedBigInteger('payroll_master_id');
	        $table->integer('employee_id');
	        $table->decimal('employee_epf', 9);
	        $table->decimal('employee_eis', 9);
	        $table->decimal('employee_socso', 9);
	        $table->decimal('employee_pcb', 9);
	        $table->decimal('employer_epf', 9);
	        $table->decimal('employer_eis', 9);
	        $table->decimal('employer_socso', 9);
	        $table->decimal('kpi', 9)->default(0);
	        $table->decimal('bonus', 9)->default(0);
	        $table->decimal('seniority_pay', 9)->default(0);
	        $table->decimal('basic_salary', 9)->default(0);
	        $table->decimal('total_addition', 9)->default(0);
	        $table->decimal('total_deduction', 9)->default(0);
	        $table->decimal('take_home_pay', 9)->default(0);
	        $table->longText('note')->nullable();
	        $table->integer('created_by');
	        $table->integer('updated_by')->nullable();
	        $table->timestamps();
	    });
	    
        Schema::create('payroll_trx_addition', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('payroll_trx_id');
            $table->bigInteger('addition_master_id');
            $table->decimal('amount', 9);
            $table->integer('days');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
        
        Schema::create('payroll_trx_deduction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('payroll_trx_id');
            $table->bigInteger('deduction_master_id');
            $table->decimal('amount', 9);
            $table->integer('days');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
	    Schema::dropIfExists('addition_applies_to');
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
