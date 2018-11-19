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
    
    Route::get('/employee','EmployeeController@displayProfile')->name('employee');
    Route::get('profile','EmployeeController@displayProfile')->name('profile');
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

    Route::get('leaveapplication','EmployeeController@displayLeaveApplication')->name('employee/leaveapplication');
    Route::get('leavetype','EmployeeController@displayEmployeeLeave')->name('employee/leavetype');
    Route::get('leaverequest','EmployeeController@displayLeaveRequest')->name('employee/leaverequest');
    Route::get('leavebalance','EmployeeController@displayLeaveBalance')->name('employee/leavebalance');
    Route::get('leaveholiday','EmployeeController@displayLeaveHoliday')->name('employee/leaveholiday');

    Route::post('add_leave_application','EmployeeController@addLeaveApplication')->name('add_leave_application');
});

// MODE: Employee
Route::group(['middleware' => ['auth', 'role:employee']], function() {
    Route::get('/employee','Employee\EmployeeController@displayProfile')->name('employee');
    Route::get('/profile','Employee\EmployeeController@displayProfile')->name('profile');

    Route::get('leaveapplication','EmployeeController@displayLeaveApplication')->name('employee/leaveapplication');
    Route::get('leavetype','EmployeeController@displayEmployeeLeave')->name('employee/leavetype');
    Route::get('leaverequest','EmployeeController@displayLeaveRequest')->name('employee/leaverequest');
    Route::get('leavebalance','EmployeeController@displayLeaveBalance')->name('employee/leavebalance');
    Route::get('leaveholiday','EmployeeController@displayLeaveHoliday')->name('employee/leaveholiday');

    Route::post('add_leave_application','EmployeeController@addLeaveApplication')->name('add_leave_application');
});


