<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletesToEis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eis', function($table) {
            $table->timestamps();
             $table->softDeletes();
        });
        Schema::table('pcbs', function($table) {
            $table->timestamps();
             $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eis', function($table) {
            $table->dropColumn('timestamps');
        });
        Schema::table('pcbs', function($table) {
            $table->dropColumn('timestamps');
        });
    }
}
