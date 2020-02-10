<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLTAppliedRuleCarryForwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lt_applied_rule_carry_forwards', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('lt_applied_rule_id');
            $table->foreign('lt_applied_rule_id')
            ->references('id')
            ->on('lt_applied_rules')
            ->onDelete('cascade');
            
            $table->decimal('max_carry_forward_days',4,1);
            $table->integer('valid_until');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lt_applied_rule_carry_forwards');
    }
}
