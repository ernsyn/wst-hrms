<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('employee_attendances');
        Schema::create('employee_attendances', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('emp_id', false);
            $table->foreign('emp_id')->references('id')->on('employees');

            $table->datetime('clock_in_time');
            $table->decimal('clock_in_lat', 10, 8)->nullable();
            $table->decimal('clock_in_long', 11, 8)->nullable();
            $table->string('clock_in_address', 200)->nullable();
            $table->string('clock_in_status', 30)->nullable();
            $table->string('clock_in_reason', 200)->nullable();
            
            $table->datetime('clock_out_time')->nullable();
            $table->decimal('clock_out_lat', 10, 8)->nullable();
            $table->decimal('clock_out_long', 11, 8)->nullable();
            $table->string('clock_out_address', 200)->nullable();
            $table->string('clock_out_status', 30)->nullable();
            $table->string('clock_out_reason', 200)->nullable();

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
        Schema::dropIfExists('employee_attendances');
    }
}
