<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_allocations', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('emp_id', false);
            $table->foreign('emp_id')->references('id')->on('employees');

            $table->unsignedInteger('leave_type_id', false);
            $table->foreign('leave_type_id')->references('id')->on('leave_types');

            $table->decimal('allocated_days', 4, 1);
            $table->decimal('spent_days', 4, 1)->nullable();
            $table->decimal('carried_forward_days', 4, 1)->nullable();

            $table->boolean('is_carry_forward')->default(false);

            $table->date('valid_from_date');
            $table->date('valid_until_date');

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
        Schema::dropIfExists('leave_allocations');
    }
}
