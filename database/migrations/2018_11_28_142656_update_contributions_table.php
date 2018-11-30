<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('epfs', function ($table) {
            $table->decimal('employer', 10, 2)->default(0)->change();
            $table->decimal('employee', 10, 2)->default(0)->change();
        });
        
        Schema::table('eis', function ($table) {
            $table->decimal('employer', 10, 2)->default(0)->change();
            $table->decimal('employee', 10, 2)->default(0)->change();
        });
        
        Schema::table('socsos', function ($table) {
            $table->decimal('first_category_employer', 10, 2)->default(0)->change();
            $table->decimal('first_category_employee', 10, 2)->default(0)->change();
        });
        
        Schema::table('pcbs', function ($table) {
            $table->integer('total_children')->default(0)->change();
            $table->decimal('amount', 10, 2)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
