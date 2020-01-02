<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSpouseToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {

              $table->string('spouse_name')->nullable();
              $table->string('spouse_ic')->nullable();
              $table->string('spouse_tax_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('spouse_name');
			$table->dropColumn('spouse_ic');
			$table->dropColumn('spouse_tax_no');
        });
    }
}
