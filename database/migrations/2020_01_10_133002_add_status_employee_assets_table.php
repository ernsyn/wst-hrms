<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusEmployeeAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('employee_assets', 'asset_status')) {
            Schema::table('employee_assets', function (Blueprint $table) {
                $table->dropColumn('asset_status');
            });
        }
        
        Schema::table('employee_assets', function (Blueprint $table) {
             $table->integer('asset_status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_assets', function (Blueprint $table) {
           $table->dropColumn('asset_status');
        });
    }
}
