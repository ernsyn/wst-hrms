<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFkLeaveRequestApprovalLeaveRequestIdToLeaveRequestApprovalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('leave_request_approvals', function (Blueprint $table) {
            $table->dropForeign(['leave_request_id']);
            $table->foreign('leave_request_id')
            ->references('id')->on('leave_requests')
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
        Schema::table('leave_request_approvals', function (Blueprint $table) {
            $table->dropForeign(['leave_request_id']);
            $table->foreign('leave_request_id')
            ->references('id')->on('leave_requests')
            ->onDelete('restrict');
        });
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
