<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('/');
});


Auth::routes();


// MODE: Employee
Route::group(['middleware' => ['auth', 'role:employee']], function() {
    Route::get('', 'HomeController@index')->name('employee.dashboard');

    // Route::get('/employee','EmployeeController@displayProfile')->name('employee');
    // Route::get('profile','EmployeeController@displayProfile')->name('profile');
    Route::get('dependentdata','EmployeeController@displayEmployeeDependent')->name('dependent');
    Route::get('employeeimmigrationdata','EmployeeController@displayImmigration')->name('immigration');
    Route::get('qualificationcompaniesdata','EmployeeController@displayQualificationCompanies')->name('companies');
    Route::get('qualificationeducationsdata','EmployeeController@displayQualificationEducations')->name('educations');
    Route::get('qualificationskillsdata','EmployeeController@displayQualificationSkills')->name('skills');
    Route::get('employeevisadata','EmployeeController@displayVisa')->name('visa');
    Route::get('employeebankdata','EmployeeController@displayBank')->name('bank');
    Route::get('jobdata','EmployeeController@displayJob')->name('job');
    Route::get('reporttodata','EmployeeController@displayReportTo')->name('reportto');
    Route::get('historydata','EmployeeController@displayHistory')->name('history');
    Route::get('attachmentdata','EmployeeController@displayAttachment')->name('attachment');

    Route::get('/employee','Employee\EmployeeController@displayProfile')->name('employee');
    Route::get('/profile','Employee\EmployeeController@displayProfile')->name('employee.profile');
    Route::get('employees/id/working-days/{emp_id}', 'Employee\EmployeeController@getEmployeeWorkingDay')->name('employee.id.working-day.get')->where('id', '[0-9]+');

    // Data Tables
    Route::get('employee/dt/emergency-contacts', 'Employee\EmployeeController@getDataTableEmergencyContacts')->name('employee.dt.emergency-contacts');
    Route::get('employee/dt/dependents', 'Employee\EmployeeController@getDataTableDependents')->name('employee.dt.dependents');
    Route::get('employee/dt/immigrations', 'Employee\EmployeeController@getDataTableImmigrations')->name('employee.dt.immigrations');
    Route::get('employee/dt/visas', 'Employee\EmployeeController@getDataTableVisas')->name('employee.dt.visas');
    Route::get('employee/dt/bank-accounts', 'Employee\EmployeeController@getDataTableBankAccounts')->name('employee.dt.bank-accounts');
    Route::get('employee/dt/jobs', 'Employee\EmployeeController@getDataTableJobs')->name('employee.dt.jobs');
    Route::get('employee/dt/experiences', 'Employee\EmployeeController@getDataTableExperiences')->name('employee.dt.experiences');
    Route::get('employee/dt/education', 'Employee\EmployeeController@getDataTableEducation')->name('employee.dt.education');
    Route::get('employee/dt/skills', 'Employee\EmployeeController@getDataTableSkills')->name('employee.dt.skills');
    Route::get('employee/dt/attachments', 'Employee\EmployeeController@getDataTableAttachments')->name('employee.dt.attachments');

    Route::get('employee/dt/security-groups', 'Employee\EmployeeController@getDataTableSecurityGroup')->name('employee.dt.security-groups');
    Route::get('employee/dt/report-to', 'Employee\EmployeeController@getDataTableReportTo')->name('employee.dt.report-to');

    Route::post('employee/{id}/emergency-contacts','Employee\EmployeeController@postEmergencyContact')->name('employee.emergency-contacts.post');
    Route::post('employee/{id}/dependents','Employee\EmployeeController@postDependent')->name('employee.dependents.post');
    Route::post('employee/{id}/immigrations','Employee\EmployeeController@postImmigration')->name('employee.immigrations.post');
    Route::post('employee/{id}/visas','Employee\EmployeeController@postVisa')->name('employee.visas.post');
    Route::post('employee/{id}/jobs','Employee\EmployeeController@postJob')->name('employee.jobs.post');
    Route::post('employee/{id}/bank-accounts','Employee\EmployeeController@postBankAccount')->name('employee.bank-accounts.post');
    Route::post('employee/{id}/companies','Employee\EmployeeController@postCompany')->name('employee.companies.post');
    Route::post('employee/{id}/education','Employee\EmployeeController@postEducation')->name('employee.educations.post');
    Route::post('employee/{id}/skills','Employee\EmployeeController@postSkill')->name('employee.skills.post');
    Route::post('employee/{id}/attachments','Employee\EmployeeController@postAttachment')->name('employee.attachments.post');
    Route::post('employee/{id}/working-day','Employee\EmployeeController@postWorkingDay')->name('employee.working-days.post')->where('id', '[0-9]+');
    Route::post('employee/{id}/report-tp','Employee\EmployeeController@postReportTo')->name('employee.report-to.post');
    Route::post('employee/{id}/main-security-group','Employee\EleaveController@displayLeaveRequestReportTo')->name('employees.main-security-group.post');

    Route::post('employee/{id}/edit','Employee\EmployeeController@postEditProfile')->name('employee.profile.edit.post');

    Route::post('employee/{emp_id}/emergency-contacts/{id}/edit','Employee\EmployeeController@postEditEmergencyContact')->name('employee.emergency-contacts.edit.post');
    Route::post('employee/{emp_id}/dependents/{id}/edit','Employee\EmployeeController@postEditDependent')->name('employee.dependents.edit.post');
    Route::post('employee/{emp_id}/immigrations/{id}/edit','Employee\EmployeeController@postEditImmigration')->name('employee.immigrations.edit.post');
    Route::post('employee/{emp_id}/visas/{id}/edit','Employee\EmployeeController@postEditVisa')->name('employee.visas.edit.post');
    Route::post('employee/{emp_id}/bank-accounts/{id}/edit','Employee\EmployeeController@postEditBankAccount')->name('employee.bank-accounts.edit.post');
    Route::post('employee/{emp_id}/companies/{id}/edit','Employee\EmployeeController@postEditCompany')->name('employee.companies.edit.post');
    Route::post('employee/{emp_id}/education/{id}/edit','Employee\EmployeeController@postEditEducation')->name('employee.educations.edit.post');
    Route::post('employee/{emp_id}/skills/{id}/edit','Employee\EmployeeController@postEditSkill')->name('employee.skills.edit.post');
    Route::post('employee/{emp_id}/attachments/{id}/edit','Employee\EmployeeController@postEditAttachment')->name('employee.attachments.edit.post');
    Route::post('employee/{emp_id}/report-tp/{id}/edit','Employee\EmployeeController@postEditReportTo')->name('employee.report-to.edit.post');

    //to be edit
    Route::post('add_leave_application','Employee\EleaveController@addLeaveApplication')->name('add_leave_application');
    Route::get('leaveapplication','Employee\EleaveController@displayLeaveApplication')->name('leaveapplication');
   // Route::get('leavetype','EmployeeController@displayEmployeeLeave')->name('employee/leavetype');
    Route::get('leaverequest','Employee\EleaveController@displayLeaveRequestReportTo')->name('leaverequest');

    //admin/employee/delete
    Route::get('employees/{emp_id}/emergency-contacts/{id}/delete','Employee\EmployeeController@deleteEmergencyContact')->name('employee.emergency-contacts.delete');
    Route::get('employees/{emp_id}/dependents/{id}/delete','Employee\EmployeeController@deleteDependent')->name('employee.dependents.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/bank-accounts/{id}/delete','Employee\EmployeeController@deleteBankAccount')->name('employee.bank-accounts.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/experiences/{id}/delete','Employee\EmployeeController@deleteExperience')->name('employee.experiences.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/educations/{id}/delete','Employee\EmployeeController@deleteEducation')->name('employee.educations.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/skills/{id}/delete','Employee\EmployeeController@deleteSkill')->name('employee.skills.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/visas/{id}/delete','Employee\EmployeeController@deleteVisa')->name('employee.visas.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/immigrations/{id}/delete','Employee\EmployeeController@deleteImmigration')->name('employee.immigrations.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/attachments/{id}/delete','Employee\EmployeeController@deleteAttachment')->name('employee.attachments.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/report-tos/{id}/delete','Employee\EmployeeController@deleteReportTo')->name('employee.report-tos.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/security-groups/{id}/delete','Employee\EmployeeController@deleteSecurityGroup')->name('employee.security-groups.delete')->where('id', '[0-9]+');
});

