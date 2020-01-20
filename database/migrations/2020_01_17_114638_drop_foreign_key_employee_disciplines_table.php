<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropForeignKeyEmployeeDisciplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_disciplines', function (Blueprint $table) {
            $table->dropForeign('employee_disciplines_created_by_foreign');
        });
        Schema::table('employee_disciplines', function($table) {
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_disciplines', function (Blueprint $table) {
            //
        });
    }
}