// MODE: Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:super-admin|admin']], function() {
    Route::get('', 'Admin\DashboardController@index')->name('admin.dashboard');
    
    // View
    Route::get('employees', 'Admin\EmployeeController@index')->name('admin.employees');
    Route::get('employees/{id}','Admin\EmployeeController@display')->name('admin.employees.id')->where('id', '[0-9]+');
    
    // Data Tables
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

    
    // Add / Edit
    Route::get('employees/add', 'Admin\EmployeeController@add')->name('admin.employees.add');
    Route::post('employees/add','Admin\EmployeeController@postAdd')->name('admin.employees.add.post');

    Route::post('employees/{emp_id}/emergency-contacts','Admin\EmployeeController@postEmergencyContact')->name('admin.employees.emergency-contacts.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/dependents','Admin\EmployeeController@postDependent')->name('admin.employees.dependents.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/immigrations','Admin\EmployeeController@postImmigration')->name('admin.employees.immigrations.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/visas','Admin\EmployeeController@postVisa')->name('admin.employees.visas.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/bank-accounts','Admin\EmployeeController@postBankAccount')->name('admin.employees.bank-accounts.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/companies','Admin\EmployeeController@postCompany')->name('admin.employees.companies.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/education','Admin\EmployeeController@postEducation')->name('admin.employees.education.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/skills','Admin\EmployeeController@postSkill')->name('admin.employees.skills.post')->where('id', '[0-9]+');

    Route::post('add_report_to','AdminController@addReportTo')->name('add_report_to'); // TODO
    Route::post('employees/{emp_id}/dependents/{id}/edit','Admin\EmployeeController@postEditDependent')->name('admin.employees.dependents.edit')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/emergency-contacts/{id}/edit','Admin\EmployeeController@postEditEmergencyContact')->name('admin.employees.emergency-contacts.edit')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/immigrations/{id}/edit','Admin\EmployeeController@postEditEmergencyContact')->name('admin.employees.immigrations.edit')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/visas/{id}/edit','Admin\EmployeeController@postEditVisa')->name('admin.employees.visas.edit')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/bank-accounts/{id}/edit','Admin\EmployeeController@postEditBankAccount')->name('admin.employees.bank-accounts.edit')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/companies/{id}/edit','Admin\EmployeeController@postEditCompany')->name('admin.employees.companies.edit')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/education/{id}/edit','Admin\EmployeeController@postEditEducation')->name('admin.employees.education.edit')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/skills/{id}/edit','Admin\EmployeeController@postEditSkill')->name('admin.employees.skills.edit')->where('id', '[0-9]+');
  
    //settings-view 
    Route::get('settings/companies', 'Admin\SettingsController@displayCompanies')->name('admin.settings.companies');
    // Route::get('settings/add-company', 'Admin\SettingsController@displayAddCompany')->name('admin.settings.add-company');
    Route::get('settings/jobs', 'Admin\SettingsController@displayJobs')->name('admin-settings-jobs');
    Route::get('settings/cost-centres', 'Admin\SettingsController@displayCostCentres')->name('admin.settings.cost-centres');
    Route::get('settings/departments', 'Admin\SettingsController@displayDepartments')->name('admin.settings.departments');
    Route::get('settings/teams', 'Admin\SettingsController@displayTeams')->name('admin.settings.teams');
    Route::get('settings/positions', 'Admin\SettingsController@displayPositions')->name('admin.settings.positions');
    Route::get('settings/grades', 'Admin\SettingsController@displayGrades')->name('admin.settings.grades');
    Route::get('settings/branches', 'Admin\SettingsController@displayBranches')->name('admin.settings.branches');
 
    
    // Settings - Add
    Route::get('settings/companies/add','Admin\SettingsController@addCompany')->name('admin.settings.companies.add');
    Route::post('settings/companies/add','Admin\SettingsController@postAddCompany')->name('admin.settings.companies.add.post');

    Route::post('settings/departments/add','Admin\SettingsController@postAddDepartment')->name('admin.settings.departments.add.post');
    Route::post('settings/branches/add','Admin\SettingsController@postAddBranch')->name('admin.settings.branches.add.post');
    Route::post('settings/teams/add','Admin\SettingsController@postAddTeam')->name('admin.settings.teams.add.post');
    Route::post('settings/positions/add','Admin\SettingsController@postAddPosition')->name('admin.settings.positions.add.post');
    Route::post('settings/grades/add','Admin\SettingsController@postAddGrade')->name('admin.settings.grades.add.post');
    Route::post('settings/holidays/add','Admin\SettingsController@postAddHoliday')->name('admin.settings.holidays.add.post');
    Route::post('settings/security-groups/add','Admin\SettingsController@postAddSecurityGroup')->name('admin.settings.security-groups.add.post');
    Route::post('settings/company-banks/add','Admin\SettingsController@postAddCompanyBank')->name('admin.settings.company-banks.add.post');
    Route::post('settings/company-additions/add','Admin\SettingsController@postAddCompanyAddition')->name('admin.settings.company-additions.add.post');
    Route::post('settings/company-deductions/add','Admin\SettingsController@postAddCompanyDeduction')->name('admin.settings.company-deductions.add.post');
    Route::post('settings/cost-centres/add','Admin\SettingsController@postAddCostCentre')->name('admin.settings.cost-centres.add.post');

    //setting-edit
    Route::get('settings/companies/{id}/edit','Admin\SettingsController@editCompany')->name('admin.settings.companies.edit')->where('id', '[0-9]+');
    Route::post('settings/companies/{id}/edit','Admin\SettingsController@postEditCompany')->name('admin.settings.companies.edit.post')->where('id', '[0-9]+');
    
    Route::post('settings/cost-centres/edit','Admin\SettingsController@editCostCentre')->name('admin.settings.cost-centres.edit.post');
    Route::post('settings/grades/edit','Admin\SettingsController@editGrade')->name('admin.settings.grades.edit.post');
    Route::post('settings/positions/edit','Admin\SettingsController@editPosition')->name('admin.settings.positions.edit.post');
    Route::post('settings/departments/edit','Admin\SettingsController@editDepartment')->name('admin.settings.departments.edit.post');
    Route::post('settings/teams/edit','Admin\SettingsController@editTeam')->name('admin.settings.teams.edit.post');
    Route::post('settings/branches/edit','Admin\SettingsController@editBranch')->name('admin.settings.branches.edit.post');
    Route::post('settings/leave-balances/edit','Admin\SettingsController@editLeaveBalance')->name('admin.settings.leave-balances.edit.post');
    Route::post('settings/company-banks/edit','Admin\SettingsController@editCompanyBank')->name('admin.settings.company-banks.edit.post');
    Route::post('settings/security-groups/edit','Admin\SettingsController@editSecurityGroup')->name('admin.settings.security-groups.edit.post');
    Route::post('settings/company-additions/edit','Admin\SettingsController@editCompanyAddition')->name('aadmin.settings.company-additions.edit.post');
    Route::post('settings/company-deductions/edit','Admin\SettingsController@editCompanyDeduction')->name('admin.settings.company-deductions.edit.post');


    //admin e-leave
    Route::get('e-leave','Admin\ELeaveController@displayLeaveApplication')->name('admin.e-leave'); // on behalf
    Route::get('e-leave/edit/{id}','Admin\ELeaveController@displayEmployeeLeave')->name('admin.edit');
    Route::get('e-leave/apply-on-behalf','Admin\ELeaveController@displayLeaveRequest')->name('admin.e-leave.apply-on-behalf');
    Route::get('e-leave/configuration','Admin\ELeaveController@displayLeaveBalance')->name('admin.e-leave.configuration');
    Route::get('e-leave/configuration/holidays','Admin\ELeaveController@displayLeaveHoliday')->name('admin.e-leave.configuration.holidays');
    Route::get('e-leave/configuration/leave-types','Admin\ELeaveController@displayLeaveTypes')->name('admin.e-leave.configuration.leave-types');
    Route::get('e-leave/configuration/working-days','Admin\ELeaveController@displayLeaveHoliday')->name('admin.e-leave.configuration.working-days');