// MODE: Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:super-admin|admin']], function() {
    Route::get('', 'Admin\DashboardController@index')->name('admin.dashboard');


    // SECTION: EMPLOYEE
    // > View
    Route::get('employees', 'Admin\EmployeeController@index')->name('admin.employees');
    Route::get('employees/{id}','Admin\EmployeeController@display')->name('admin.employees.id')->where('id', '[0-9]+');

    // > Data Tables
    Route::get('employees/{id}/dt/dependents', 'Admin\EmployeeController@getDataTableDependents')->name('admin.employees.dt.dependents')->where('id', '[0-9]+');
    Route::get('employees/{id}/dt/immigrations', 'Admin\EmployeeController@getDataTableImmigrations')->name('admin.employees.dt.immigrations')->where('id', '[0-9]+');
    Route::get('employees/{id}/dt/visas', 'Admin\EmployeeController@getDataTableVisas')->name('admin.employees.dt.visas')->where('id', '[0-9]+');
    Route::get('employees/{id}/dt/bank-accounts', 'Admin\EmployeeController@getDataTableBankAccounts')->name('admin.employees.dt.bank-accounts')->where('id', '[0-9]+');
    Route::get('employees/{id}/dt/jobs', 'Admin\EmployeeController@getDataTableJobs')->name('admin.employees.dt.jobs')->where('id', '[0-9]+');
    Route::get('employees/{id}/dt/experiences', 'Admin\EmployeeController@getDataTableExperiences')->name('admin.employees.dt.experiences')->where('id', '[0-9]+');
    Route::get('employees/{id}/dt/education', 'Admin\EmployeeController@getDataTableEducation')->name('admin.employees.dt.education')->where('id', '[0-9]+');
    Route::get('employees/{id}/dt/skills', 'Admin\EmployeeController@getDataTableSkills')->name('admin.employees.dt.skills')->where('id', '[0-9]+');
    Route::get('employees/{id}/dt/attachments', 'Admin\EmployeeController@getDataTableAttachments')->name('admin.employees.dt.attachments')->where('id', '[0-9]+');
    Route::get('employees/{id}/dt/emergency-contacts', 'Admin\EmployeeController@getDataTableEmergencyContacts')->name('admin.employees.dt.emergency-contacts')->where('id', '[0-9]+');
    Route::get('employees/{id}/dt/report-to', 'Admin\EmployeeController@getDataTableReportTo')->name('admin.employees.dt.report-to')->where('id', '[0-9]+');
    Route::get('company/{id}/dt/company-banks', 'Admin\SettingsController@getDataTableCompanyBank')->name('admin.companies.dt.company-banks')->where('id', '[0-9]+');

    Route::get('employees/{id}/dt/main-security-groups', 'Admin\EmployeeController@getDataTableMainSecurityGroup')->name('admin.employees.dt.main-security-group')->where('id', '[0-9]+');
    Route::get('employees/{id}/dt/security-groups', 'Admin\EmployeeController@getDataTableSecurityGroup')->name('admin.employees.dt.security-groups')->where('id', '[0-9]+');

    Route::get('employees/{id}/details/security-groups', 'Admin\EmployeeController@displaySecurityGroup')->name('admin.employees.id.security-groups')->where('id', '[0-9]+');


    // > Add / Edit
    Route::get('employees/add', 'Admin\EmployeeController@add')->name('admin.employees.add');
    Route::post('employees/add','Admin\EmployeeController@postAdd')->name('admin.employees.add.post');
    Route::get('employees/id/working-days/{emp_id}', 'Admin\EmployeeController@getEmployeeWorkingDay')->name('admin.employees.id.working-day.get')->where('id', '[0-9]+');

    Route::post('employees/{emp_id}/jobs','Admin\EmployeeController@postJob')->name('admin.employees.jobs.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/emergency-contacts','Admin\EmployeeController@postEmergencyContact')->name('admin.employees.emergency-contacts.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/dependents','Admin\EmployeeController@postDependent')->name('admin.employees.dependents.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/immigrations','Admin\EmployeeController@postImmigration')->name('admin.employees.immigrations.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/visas','Admin\EmployeeController@postVisa')->name('admin.employees.visas.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/bank-accounts','Admin\EmployeeController@postBankAccount')->name('admin.employees.bank-accounts.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/companies','Admin\EmployeeController@postCompany')->name('admin.employees.companies.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/educations','Admin\EmployeeController@postEducation')->name('admin.employees.educations.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/skills','Admin\EmployeeController@postSkill')->name('admin.employees.skills.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/report-tp','Admin\EmployeeController@postReportTo')->name('admin.employees.report-to.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/security-group','Admin\EmployeeController@postSecurityGroup')->name('admin.employees.security-groups.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/main-security-group','Admin\EmployeeController@postMainSecurityGroup')->name('admin.employees.main-security-groups.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/report-to','Admin\EmployeeController@postReportTo')->name('admin.employees.report-to.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/working-day','Admin\EmployeeController@postWorkingDay')->name('admin.employees.working-days.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/attachments','Admin\EmployeeController@postAttachment')->name('admin.employees.attachments.post')->where('id', '[0-9]+');

    Route::post('add_report_to','AdminController@addReportTo')->name('add_report_to'); // TODO
    Route::post('employees/{id}/edit','Admin\EmployeeController@postEditProfile')->name('admin.employees.profile.edit.post')->where('id', '[0-9]+');

    Route::post('employees/{emp_id}/dependents/{id}/edit','Admin\EmployeeController@postEditDependent')->name('admin.employees.dependents.edit.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/emergency-contacts/{id}/edit','Admin\EmployeeController@postEditEmergencyContact')->name('admin.employees.emergency-contacts.edit.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/immigrations/{id}/edit','Admin\EmployeeController@postEditImmigration')->name('admin.employees.immigrations.edit.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/visas/{id}/edit','Admin\EmployeeController@postEditVisa')->name('admin.employees.visas.edit.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/bank-accounts/{id}/edit','Admin\EmployeeController@postEditBankAccount')->name('admin.employees.bank-accounts.edit')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/companies/{id}/edit','Admin\EmployeeController@postEditCompany')->name('admin.employees.companies.edit')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/education/{id}/edit','Admin\EmployeeController@postEditEducation')->name('admin.employees.education.edit')->where('id', '[0-9]+');

    Route::post('employees/{emp_id}/security-group/{id}/edit','Admin\EmployeeController@postEditSecurityGroup')->name('admin.employees.security-groups.edit.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/security-group/{id}/delete','Admin\EmployeeController@postDeleteSecurityGroup')->name('admin.employees.security-groups.delete')->where('id', '[0-9]+');

    Route::post('employees/{emp_id}/bank-accounts/{id}/edit','Admin\EmployeeController@postEditBankAccount')->name('admin.employees.bank-accounts.edit.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/companies/{id}/edit','Admin\EmployeeController@postEditCompany')->name('admin.employees.companies.edit.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/education/{id}/edit','Admin\EmployeeController@postEditEducation')->name('admin.employees.educations.edit.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/skills/{id}/edit','Admin\EmployeeController@postEditSkill')->name('admin.employees.skills.edit.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/attachments/{id}/edit','Admin\EmployeeController@postEditAttachment')->name('admin.employees.attachments.edit.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/report-to/{id}/edit','Admin\EmployeeController@postEditReportTo')->name('admin.employees.report-to.edit.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/working-day/edit','Admin\EmployeeController@postEditWorkingDay')->name('admin.employees.working-day.edit.post')->where('id', '[0-9]+');


    //admin/employee/delete
    Route::get('employees/{emp_id}/emergency-contacts/{id}/delete','Admin\EmployeeController@deleteEmergencyContact')->name('admin.settings.emergency-contacts.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/dependents/{id}/delete','Admin\EmployeeController@deleteDependent')->name('admin.settings.dependents.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/bank-accounts/{id}/delete','Admin\EmployeeController@deleteBankAccount')->name('admin.settings.bank-accounts.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/experiences/{id}/delete','Admin\EmployeeController@deleteExperience')->name('admin.settings.experiences.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/educations/{id}/delete','Admin\EmployeeController@deleteEducation')->name('admin.settings.educations.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/skills/{id}/delete','Admin\EmployeeController@deleteSkill')->name('admin.settings.skills.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/visas/{id}/delete','Admin\EmployeeController@deleteVisa')->name('admin.settings.visas.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/immigrations/{id}/delete','Admin\EmployeeController@deleteImmigration')->name('admin.settings.immigrations.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/attachments/{id}/delete','Admin\EmployeeController@deleteAttachment')->name('admin.settings.attachments.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/report-tos/{id}/delete','Admin\EmployeeController@deleteReportTo')->name('admin.settings.report-tos.delete')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/security-groups/{id}/delete','Admin\EmployeeController@deleteSecurityGroup')->name('admin.settings.security-groups.delete')->where('id', '[0-9]+');


    // SECTION: SETTINGS

    // > View - List
    Route::get('settings/companies', 'Admin\SettingsController@displayCompanies')->name('admin.settings.companies');
    // Route::get('settings/add-company', 'Admin\SettingsController@displayAddCompany')->name('admin.settings.add-company');
    Route::get('settings/jobs', 'Admin\SettingsController@displayJobs')->name('admin-settings-jobs');
    Route::get('settings/cost-centres', 'Admin\SettingsController@displayCostCentres')->name('admin.settings.cost-centres');
    Route::get('settings/departments', 'Admin\SettingsController@displayDepartments')->name('admin.settings.departments');
    Route::get('settings/teams', 'Admin\SettingsController@displayTeams')->name('admin.settings.teams');
    Route::get('settings/positions', 'Admin\SettingsController@displayPositions')->name('admin.settings.positions');
    Route::get('settings/grades', 'Admin\SettingsController@displayGrades')->name('admin.settings.grades');
    Route::get('settings/branches', 'Admin\SettingsController@displayBranches')->name('admin.settings.branches');
    Route::get('settings/epf', 'Admin\SettingsController@displayEpf')->name('admin.settings.epf');
    Route::get('settings/eis', 'Admin\SettingsController@displayEis')->name('admin.settings.eis');
    Route::get('settings/socso', 'Admin\SettingsController@displaySocso')->name('admin.settings.socso');
    Route::get('settings/pcb', 'Admin\SettingsController@displayPcb')->name('admin.settings.pcb');
    Route::get('settings/working-days', 'Admin\SettingsController@displayWorkingDays')->name('admin.settings.working-days');

    Route::get('settings/deduction', 'Admin\SettingsController@displayCompanyDeduction')->name('admin.settings.deductions');
    Route::get('settings/addition', 'Admin\SettingsController@displayCompanyAddition')->name('admin.settings.additions');
    Route::get('settings/company-banks', 'Admin\SettingsController@displayCompanyBank')->name('admin.settings.company-banks');

    Route::get('e-leave/configuration/leaveholidays', 'Admin\ELeaveController@displayPublicHolidays')->name('admin.e-leave.configuration.leaveholidays');
    Route::get('e-leave/configuration/leavebalances', 'Admin\ELeaveController@displayLeaveBalances')->name('admin.e-leave.configuration.leavebalances');
    Route::get('e-leave/configuration/leavetypes', 'Admin\ELeaveController@displayLeaveTypes')->name('admin.e-leave.configuration.leavetypes');
    Route::get('e-leave/configuration/leaverequests', 'Admin\ELeaveController@displayLeaveRequests')->name('admin.e-leave.configuration.leaverequests');



    //leave public holidays setup
    // Route::get('e-leave/configuration/leaveholidays/add','Admin\ELeaveController@addPublicHoliday')->name('admin.e-leave.configuration.leaveholidays.add');
    // Route::post('e-leave/configuration/leaveholidays/add','Admin\ELeaveController@postAddPublicHoliday')->name('admin.e-leave.configuration.leaveholidays.add.post');

    // Route::get('e-leave/configuration/leaveholidays/{id}/edit','Admin\ELeaveController@editPublicHoliday')->name('admin.e-leave.configuration.leaveholidays.edit')->where('id', '[0-9]+');
    // Route::post('e-leave/configuration/leaveholidays/{id}/edit','Admin\ELeaveController@postEditPublicHoliday')->name('admin.e-leave.configuration.leaveholidays.edit.post')->where('id', '[0-9]+');



    // > Add
    Route::get('settings/companies/add','Admin\SettingsController@addCompany')->name('admin.settings.companies.add');
    Route::post('settings/companies/add','Admin\SettingsController@postAddCompany')->name('admin.settings.companies.add.post');
    Route::get('settings/positions/add','Admin\SettingsController@addPosition')->name('admin.settings.positions.add');
    Route::post('settings/positions/add','Admin\SettingsController@postAddPosition')->name('admin.settings.positions.add.post');
    Route::get('settings/grades/add','Admin\SettingsController@addGrade')->name('admin.settings.grades.add');
    Route::post('settings/grades/add','Admin\SettingsController@postAddGrade')->name('admin.settings.grades.add.post');
    Route::get('settings/teams/add','Admin\SettingsController@addTeam')->name('admin.settings.teams.add');
    Route::post('settings/teams/add','Admin\SettingsController@postAddTeam')->name('admin.settings.teams.add.post');
    Route::get('settings/cost-centres/add','Admin\SettingsController@addCostCentre')->name('admin.settings.cost-centres.add');
    Route::post('settings/cost-centres/add','Admin\SettingsController@postAddCostCentre')->name('admin.settings.cost-centres.add.post');
    Route::get('settings/departments/add','Admin\SettingsController@addDepartment')->name('admin.settings.departments.add');
    Route::post('settings/departments/add','Admin\SettingsController@postAddDepartment')->name('admin.settings.departments.add.post');
    Route::get('settings/branches/add','Admin\SettingsController@addBranch')->name('admin.settings.branches.add');
    Route::post('settings/branches/add','Admin\SettingsController@postAddBranch')->name('admin.settings.branches.add.post');
    Route::get('settings/epf/add','Admin\SettingsController@addEpf')->name('admin.settings.epf.add');
    Route::post('settings/epf/add','Admin\SettingsController@postAddEpf')->name('admin.settings.epf.add.post');
    Route::get('settings/eis/add','Admin\SettingsController@addEis')->name('admin.settings.eis.add');
    Route::post('settings/eis/add','Admin\SettingsController@postAddEis')->name('admin.settings.eis.add.post');
    Route::get('settings/socso/add','Admin\SettingsController@addSocso')->name('admin.settings.socso.add');
    Route::post('settings/socso/add','Admin\SettingsController@postAddSocso')->name('admin.settings.socso.add.post');
    Route::get('settings/pcb/add','Admin\SettingsController@addPcb')->name('admin.settings.pcb.add');
    Route::post('settings/pcb/add','Admin\SettingsController@postAddPcb')->name('admin.settings.pcb.add.post');
    Route::get('settings/working-days/add','Admin\SettingsController@addWorkingDay')->name('admin.settings.working-days.add');
    Route::post('settings/working-days/add','Admin\SettingsController@postAddWorkingDay')->name('admin.settings.working-days.add.post');

    // Route::get('settings/company-banks/add','Admin\SettingsController@addCompanyBank')->name('admin.settings.company-banks.add');
    // Route::post('settings/company-banks/add','Admin\SettingsController@postAddCompanyBank')->name('admin.settings.company-bank.add.post');

  //  Route::get('settings/additions/{id}/add','Admin\SettingsController@addCompanyAddition')->name('admin.settings.additions.add')->where('id', '[0-9]+');


    Route::get('settings/deductions/add','Admin\SettingsController@addCompanyDeduction')->name('admin.settings.deductions.add');
    Route::post('settings/deductions/add','Admin\SettingsController@postAddCompanyDeduction')->name('admin.settings.deductions.add.post');

    Route::get('settings/additions/{id}/edit','Admin\SettingsController@editAdditions')->name('admin.settings.additions.edit')->where('id', '[0-9]+');
    Route::post('settings/additions/{id}/edit','Admin\SettingsController@postEditAdditions')->name('admin.settings.additions.edit.post')->where('id', '[0-9]+');

    Route::get('settings/deductions/{id}/edit','Admin\SettingsController@editCompanyDeduction')->name('admin.settings.deductions.edit')->where('id', '[0-9]+');
    Route::post('settings/deductions/{id}/edit','Admin\SettingsController@postEditCompanyDeduction')->name('admin.settings.deductions.edit.post')->where('id', '[0-9]+');

   // Route::get('settings/company-banks/{id}/edit','Admin\SettingsController@editCompanyBank')->name('admin.settings.company-banks.edit')->where('id', '[0-9]+');
    Route::post('settings/company-banks/edit','Admin\SettingsController@postEditCompanyBank')->name('admin.settings.company-banks.edit.post');
    Route::post('settings/security-groups/edit','Admin\SettingsController@postEditSecurityGroup')->name('admin.settings.security-groups.edit.post');
    Route::post('settings/travel-allowance/edit','Admin\SettingsController@postEditTravelAllowance')->name('admin.settings.travel-allowance.edit.post');
    Route::post('settings/company-addition/edit','Admin\SettingsController@postEditCompanyAddition')->name('admin.settings.company-addition.edit.post');
    Route::post('settings/company-deduction/edit','Admin\SettingsController@postEditCompanyDeduction')->name('admin.settings.company-deduction.edit.post');

    Route::post('settings/company-banks/{id}/add','Admin\SettingsController@postAddCompanyBank')->name('admin.settings.company-banks.add.post')->where('id', '[0-9]+');
    Route::post('settings/additions/{id}/add','Admin\SettingsController@postAddCompanyAddition')->name('admin.settings.additions.add.post')->where('id', '[0-9]+');
    Route::post('settings/deductions/{id}/add','Admin\SettingsController@postAddCompanyDeduction')->name('admin.settings.deductions.add.post')->where('id', '[0-9]+');
    Route::post('settings/security-groups/{id}/add','Admin\SettingsController@postAddCompanySecurityGroup')->name('admin.settings.security-groups.add.post')->where('id', '[0-9]+');
    Route::post('settings/travel-allowances/{id}/add','Admin\SettingsController@postAddCompanyTravelAllowance')->name('admin.settings.company-travel-allowance.add.post')->where('id', '[0-9]+');

    Route::get('settings/company/{id}/company-details','Admin\SettingsController@displayCompanyDetails')->name('admin.settings.company.company-details')->where('id', '[0-9]+');


    //  Route::post('settings/company-details/{id}','Admin\SettingsController@displayCompanyDetails')->name('admin.settings.company-details')->where('id', '[0-9]+');

    //Route::post('settings/grades/add','Admin\SettingsController@postAddGrade')->name('admin.settings.grades.add.post');

    Route::post('settings/grades/add','Admin\SettingsController@postAddGrade')->name('admin.settings.grades.add.post');
    Route::post('settings/holidays/add','Admin\SettingsController@postAddHoliday')->name('admin.settings.holidays.add.post');
  //  Route::post('settings/security-groups/add','Admin\SettingsController@postAddSecurityGroup')->name('admin.settings.security-groups.add.post');



    // > Edit

    Route::get('settings/epf/{id}/edit','Admin\SettingsController@editEpf')->name('admin.settings.epf.edit')->where('id', '[0-9]+');
    Route::post('settings/epf/{id}/edit','Admin\SettingsController@postEditEpf')->name('admin.settings.epf.edit.post')->where('id', '[0-9]+');
    Route::get('settings/eis/{id}/edit','Admin\SettingsController@editEis')->name('admin.settings.eis.edit')->where('id', '[0-9]+');
    Route::post('settings/eis/{id}/edit','Admin\SettingsController@postEditEis')->name('admin.settings.eis.edit.post')->where('id', '[0-9]+');
    Route::get('settings/socso/{id}/edit','Admin\SettingsController@editSocso')->name('admin.settings.socso.edit')->where('id', '[0-9]+');
    Route::post('settings/socso/{id}/edit','Admin\SettingsController@postEditSocso')->name('admin.settings.socso.edit.post')->where('id', '[0-9]+');
    Route::get('settings/pcb/{id}/edit','Admin\SettingsController@editPcb')->name('admin.settings.pcb.edit')->where('id', '[0-9]+');
    Route::post('settings/pcb/{id}/edit','Admin\SettingsController@postEditPcb')->name('admin.settings.pcb.edit.post')->where('id', '[0-9]+');
    Route::get('settings/companies/{id}/edit','Admin\SettingsController@editCompany')->name('admin.settings.companies.edit')->where('id', '[0-9]+');
    Route::post('settings/companies/{id}/edit','Admin\SettingsController@postEditCompany')->name('admin.settings.companies.edit.post')->where('id', '[0-9]+');
    Route::get('settings/positions/{id}/edit','Admin\SettingsController@editPosition')->name('admin.settings.positions.edit')->where('id', '[0-9]+');
    Route::post('settings/positions/{id}/edit','Admin\SettingsController@postEditPosition')->name('admin.settings.positions.edit.post')->where('id', '[0-9]+');
    Route::get('settings/grades/{id}/edit','Admin\SettingsController@editGrade')->name('admin.settings.grades.edit')->where('id', '[0-9]+');
    Route::post('settings/grades/{id}/edit','Admin\SettingsController@postEditGrade')->name('admin.settings.grades.edit.post')->where('id', '[0-9]+');
    Route::get('settings/teams/{id}/edit','Admin\SettingsController@editTeam')->name('admin.settings.teams.edit')->where('id', '[0-9]+');
    Route::post('settings/teams/{id}/edit','Admin\SettingsController@postEditTeam')->name('admin.settings.teams.edit.post')->where('id', '[0-9]+');
    Route::get('settings/cost-centres/{id}/edit','Admin\SettingsController@editCostCentre')->name('admin.settings.cost-centres.edit')->where('id', '[0-9]+');
    Route::post('settings/cost-centres/{id}/edit','Admin\SettingsController@postEditCostCentre')->name('admin.settings.cost-centres.edit.post')->where('id', '[0-9]+');
    Route::get('settings/departments/{id}/edit','Admin\SettingsController@editDepartment')->name('admin.settings.departments.edit')->where('id', '[0-9]+');
    Route::post('settings/departments/{id}/edit','Admin\SettingsController@postEditDepartment')->name('admin.settings.departments.edit.post')->where('id', '[0-9]+');
    Route::get('settings/branches/{id}/edit','Admin\SettingsController@editBranch')->name('admin.settings.branches.edit')->where('id', '[0-9]+');
    Route::post('settings/branches/{id}/edit','Admin\SettingsController@postEditBranch')->name('admin.settings.branches.edit.post')->where('id', '[0-9]+');
    Route::get('settings/working-days/{id}/edit','Admin\SettingsController@editWorkingDay')->name('admin.settings.working-days.edit')->where('id', '[0-9]+');
    Route::post('settings/working-days/{id}/edit','Admin\SettingsController@postEditWorkingDay')->name('admin.settings.working-days.edit.post')->where('id', '[0-9]+');


    Route::post('settings/company-banks/edit','Admin\SettingsController@editCompanyBank')->name('admin.settings.company-banks.edit.post');
    Route::post('settings/security-groups/edit','Admin\SettingsController@editSecurityGroup')->name('admin.settings.security-groups.edit.post');
    Route::post('settings/leave-balances/edit','Admin\SettingsController@editLeaveBalance')->name('admin.settings.leave-balances.edit.post');
    //Route::post('settings/company-addition/edit','Admin\SettingsController@editCompanyAddition')->name('admin.settings.company-banks.edit.post');
