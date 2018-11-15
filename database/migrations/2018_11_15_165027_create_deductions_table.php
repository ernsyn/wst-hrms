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
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('id_company_master');
			$table->string('code');
			$table->string('name');
			$table->string('type');
			$table->integer('day')->default(0);
			$table->decimal('amount', 9);
			$table->string('statutory')->nullable();
			$table->integer('confirmed_employee')->default(0);
			$table->string('status');
			$table->bigInteger('created_by');
			$table->timestamp('created_on')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('id_applies_to', 50)->nullable();
			$table->string('id_cost_centre', 50)->nullable();
			$table->string('id_job_master', 50)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('deductions');
	}

}
