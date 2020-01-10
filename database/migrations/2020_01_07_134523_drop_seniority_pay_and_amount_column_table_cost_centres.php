<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropSeniorityPayAndAmountColumnTableCostCentres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cost_centres', function (Blueprint $table) {
            $table->dropColumn('seniority_pay');
            $table->dropColumn('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cost_centres', function (Blueprint $table) {
            $table->enum('seniority_pay', ['auto', 'manual']);
            $table->decimal('amount', 10, 2);
        });
    }
}
