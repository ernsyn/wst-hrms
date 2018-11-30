<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEmployeeAttendancesTableAddImageMediaId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_attendances', function (Blueprint $table) {
            $table->unsignedInteger('clock_in_image_media_id', false)->nullable();
            $table->foreign('clock_in_image_media_id')->references('id')->on('medias');

            $table->unsignedInteger('clock_out_image_media_id', false)->nullable();
            $table->foreign('clock_out_image_media_id')->references('id')->on('medias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_attendances', function (Blueprint $table) {
            $table->dropForeign(['clock_in_image_media_id']);
            $table->dropColumn('clock_in_image_media_id');
            $table->dropForeign(['clock_out_image_media_id']);
            $table->dropColumn('clock_out_image_media_id');
        });
    }
}
