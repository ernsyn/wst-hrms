<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMainSecurityGroupIdToEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function($table) {
            $table->integer('main_security_group_id')->nullable();

        });//
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { Schema::table('employees', function($table) {

 
  
    });
    }
}
