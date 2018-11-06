<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialHrmsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TABLE: (UPDATE) users
		Schema::table('users', function (Blueprint $table) {
			// $table->dateTime('last_login')->nullable();
            // $table->string('confirmation_token', 60)->nullable();
            
			$table->string('status', 20)->nullable()->default('Active')->index();
        });
        // TABLE: (NEW) media
        Schema::create('medias', function(Blueprint $table)
		{
            $table->increments('id');

            $table->string('category', 100)->nullable();

            $table->string('filename', 100)->nullable();
            $table->string('mimetype', 100)->nullable();
            $table->binary('data');
            $table->unsignedInteger('size');
			
			$table->string('created_by', 100)->nullable();
            $table->timestamps();
        });


        Schema::create('companies', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('code')->unique('code');

			$table->string('name', 50);
			$table->string('registration_no', 50);
			$table->text('description');
			$table->string('url', 255);
			$table->text('address');
			$table->string('phone', 30);
            
            $table->unsignedInteger('logo_media_id', false)->nullable();
            $table->foreign('logo_media_id')->references('id')->on('medias');
            
			$table->string('gst_no', 50);
			$table->string('tax_no');
			$table->string('epf_no');
			$table->string('socso_no');
            $table->string('eis_no');
            
			$table->string('status', 50);
		
            $table->softDeletes();
			$table->string('created_by', 100)->nullable();
			$table->string('updated_by', 100)->nullable();
            $table->timestamps();
		});

        // TABLE: (NEW) employee
        Schema::create('employees', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('user_id', false);
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('code', 100)->nullable();
			// $table->string('name', 250);
			// $table->string('email', 100);
			$table->string('contact_no', 30)->nullable();
            $table->string('address', 250)->nullable();
            
            $table->unsignedInteger('company_id', false);
            $table->foreign('company_id')->references('id')->on('companies');
            
            $table->date('dob')->nullable();
            $table->enum('gender', ['male', 'female']);
			$table->string('race', 100)->nullable();
            $table->string('nationality', 100)->nullable();
            $table->enum('marital_status', ['single', 'married'])->nullable();
            $table->integer('total_children')->nullable();
            
			$table->string('ic_no', 100)->nullable();
			$table->string('tax_no', 100)->nullable();
			$table->string('epf_no', 100)->nullable();
            $table->string('socso_no', 100)->nullable();
			$table->string('insurance_no', 100)->nullable();
            $table->string('pcb_group', 100)->nullable();
            $table->string('driver_license_no', 100)->nullable();
            $table->date('driver_license_expiry_date')->nullable();

			$table->decimal('basic_salary', 10, 2)->nullable();

			$table->date('confirmed_date')->nullable();
			$table->string('created_by', 100)->nullable();
            $table->timestamps();
        });



        Schema::create('employee_positions', function(Blueprint $table)
		{
            $table->increments('id');
            
			$table->string('name', 250);
            
			$table->string('created_by', 100)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::create('departments', function(Blueprint $table)
		{
            $table->increments('id');
            
			$table->string('name', 250);
            
			$table->string('created_by', 100)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        
        Schema::create('teams', function(Blueprint $table)
		{
			$table->increments('id');
            
            $table->string('name', 250);
            
            $table->softDeletes();
			$table->string('created_by', 100)->nullable();
            $table->timestamps();
        });
        
        Schema::create('cost_centres', function(Blueprint $table)
		{
            $table->increments('id');
            
			$table->string('name', 250);
			$table->enum('seniority_pay', ['auto', 'manual']);
			$table->decimal('amount', 10, 2);
			$table->string('payroll_type');

            $table->softDeletes();
			$table->string('created_by', 100)->nullable();
            $table->timestamps();
        });
        
        Schema::create('employee_grades', function(Blueprint $table)
		{
            $table->increments('id');

            $table->string('name', 250);
            
            $table->softDeletes();
			$table->string('created_by', 100)->nullable();
            $table->timestamps();
        });
        
        Schema::create('branches', function(Blueprint $table)
		{
            $table->increments('id');
            
			$table->string('name', 250);
			$table->string('contact_no_primary', 30);
			$table->string('contact_no_secondary', 30);
			$table->string('fax_no', 30);
			$table->text('address', 250);
			$table->string('country_code', 3);
			$table->string('state', 50);
			$table->string('city', 50);
			$table->string('zip_code', 20);

            $table->softDeletes();
			$table->string('created_by', 100)->nullable();
            $table->timestamps();
		});
        
        // TABLE: (NEW) employee_jobs
        Schema::create('employee_jobs', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('emp_id', false);
            $table->foreign('emp_id')->references('id')->on('employees');
            $table->unsignedInteger('branch_id', false);
            $table->foreign('branch_id')->references('id')->on('branches');

            $table->unsignedInteger('emp_mainposition_id', false)->nullable();
            $table->foreign('emp_mainposition_id')->references('id')->on('employee_positions');
            $table->unsignedInteger('department_id', false)->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->unsignedInteger('team_id', false)->nullable();
            $table->foreign('team_id')->references('id')->on('teams');
            $table->unsignedInteger('cost_centre_id', false)->nullable();
            $table->foreign('cost_centre_id')->references('id')->on('cost_centres');
            $table->unsignedInteger('emp_grade_id', false)->nullable();
            $table->foreign('emp_grade_id')->references('id')->on('employee_grades');

            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('basic_salary', 10, 2);
            $table->text('specification');
            
            $table->unsignedInteger('contract_media_id', false)->nullable();
            $table->foreign('contract_media_id')->references('id')->on('medias');

            $table->string('status', 30);
            
            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });


        // TABLE: (NEW) employee_attachments
        Schema::create('employee_attachments', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('emp_id', false);
            $table->foreign('emp_id')->references('id')->on('employees');

			$table->string('name', 100);
            $table->text('notes');

            $table->unsignedInteger('media_id', false)->nullable();
            $table->foreign('media_id')->references('id')->on('medias');
            
            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });
        
        // TABLE: (NEW) banks
        Schema::create('banks', function(Blueprint $table)
		{
            $table->increments('id');

			$table->string('name', 200);
			$table->string('code', 50)->unique();

            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });
        
        Schema::create('employee_bank_accounts', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('emp_id', false);
            $table->foreign('emp_id')->references('id')->on('employees');

            $table->string('bank_code', 50);
            
			$table->string('acc_no', 50);
            $table->string('acc_status', 20);
            
            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });
        
        Schema::create('employee_dependents', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('emp_id', false);
            $table->foreign('emp_id')->references('id')->on('employees');

            $table->string('name', 200);
			$table->string('relationship', 50);
			$table->date('dob');

            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });
        
        Schema::create('employee_educations', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('emp_id', false);
            $table->foreign('emp_id')->references('id')->on('employees');

			$table->string('institution', 30);
			$table->integer('start_year');
            $table->integer('end_year');

			$table->string('level', 50);
            $table->string('major', 50);
			$table->decimal('gpa', 4, 2);
            
			$table->text('description');
            
            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });
        
        Schema::create('employee_emergency_contacts', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('emp_id', false);
            $table->foreign('emp_id')->references('id')->on('employees');

			$table->string('name', 200);
			$table->string('relationship', 50);
			$table->string('contact_no', 30);

            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });
        
        Schema::create('employee_experiences', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('emp_id', false);
            $table->foreign('emp_id')->references('id')->on('employees');

			$table->string('company', 50);
            $table->string('position', 50);
            
			$table->date('start_date');
            $table->date('end_date');
            
            $table->text('notes');
            
            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });
        
        Schema::create('employee_immigrations', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('emp_id', false);
            $table->foreign('emp_id')->references('id')->on('employees');

            $table->unsignedInteger('document_media_id', false)->nullable();
            $table->foreign('document_media_id')->references('id')->on('medias');

			$table->string('passport_no', 50)->nullable();
			$table->date('expiry_date');
			$table->string('issued_by', 50)->nullable();
            $table->date('issued_date');
            
            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });
        
        Schema::create('employee_languages', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('emp_id', false);
            $table->foreign('emp_id')->references('id')->on('employees');

			$table->string('language', 50);
			$table->string('fluency', 20);
            $table->string('competency', 20);
            
            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });
        
        Schema::create('employee_supervisors', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('emp_id', false);
            $table->foreign('emp_id')->references('id')->on('employees');

            $table->unsignedInteger('supervisor_emp_id', false);
            $table->foreign('supervisor_emp_id')->references('id')->on('employees');

            $table->string('type', 20);
			$table->boolean('kpi_proposer');
            $table->text('notes');
            
            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });
        
        Schema::create('employee_visas', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('emp_id', false);
            $table->foreign('emp_id')->references('id')->on('employees');

            $table->unsignedInteger('document_media_id', false)->nullable();
            $table->foreign('document_media_id')->references('id')->on('medias');

            $table->string('type', 100)->nullable();
			$table->string('visa_number', 100)->nullable();
			$table->string('passport_no')->nullable();
			$table->date('expiry_date');
			$table->string('issued_by', 50)->nullable();
            $table->date('issued_date');

			$table->string('family_members', 100)->nullable();
            
            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });
        
        Schema::create('employee_skills', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('emp_id', false);
            $table->foreign('emp_id')->references('id')->on('employees');

			$table->string('name');
			$table->integer('years_of_experience');
			$table->enum('competency', ['beginner', 'intermediate', 'advanced']);

            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });
        
        Schema::create('employee_working_days', function(Blueprint $table)
		{
            $table->increments('id');
            $table->unsignedInteger('emp_id', false)->nullable();
            $table->foreign('emp_id')->references('id')->on('employees');

            $table->boolean('is_template')->default(false);
			$table->string('template_name', 50)->nullable();

			$table->decimal('monday', 8, 1);
			$table->decimal('tuesday', 8, 1);
			$table->decimal('wednesday', 8, 1);
			$table->decimal('thursday', 8, 1);
			$table->decimal('friday', 8, 1);
			$table->decimal('saturday', 8, 1);
            $table->decimal('sunday', 8, 1);
            
            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('leave_types' ,function(Blueprint $table){
            $table->increments('id');
            $table->string('code',50)->nullable();
            $table->string('name',50)->nullable();
            $table->integer('apply_before_days')->nullable();
            $table->integer('increment_per_year')->nullable();
            $table->integer('approval_level')->nullable();
            $table->integer('carry_forward')->nullable();
            $table->integer('carry_forward_expiry_months')->nullable();
            $table->integer('divide_method')->nullable();
            $table->integer('allow_carry_forward')->nullable();
            $table->string('status',50)->nullable();

            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();


        });

        Schema::create('leave_type_user_groups', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unsignedInteger('id_employee_grade', false);
            $table->foreign('id_employee_grade')->references('id')->on('employee_grades');

            $table->unsignedInteger('id_leave_type'.false);
            $table->foreign('id_leave_type')->references('id')->on('leave_types');
            $table->integer('balance')->nullable();
            $table->integer('year')->nullable();
            $table->integer('carry_forward')->nullable();
          
            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('leave_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id', false);
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('id_leave_type'.false);
            $table->foreign('id_leave_type')->references('id')->on('leave_types');

            $table->integer('start_balance')->nullable();
            $table->integer('carry_forward')->nullable();

            $table->date('start_period')->nullable();
            $table->string('leave_status')->nullablle();
            $table->integer('year_start')->nullable();
            $table->integer('divide')->nullable();
          
            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('leave_employees_requests', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id', false);
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('id_leave_type'.false);
            $table->foreign('id_leave_type')->references('id')->on('leave_types');


            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->integer('total_days')->nullable();
            $table->unsignedInteger('id_attachment_media',false);
            $table->foreign('id_attachment_media')->references('id')->on('medias');

            $table->text('note')->nullable();
            $table->string('status',50)->nullable();
          
            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });


        Schema::create('leave_trx', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('id_leave_employees', false);
            $table->foreign('id_leave_employees')->references('id')->on('leave_employees');

            $table->string('type',50)->nullable();
            $table->integer('amount')->nullable();

            $table->text('note')->nullable();
          
            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('leave_balance', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id', false);
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('id_leave_type'.false);
            $table->foreign('id_leave_type')->references('id')->on('leave_types');


            $table->integer('balance')->nullable();
            $table->integer('year')->nullable();

            $table->integer('carry_forward')->nullable();
          
            $table->softDeletes();
            $table->string('created_by', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('employee_attendances', function (Blueprint $table) {

            $table->increments('id');

            $table->unsignedInteger('user_id', false);
            $table->foreign('user_id')->references('id')->on('users');

            $table->enum('type', ['IN', 'OUT'])->nullable();
          
            $table->unsignedInteger('user_media_id', false);
            $table->foreign('user_media_id')->references('id')->on('medias');
          
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

    {   Schema::dropIfExists('employee_attendances');
        Schema::dropIfExists('leave_trx');
        Schema::dropIfExists('leave_balance');
        Schema::dropIfExists('leave_employees');
        Schema::dropIfExists('leave_employees_requests');
        Schema::dropIfExists('leave_type_user_groups');
        Schema::dropIfExists('leave_types');
        Schema::dropIfExists('employee_working_days');
        Schema::dropIfExists('employee_skills');
        Schema::dropIfExists('employee_visas');
        Schema::dropIfExists('employee_supervisors');
        Schema::dropIfExists('employee_languages');
        Schema::dropIfExists('employee_immigrations');
        Schema::dropIfExists('employee_experiences');
        Schema::dropIfExists('employee_emergency_contacts');
        Schema::dropIfExists('employee_educations');
        Schema::dropIfExists('employee_dependents');
        Schema::dropIfExists('employee_bank_accounts');
        Schema::dropIfExists('banks');
        Schema::dropIfExists('employee_attachments');
        Schema::dropIfExists('employee_jobs');
        Schema::dropIfExists('branches');
        Schema::dropIfExists('employee_grades');
        Schema::dropIfExists('cost_centres');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('employee_positions');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('medias');
        Schema::table('users', function (Blueprint $table) {
			$table->dropColumn('status');
        });
    }
}
