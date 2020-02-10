<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAndRecreateLeaveAllocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        
        Schema::dropIfExists('leave_allocations');
        
        Schema::create('leave_allocations', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('emp_id');
            $table->foreign('emp_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');
            
            $table->unsignedInteger('emp_job_id');
            $table->foreign('emp_job_id')
                ->references('id')
                ->on('employee_jobs')
                ->onDelete('cascade');
            
            $table->unsignedInteger('leave_type_id');
            $table->foreign('leave_type_id')
                ->references('id')
                ->on('leave_types')
                ->onDelete('cascade');
            
            $table->decimal('allocated_days', 4, 1);
            $table->decimal('spent_days', 4, 1);
            $table->decimal('carried_forward_days', 4, 1);
            $table->boolean('is_carry_forward');
            $table->date('valid_from_date');
            $table->date('valid_until_date');
            $table->text('reason')->nullable();
            
            $table->softDeletes();
            
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            
            $table->timestamps();
        });
        
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//         Schema::dropIfExists('leave_allocations');
    }
}
