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


Route::get('setup', 'AdminController@displaySetupCompany')->name('setup');

Route::group(['prefix' => 'setup', 'middleware' => ['auth', 'role:super-admin|admin']], function() {
    Route::get('company', 'AdminController@displaySetupCompany')->name('admin/setup/company');
    Route::get('add-company', 'AdminController@displayAddCompany')->name('admin/setup/add-company');
    Route::get('job-configure', 'AdminController@displaySetupJob')->name('admin/setup/job-configure');
    Route::get('cost-centre', 'AdminController@displayCostCentre')->name('admin/setup/cost-centre');
    Route::get('department', 'AdminController@displayDepartment')->name('admin/setup/department');
    Route::get('team', 'AdminController@displayTeam')->name('admin/setup/team');
    Route::get('position', 'AdminController@displayPosition')->name('admin/setup/position');
    Route::get('grade', 'AdminController@displayGrade')->name('setup/grade');
    Route::get('branch', 'AdminController@displaySetupBranch')->name('setup/branch');
});

Route::group(['prefix' => 'admin', 'middleware' => ['role:super-admin|admin']], function() {

    Route::get('/', function () {
        return view('home');
    })->name('/');

    Route::get('home', 'HomeController@index')->name('admin.home');

    Route::get('/employee/add', 'EmployeeDataController@addEmployee')->name('employee/add');
    Route::get('profile-employee/emergencycontact', 'AdminController@displayEmergencyContact')->name('admin/emergencycontact');
    Route::get('employee_dependent', 'AdminController@displayEmployeeDependent')->name('admin/employee_dependent');
    Route::get('employeeimmigration', 'AdminController@displayEmployeeImmigration')->name('admin/employeeimmigration');
    Route::get('employeevisa', 'AdminController@displayEmployeeVisa')->name('admin/employeevisa');
    Route::get('employee_bank', 'AdminController@displayEmployeeBank')->name('admin/employee_bank');
    Route::get('employee-qualification','AdminController@displayQualification')->name('admin/employee-qualification');
    Route::get('employee_list', 'AdminController@displayAllEmployee')->name('admin/employee_list');
    // Route::get('user_list', 'EmployeeDataController@index')->name('admin/user_list');
    Route::get('/admin/report-to', 'AdminController@displayReportTo')->name('admin/report-to');
    Route::get('/admin/history', 'AdminController@displayHistory')->name('admin/history');
    Route::get('/profile-employee/{id}','AdminController@displayProfile2')->name('admin/profile-employee/{id}');
    Route::get('user-list', 'AdminController@displayUserList')->name('admin/user_list');
    Route::get('edit-employee/{id}', 'AdminController@displayAddEmployeeProfile')->name('admin/edit-employee/{id}');
    

    Route::post('edit_employee_dependent','AdminController@editEmployeeDependent')->name('edit_employee_dependent');
    Route::post('edit_emergency_contact','AdminController@editEmergencyContact')->name('edit_emergency_contact');
    Route::post('edit_immigration','AdminController@editEmployeeImmigration')->name('edit_immigration');
    Route::post('edit_visa','AdminController@editEmployeeVisa')->name('edit_visa');
    Route::post('edit_bank','AdminController@editEmployeeBank')->name('edit_bank');
    Route::post('edit_qualification_company','AdminController@editQualificationCompany')->name('edit_qualification_company');
    Route::post('edit_qualification_education','AdminController@editQualificationEducation')->name('edit_qualification_education');
    Route::post('edit_qualification_skills','AdminController@editQualificationSkills')->name('edit_qualification_skills');
    Route::post('edit_cost_centre','AdminController@editCostCentre')->name('edit_cost_centre');
    Route::post('edit_grade','AdminController@editGrade')->name('edit_grade');
    Route::post('edit_position','AdminController@editPosition')->name('edit_position');
    Route::post('edit_department','AdminController@editDepartment')->name('edit_department');
    Route::post('edit_team','AdminController@editTeam')->name('edit_team');
    Route::post('edit_branch','AdminController@editBranch')->name('edit_branch');
    Route::post('edit_company','AdminController@editCompany')->name('edit_company');


    Route::post('add_emergency_contact','AdminController@addEmergencyContact')->name('add_emergency_contact');
    Route::post('add_employee_dependent','AdminController@addEmployeeDependent')->name('add_employee_dependent');
    Route::post('add_employee_immigration','AdminController@addEmployeeImmigration')->name('add_employee_immigration');
    Route::post('add_employee_visa','AdminController@addEmployeeVisa')->name('add_employee_visa');
    Route::post('add_employee_bank','AdminController@addEmployeeBank')->name('add_employee_bank');
    Route::post('add_qualification_experience','AdminController@addQualificationCompany')->name('add_qualification_experience');
    Route::post('add_qualification_education','AdminController@addQualificationEducation')->name('add_qualification_education');
    Route::post('add_qualification_skills','AdminController@addQualificationSkills')->name('add_qualification_skills');
    Route::post('add_report_to','AdminController@addReportTo')->name('add_report_to');
    Route::post('add_cost_centre','AdminController@addCostCentre')->name('add_cost_centre');
    Route::post('add_department','AdminController@addDepartment')->name('add_department');
    Route::post('add_branch','AdminController@addBranch')->name('add_branch');
    Route::post('add_team','AdminController@addTeam')->name('add_team');
    Route::post('add_position','AdminController@addPosition')->name('add_position');
    Route::post('add_grade','AdminController@addGrade')->name('add_grade');
    Route::post('add_company','AdminController@addSetupCompany')->name('add_company');
    Route::post('add_holiday','AdminController@addHoliday')->name('add_holiday');
    Route::post('register_employee4','AdminController@addProfile3')->name('register_employee4');
    Route::post('register_employee','EmployeeDataController@insert')->name('register_employee');


    Route::get('leaveapplication','EmployeeController@displayLeaveApplication')->name('admin/leaveapplication');
    Route::get('leavetype','AdminController@displayEmployeeLeave')->name('admin/leavetype');
    Route::get('leaverequest','AdminController@displayLeaveRequest')->name('admin/leaverequest');
    Route::get('leavebalance','AdminController@displayLeaveBalance')->name('admin/leavebalance');
    Route::get('leaveholiday','AdminController@displayLeaveHoliday')->name('admin/leaveholiday');
});

Route::group(['middleware' => ['auth', 'role:super-admin|admin|employee']], function() {
    Route::get('', 'HomeController@index')->name('home');
    Route::get('/employee','EmployeeController@displayProfile')->name('employee');
    Route::get('profile','EmployeeController@displayProfile')->name('profile');
    Route::get('emergencycontactdata','EmployeeController@displayEmergencyContact')->name('emergencycontactdata');
    Route::get('dependentdata','EmployeeController@displayEmployeeDependent')->name('dependent');
    Route::get('employeeimmigrationdata','EmployeeController@displayImmigration')->name('immigration');
    Route::get('qualificationcompaniesdata','EmployeeController@displayQualificationCompanies')->name('companies');
    Route::get('qualificationeducationsdata','EmployeeController@displayQualificationEducations')->name('educations');
    Route::get('qualificationskillsdata','EmployeeController@displayQualificationSkills')->name('skills');
    Route::get('employeevisadata','EmployeeController@displayVisa')->name('visa');
    Route::get('bankdata','EmployeeController@displayBank')->name('bank');
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

Route::group(['prefix' => 'admin', 'middleware' => ['role:employee']], function() {
    Route::get('/', function () {
        return view('home');
    })->name('/');

    Route::get('leaveapplication','EmployeeController@displayLeaveApplication')->name('admin/leaveapplication');
});




