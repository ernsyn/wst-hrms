<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_code', function (Blueprint $table) {
            $table->increments('id');
            // $table->timestamps();
            $table->string('name', 100)->nullable();
            $table->string('status', 100)->nullable();            
             
            $table->timestamps();
            $table->softDeletes();
			$table->string('created_by', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_code');
    }
}
