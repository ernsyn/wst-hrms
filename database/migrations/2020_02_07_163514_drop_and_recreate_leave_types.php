<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAndRecreateLeaveTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        
        Schema::dropIfExists('leave_types');
        
        Schema::create('leave_types', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('code', 30)->unique();
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->boolean('is_custom');
            $table->unsignedInteger('subset_entitlement_leave_type_id')->nullable();
            $table->boolean('active');
            
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
//         Schema::dropIfExists('leave_types');
    }
}
