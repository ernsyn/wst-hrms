<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_assets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('emp_id')->unsigned();
            $table->string('asset_name');
            $table->integer('asset_quantity');
            $table->string('asset_spec')->nullable();
            $table->date('issue_date');
            $table->string('asset_deposit')->nullable();
            $table->date('return_date')->nullable()->default(null);
            $table->date('sold_date')->nullable()->default(null);
            $table->string('asset_attach')->nullable();
            $table->enum('asset_status', ['Hold', 'Return','Sold'])->default('Hold');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_assets');
    }
}
