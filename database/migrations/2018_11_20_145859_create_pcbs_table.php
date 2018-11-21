<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePcbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pcbs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('total_children', 100)->nullable();
            $table->string('category', 100)->nullable();
            $table->string('amount', 100)->nullable();

			$table->decimal('salary', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pcbs');
    }
}
