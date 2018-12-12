<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AttendanceRework extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // RENAME: Attendances -> Clock In Out Records
        Schema::table('employee_attendances', function (Blueprint $table) {
            $table->dropForeign(['clock_in_image_media_id']);
            $table->dropForeign(['clock_out_image_media_id']);
            
            $table->dropForeign(['emp_id']);
        });

        Schema::rename('employee_attendances', 'employee_clock_in_out_records');

        Schema::table('employee_clock_in_out_records', function (Blueprint $table) {
            $table->foreign('emp_id')->references('id')->on('employees');
        });

        // NEW: Attendances
        Schema::create('employee_attendances', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('emp_id', false);
            $table->foreign('emp_id')->references('id')->on('employees');

            $table->date('date');
            $table->string('attendance', 30);

			$table->string('created_by', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_attendances');

        Schema::table('employee_clock_in_out_records', function (Blueprint $table) {
            $table->dropForeign(['emp_id']);
        });
        Schema::rename('employee_clock_in_out_records', 'employee_attendances');
        Schema::table('employee_attendances', function (Blueprint $table) {
            $table->foreign('emp_id')->references('id')->on('employees');
            
            $table->foreign('clock_in_image_media_id')->references('id')->on('medias');
            $table->foreign('clock_out_image_media_id')->references('id')->on('medias');
        });
    }
}
