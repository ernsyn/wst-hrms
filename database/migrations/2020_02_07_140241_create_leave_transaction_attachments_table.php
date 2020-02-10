<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveTransactionAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_transaction_attachments', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('leave_transaction_id');
            $table->foreign('leave_transaction_id')
            ->references('id')
            ->on('leave_transactions')
            ->onDelete('cascade');
            
            $table->text('attachment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_transaction_attachments');
    }
}
