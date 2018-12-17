<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAdditionCostCentreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('addition_cost_centre', function (Blueprint $table) {
            //
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('deduction_cost_centre', function (Blueprint $table) {
            //
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('company_bank', function (Blueprint $table) {
            //
            $table->string('acc_name',50)->nullable;
            $table->string('status',50)->nullable;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_bank', function (Blueprint $table) {
            $table->dropColumn('acc_name');
            $table->dropColumn('status');
        });

        Schema::table('deduction_cost_centre', function (Blueprint $table) {
            $table->dropColumn('updated_at');
            $table->dropColumn('created_at');
            $table->dropColumn('deleted_at');
        });

        Schema::table('addition_cost_centre', function (Blueprint $table) {
            $table->dropColumn('updated_at');
            $table->dropColumn('created_at');
            $table->dropColumn('deleted_at');
        });
    }
}
