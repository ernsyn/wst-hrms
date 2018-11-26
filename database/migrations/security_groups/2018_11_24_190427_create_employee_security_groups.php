<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeSecurityGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_security_groups', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('emp_id', false);
            $table->foreign('emp_id')->references('id')->on('employees');

            $table->unsignedInteger('security_group_id', false);
            $table->foreign('security_group_id')->references('id')->on('security_groups');

			$table->integer('payroll_access')->nullable();


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
        Schema::dropIfExists('employee_security_groups');
    }
}
