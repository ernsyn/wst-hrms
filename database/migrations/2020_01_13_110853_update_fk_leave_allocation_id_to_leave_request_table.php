<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFkLeaveAllocationIdToLeaveRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('leave_requests', function (Blueprint $table) {
            $table->dropForeign(['leave_allocation_id']);
            $table->foreign('leave_allocation_id')
            ->references('id')->on('leave_allocations')
            ->onDelete('cascade');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('leave_requests', function (Blueprint $table) {
            $table->dropForeign(['leave_allocation_id']);
            $table->foreign('leave_allocation_id')
            ->references('id')->on('leave_allocations')
            ->onDelete('restrict');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
