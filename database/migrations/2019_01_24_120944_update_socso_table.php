<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSocsoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('socsos', function (Blueprint $table) {
            $table->integer('category')->after('id');
            $table->renameColumn('first_category_employer', 'employer');
            $table->renameColumn('first_category_employee', 'employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('socsos', function (Blueprint $table) {
            $table->dropColumn('category');
            $table->renameColumn('employer', 'first_category_employer');
            $table->renameColumn('employee', 'first_category_employee');
        });
    }
}
