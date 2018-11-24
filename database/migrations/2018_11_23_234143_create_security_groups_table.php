<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSecurityGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('security_groups', function (Blueprint $table) {
            $table->increments('id');
         
            $table->string('name')->nullable();
			$table->string('description')->nullable();
			$table->integer('company_id')->nullable();
			$table->string('status')->nullable();
			$table->integer('created_by')->nullable();
         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('security_groups');
    }
}
