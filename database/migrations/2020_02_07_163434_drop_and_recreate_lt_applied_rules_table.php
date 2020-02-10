<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAndRecreateLTAppliedRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        
        Schema::dropIfExists('lt_applied_rules');
        
        Schema::create('lt_applied_rules', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('leave_type_id');
            $table->foreign('leave_type_id')
                ->references('id')
                ->on('leave_types')
                ->onDelete('cascade');
            
            $table->string('rule', 255);
            $table->text('value')->nullable();
            
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
//         Schema::dropIfExists('lt_applied_rules');
    }
}
