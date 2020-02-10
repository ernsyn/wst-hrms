<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_transactions', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('emp_id');
            $table->foreign('emp_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');
            
            $table->unsignedInteger('leave_type_id');
            $table->foreign('leave_type_id')
                ->references('id')
                ->on('leave_types')
                ->onDelete('cascade');
                        
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('am_pm', ['am', 'pm'])->nullable();
            
            $table->decimal('applied_days', 4, 1);
            $table->text('reason')->nullable();
            
            $table->unsignedInteger('attachment_media_id')->nullable();
            $table->foreign('attachment_media_id')
                ->references('id')
                ->on('medias')
                ->onDelete('cascade');
            
            $table->integer('status');
            
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
        Schema::dropIfExists('leave_transactions');
    }
}
