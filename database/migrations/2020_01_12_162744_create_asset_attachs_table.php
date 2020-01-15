<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetAttachsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_attachs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('filename');
            $table->integer('asset_id')->unsigned();            
        });

        Schema::table('asset_attachs', function($table) {
            $table->foreign('asset_id')->references('id')->on('employee_assets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_attachs');
    }
}
