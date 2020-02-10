<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLTAppliedRuleMinApplyDaysBeforeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lt_applied_rule_min_apply_days_before', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('lt_applied_rule_id');
            $table->foreign('lt_applied_rule_id')
            ->references('id')
            ->on('lt_applied_rules')
            ->onDelete('cascade');
            
            $table->integer('min_leave_days');
            $table->integer('min_apply_days_before');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lt_applied_rule_min_apply_days_before');
    }
}
