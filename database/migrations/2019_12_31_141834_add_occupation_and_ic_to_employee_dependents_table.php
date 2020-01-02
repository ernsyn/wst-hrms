<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOccupationAndIcToEmployeeDependentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_dependents', function (Blueprint $table) {
            $table->string('occupation', 100)->after('name')->nullable();
            $table->string('ic_no', 100)->after('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_dependents', function (Blueprint $table) {
            $table->dropColumn('occupation');
            $table->dropColumn('ic_no');
        });
    }
}
