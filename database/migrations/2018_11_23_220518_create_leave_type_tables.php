<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveTypeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->increments('id');

            $table->string('code', 30)->unique();
            $table->string('name', 100)->unique();
            $table->text('description')->nullable();
            $table->boolean('is_custom')->default(true);
            
			$table->decimal('entitled_days', 4, 1)->nullable();
            $table->unsignedInteger('subset_entitlement_leave_type_id')->nullable();

            $table->boolean('active')->default(false);

            $table->softDeletes();
			$table->string('created_by', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('lt_applied_rules', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('leave_type_id', false);
            $table->foreign('leave_type_id')->references('id')->on('leave_types');

            $table->string('rule', 50);
            $table->json('configuration')->nullable();

            $table->softDeletes();
			$table->string('created_by', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('lt_entitlement_grade_groups', function (Blueprint $table) {
            // Pivot table
            $table->increments('id');

            $table->unsignedInteger('leave_type_id', false);
            $table->foreign('leave_type_id')->references('id')->on('leave_types');

            $table->decimal('entitled_days', 4, 1)->nullable();

            $table->softDeletes();
			$table->string('created_by', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('lt_entitlement_grade_group_grades', function (Blueprint $table) {
            // Pivot table
            $table->increments('id');

            $table->unsignedInteger('lt_entitlement_gg_id', false);
            $table->foreign('lt_entitlement_gg_id')->references('id')->on('lt_entitlement_grade_groups');
            $table->unsignedInteger('grade_id', false);
            $table->foreign('grade_id')->references('id')->on('employee_grades');
        });

        Schema::create('lt_conditional_entitlements', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('leave_type_id', false)->nullable();
            $table->foreign('leave_type_id')->references('id')->on('leave_types');
            $table->unsignedInteger('lt_entitlement_gg_id', false)->nullable();
            $table->foreign('lt_entitlement_gg_id')->references('id')->on('lt_entitlement_grade_groups');

            $table->unsignedInteger('min_years', false);
			$table->decimal('entitled_days', 4, 1);

            $table->softDeletes();
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
        Schema::dropIfExists('lt_entitlement_grade_group_grades');
        Schema::dropIfExists('lt_conditional_entitlements');
        Schema::dropIfExists('lt_entitlement_grade_groups');
        Schema::dropIfExists('lt_applied_rules');
        Schema::dropIfExists('leave_types');
    }
}