//later
    Route::post('approve_leave', 'AdminController@approvedLeaveRequest')->name('approve_leave'); // also for manager
    Route::post('disapprove_leave', 'AdminController@disapprovedLeaveRequest')->name('disapprove_leave'); // merge
    Route::post('add_leave_balance','AdminController@addLeaveBalance')->name('add_leave_balance'); 




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
    Route::post('approve_leave', 'AdminController@approvedLeaveRequest')->name('approve_leave');
    Route::post('disapprove_leave', 'AdminController@disapprovedLeaveRequest')->name('disapprove_leave');
    Route::post('add_leave_balance','AdminController@addLeaveBalance')->name('add_leave_balance');
    Route::post('add_job','AdminController@addJob')->name('add_job');

});

// MODE: Super Admin
Route::group(['prefix' => 'super-admin', 'middleware' => ['auth', 'role:super-admin']], function() {
    Route::get('', 'SuperAdmin\DashboardController@index')->name('super-admin.dashboard');
});


// MODE: Manager
// Route::group(['prefix' => 'manager', 'middleware' => ['auth', 'role:manager']], function() {
//     Route::get('', 'Manager\DashboardController@index')->name('manager.dashboard');
//     Route::get('e-leave','Manager\ELeaveController@displayLeaveApplication')->name('admin.e-leave'); // on behalf
//     Route::get('e-leave/edit/{id}','Manager\ELeaveController@displayEmployeeLeave')->name('admin.edit');
//     Route::get('e-leave/apply-on-behalf','Manager\ELeaveController@displayLeaveRequest')->name('admin.e-leave.apply-on-behalf');
// });
    


    // Route::get('setup', 'AdminController@displaySetupCompany')->name('setup');


    // Route::get('leaveapplication','EmployeeController@displayLeaveApplication')->name('admin/leaveapplication');
    // Route::get('leavetype','AdminController@displayEmployeeLeave')->name('admin.configuration.leavetypes');
    // Route::get('leaverequest','AdminController@displayLeaveRequest')->name('admin.e-leave');
    // Route::get('leavebalance','AdminController@displayLeaveBalance')->name('admin.configuration');
    // Route::get('leaveholiday','AdminController@displayLeaveHoliday')->name('admin.e-leave.configuration.holidays');

    // Route::get('employee_list', 'AdminController@displayAllEmployee')->name('admin/employee_list');
    // Route::get('user_list', 'EmployeeDataController@index')->name('admin/user_list');
    // Route::get('/admin/report-to', 'AdminController@displayReportTo')->name('admin/report-to');
    // Route::get('/admin/history', 'AdminController@displayHistory')->name('admin/history');
    // Route::get('edit-employee/{id}', 'AdminController@displayAddEmployeeProfile')->name('admin/edit-employee/{id}');
      
  
    // TODO Experiences ??
    // Route::post('edit_emergency_contact','AdminController@editEmergencyContact')->name('edit_emergency_contact');
   // Route::post('edit_immigration','AdminController@editEmployeeImmigration')->name('edit_immigration');
   // Route::post('edit_visa','AdminController@editEmployeeVisa')->name('edit_visa');
    // Route::post('edit_qualification_company','AdminController@editQualificationCompany')->name('edit_qualification_company');
    // Route::post('edit_qualification_skills','AdminController@editQualificationSkills')->name('edit_qualification_skills');
    // Route::post('edit_bank','AdminController@editEmployeeBank')->name('edit_bank');
  // Route::post('edit_qualification_education','AdminController@editQualificationEducation')->name('edit_qualification_education');
       
 // Route::post('add_emergency_contact','AdminController@addEmergencyContact')->name('add_emergency_contact');
  // Route::post('add_employee_dependent','AdminController@addEmployeeDependent')->name('add_employee_dependent');
      // Route::post('add_employee_immigration','AdminController@addEmployeeImmigration')->name('add_employee_immigration');
     // Route::post('add_employee_visa','AdminController@addEmployeeVisa')->name('add_employee_visa');
      // Route::post('add_employee_bank','AdminController@addEmployeeBank')->name('add_employee_bank');
  // Route::post('add_qualification_experience','AdminController@addQualificationCompany')->name('add_qualification_experience');
     // Route::post('add_qualification_education','AdminController@addQualificationEducation')->name('add_qualification_education');
    // Route::post('add_qualification_skills','AdminController@addQualificationSkills')->name('add_qualification_skills');
  
    // Route::post('edit_employee_dependent','AdminController@editEmployeeDependent')->name('edit_employee_dependent');
  
    // Route::post('register_employee4','AdminController@addProfile3')->name('register_employee4');
   