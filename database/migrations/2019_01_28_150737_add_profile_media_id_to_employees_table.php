<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfileMediaIdToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->unsignedInteger('profile_media_id', false)->nullable();
            $table->foreign('profile_media_id')->references('id')->on('medias');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['profile_media_id']);
            $table->dropColumn('profile_media_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['profile_media_id']);
            $table->dropColumn('profile_media_id');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('profile_media_id', false)->nullable();
            $table->foreign('profile_media_id')->references('id')->on('medias');
        });
    }
}
