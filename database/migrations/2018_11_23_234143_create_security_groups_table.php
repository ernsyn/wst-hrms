<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecurityGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('security_groups', function (Blueprint $table) {
            $table->increments('id');
         
            $table->string('name')->nullable();
			$table->string('description')->nullable();
			$table->integer('company_id')->nullable();
			$table->string('status')->nullable();
 
            $table->timestamps();
            $table->softDeletes();
			$table->string('created_by', 100)->nullable();
        });


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
    {   Schema::dropIfExists('employee_security_groups');
        Schema::dropIfExists('security_groups');
    }
}
