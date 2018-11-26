<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTravelAllowanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_travel_allowance', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

       
         
                $table->unsignedInteger('company_id', false);
                $table->foreign('company_id')->references('id')->on('companies');
    
                $table->string('code', 100);
                $table->decimal('rate', 8, 2);
    
                $table->unsignedInteger('countries_id', false)->nullable();
                $table->foreign('countries_id')->references('id')->on('countries');
                
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
        Schema::dropIfExists('company_travel_allowance');
    }
}
