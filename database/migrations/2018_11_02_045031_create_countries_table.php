<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('countries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('capital')->nullable();
			$table->string('citizenship')->nullable();
			$table->string('country_code', 3)->default('');
			$table->string('currency')->nullable();
			$table->string('currency_code')->nullable();
			$table->string('currency_sub_unit')->nullable();
			$table->string('currency_symbol', 3)->nullable();
			$table->string('full_name')->nullable();
			$table->string('iso_3166_2', 2)->default('');
			$table->string('iso_3166_3', 3)->default('');
			$table->string('name')->default('');
			$table->string('region_code', 3)->default('');
			$table->string('sub_region_code', 3)->default('');
			$table->boolean('eea')->default(0);
			$table->string('calling_code', 3)->nullable();
			$table->string('flag', 6)->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
