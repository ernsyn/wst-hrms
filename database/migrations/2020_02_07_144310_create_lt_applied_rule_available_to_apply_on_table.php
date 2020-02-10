<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLTAppliedRuleAvailableToApplyOnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lt_applied_rule_available_to_apply_on', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('lt_applied_rule_id');
            $table->foreign('lt_applied_rule_id')
            ->references('id')
            ->on('lt_applied_rules')
            ->onDelete('cascade');
            
            $table->string('day',100);
            $table->integer('valid_with_month');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lt_applied_rule_available_to_apply_on');
    }
}
