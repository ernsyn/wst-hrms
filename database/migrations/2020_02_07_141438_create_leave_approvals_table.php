<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_approvals', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('leave_transaction_id');
            $table->foreign('leave_transaction_id')
            ->references('id')
            ->on('leave_transactions')
            ->onDelete('cascade');
            
            $table->softDeletes();
            
            $table->unsignedInteger('created_by');
            $table->foreign('created_by')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            
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
        Schema::dropIfExists('leave_approvals');
    }
}
