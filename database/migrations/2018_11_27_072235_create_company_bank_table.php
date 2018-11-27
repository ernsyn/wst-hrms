<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_bank', function (Blueprint $table) {
            $table->increments('id');
     

            // $table->increments('id');
            // $table->timestamps();
    
            $table->unsignedInteger('company_id', false)->nullable();
            $table->foreign('company_id')->references('id')->on('companies');
   
            $table->unsignedInteger('bank_code', false)->nullable();
            $table->foreign('bank_code')->references('id')->on('bank_code');    
             
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
        Schema::dropIfExists('company_bank');
    }
}
