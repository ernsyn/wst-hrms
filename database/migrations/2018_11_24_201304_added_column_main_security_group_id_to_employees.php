<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedColumnMainSecurityGroupIdToEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function($table) {
  

            $table->unsignedInteger('main_security_group_id', false);
            $table->foreign('main_security_group_id')->references('id')->on('security_groups');
        });//
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { Schema::table('employees', function($table) {
        $table->dropColumn('main_security_group_id');
    });
    }
}
