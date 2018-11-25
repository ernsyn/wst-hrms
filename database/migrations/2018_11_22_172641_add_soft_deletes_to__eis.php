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
        Schema::table('Eis', function($table) {
            $table->timestamps();
             $table->softDeletes();
        });
        Schema::table('Pcbs', function($table) {
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
        Schema::table('Eis', function($table) {
            $table->dropColumn('timestamps');
        });
        Schema::table('Pcbs', function($table) {
            $table->dropColumn('timestamps');
        });
    }
}
