<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndustryAndContactPersonTelToEmployeeExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_experiences', function (Blueprint $table) {
            $table->string('industry', 100)->after('position');
            $table->string('contact', 100)->after('industry');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_experiences', function (Blueprint $table) {
            $table->dropColumn('industry');
            $table->dropColumn('contact');
        });
    }
}
