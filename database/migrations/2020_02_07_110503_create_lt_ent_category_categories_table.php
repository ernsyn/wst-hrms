<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLTEntCategoryCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lt_ent_category_categories', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('lt_ent_category_id');
            $table->foreign('lt_ent_category_id')
            ->references('id')
            ->on('lt_ent_categories')
            ->onDelete('cascade');
            
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lt_ent_category_categories');
    }
}
