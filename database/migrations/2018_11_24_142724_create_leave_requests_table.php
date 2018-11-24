<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('emp_id', false);
            $table->foreign('emp_id')->references('id')->on('employees');

            $table->unsignedInteger('leave_type_id', false);
            $table->foreign('leave_type_id')->references('id')->on('leave_types');

            $table->unsignedInteger('leave_allocation_id', false);
            $table->foreign('leave_allocation_id')->references('id')->on('leave_allocations');

            $table->decimal('applied_days', 4, 1);
            $table->string('reason', 200)->nullable();
            $table->unsignedInteger('attachment_media_id', false)->nullable();
            $table->foreign('attachment_media_id')->references('id')->on('medias');
            $table->boolean('is_approved')->default(false);

            $table->softDeletes();
			$table->string('created_by', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('leave_request_approvals', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('leave_request_id', false);
            $table->foreign('leave_request_id')->references('id')->on('leave_requests');

            $table->unsignedInteger('approved_by_emp_id', false);
            $table->foreign('approved_by_emp_id')->references('id')->on('employees');

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
        Schema::dropIfExists('leave_request_approvals');
        Schema::dropIfExists('leave_requests');
    }
}