//    Route::post('settings/security-groups/edit','Admin\SettingsController@editSecurityGroup')->name('admin.settings.security-groups.edit.post');
    Route::post('settings/company-banks/edit','Admin\SettingsController@editCompanyBank')->name('admin.settings.company-banks.edit.post');
    Route::post('settings/security-groups/edit','Admin\SettingsController@editSecurityGroup')->name('admin.settings.security-groups.edit.post');
    Route::post('settings/company-additions/edit','Admin\SettingsController@editCompanyAddition')->name('admin.settings.company-additions.edit.post');
    Route::post('settings/company-deductions/edit','Admin\SettingsController@editCompanyDeduction')->name('admin.settings.company-deductions.edit.post');
    //Route::post('settings/company-deductions/edit','Admin\SettingsController@editCompanyDeduction')->name('admin.settings.company-deductions.edit.post');

    // > Delete
    Route::get('settings/epf/{id}/delete','Admin\SettingsController@deleteEpf')->name('admin.settings.epf.delete')->where('id', '[0-9]+');
    Route::get('settings/eis/{id}/delete','Admin\SettingsController@deleteEis')->name('admin.settings.eis.delete')->where('id', '[0-9]+');
    Route::get('settings/socso/{id}/delete','Admin\SettingsController@deleteSocso')->name('admin.settings.socso.delete')->where('id', '[0-9]+');
    Route::get('settings/pcb/{id}/delete','Admin\SettingsController@deletePcb')->name('admin.settings.pcb.delete')->where('id', '[0-9]+');
    Route::get('settings/companies/{id}/delete','Admin\SettingsController@deleteCompany')->name('admin.settings.companies.delete')->where('id', '[0-9]+');
    Route::get('settings/positions/{id}/delete','Admin\SettingsController@deletePosition')->name('admin.settings.positions.delete')->where('id', '[0-9]+');
    Route::get('settings/grades/{id}/delete','Admin\SettingsController@deleteGrade')->name('admin.settings.grades.delete')->where('id', '[0-9]+');
    Route::get('settings/teams/{id}/delete','Admin\SettingsController@deleteTeam')->name('admin.settings.teams.delete')->where('id', '[0-9]+');
    Route::get('settings/cost-centres/{id}/delete','Admin\SettingsController@deleteCostCentre')->name('admin.settings.cost-centres.delete')->where('id', '[0-9]+');
    Route::get('settings/departments/{id}/delete','Admin\SettingsController@deleteDepartment')->name('admin.settings.departments.delete')->where('id', '[0-9]+');
    Route::get('settings/branches/{id}/delete','Admin\SettingsController@deleteBranch')->name('admin.settings.branches.delete')->where('id', '[0-9]+');
    Route::get('settings/working-days/{id}/delete','Admin\SettingsController@deleteWorkingDay')->name('admin.settings.working-days.delete')->where('id', '[0-9]+');

    //later
    // Route::post('approve_leave', 'Admin\ELeaveController@approvedLeaveRequest')->name('approve_leave'); // also for manager
    // Route::post('disapprove_leave', 'Admin\ELeaveController@disapprovedLeaveRequest')->name('disapprove_leave'); // merge
    // Route::post('add_leave_balance','Admin\ELeaveController@addLeaveBalance')->name('add_leave_balance');
    Route::get('company/{id}/dt/company-banks', 'Admin\SettingsController@getDataTableCompanyBank')->name('admin.companies.dt.company-banks')->where('id', '[0-9]+');


    // SECTION: E-Leave
   Route::get('e-leave/configuration', 'Admin\ELeaveController@displayConfiguration')->name('admin.e-leave.configuration');
   Route::get('e-leave/configuration/leave-types/add', 'Admin\ELeaveController@addLeaveType')->name('admin.e-leave.configuration.leave-types.add');
   Route::post('e-leave/configuration/leave-types/add', 'Admin\ELeaveController@postAddLeaveType')->name('admin.e-leave.configuration.leave-types.add.post');
   Route::get('e-leave/configuration/leave-types/{id}/edit', 'Admin\ELeaveController@editLeaveType')->name('admin.e-leave.configuration.leave-types.edit');
   Route::post('e-leave/configuration/leave-types/{id}/edit', 'Admin\ELeaveController@postEditLeaveType')->name('admin.e-leave.configuration.leave-types.edit.post');



   Route::get('e-leave/configuration/leaveholidays', 'Admin\ELeaveController@displayPublicHolidays')->name('admin.e-leave.configuration.leave-holidays');
      //leave public holidays setup
      Route::get('e-leave/configuration/leaveholidays/add','Admin\ELeaveController@addPublicHoliday')->name('admin.e-leave.configuration.leave-holidays.add');
      Route::post('e-leave/configuration/leaveholidays/add','Admin\ELeaveController@postAddPublicHoliday')->name('admin.e-leave.configuration.leave-holidays.add.post');

      Route::get('e-leave/configuration/leaveholidays/{id}/edit','Admin\ELeaveController@editPublicHoliday')->name('admin.e-leave.configuration.leave-holidays.edit')->where('id', '[0-9]+');
      Route::post('e-leave/configuration/leaveholidays/{id}/edit','Admin\ELeaveController@postEditPublicHoliday')->name('admin.e-leave.configuration.leave-holidays.edit.post')->where('id', '[0-9]+');

      // Edit later
    Route::get('/admin/report-to', 'AdminController@displayReportTo')->name('admin/report-to');
    Route::get('/admin/history', 'AdminController@displayHistory')->name('admin/history');
    Route::get('/profile-employee/{id}','AdminController@displayProfile2')->name('admin/profile-employee/{id}');
    Route::get('user-list', 'AdminController@displayUserList')->name('admin/user_list');
    Route::get('edit-employee/{id}', 'AdminController@displayAddEmployeeProfile')->name('admin/edit-employee/{id}');
    Route::get('edit-employee', 'AdminController@displayAddEmployeeProfile')->name('admin/edit-employee');
    Route::get('resign', 'AdminController@employeeResign')->name('resign');

    Route::post('register_employee4','AdminController@addProfile3')->name('register_employee4');
    Route::post('register_employee','EmployeeDataController@insert')->name('register_employee');
    // Route::post('approve_leave', 'Admin\ELeaveController@approvedLeaveRequest')->name('approve_leave');
    // Route::post('disapprove_leave', 'Admin\ELeaveController@disapprovedLeaveRequest')->name('disapprove_leave');
    // Route::post('add_leave_balance','Admin\ELeaveController@addLeaveBalance')->name('add_leave_balance');
    Route::post('add_job','AdminController@addJob')->name('add_job');

});

// MODE: Super Admin
Route::group(['prefix' => 'super-admin', 'middleware' => ['auth', 'role:super-admin']], function() {
    Route::get('', 'SuperAdmin\DashboardController@index')->name('super-admin.dashboard');
});
