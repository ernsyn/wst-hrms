<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */
Route::group([
    'middleware' => [
        'guest'
    ]
], function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('/');
});

Auth::routes();

Route::get('setup', 'AdminController@displaySetupCompany')->name('setup');

Route::group([
    'prefix' => 'setup',
    'middleware' => [
        'auth',
        'role:super-admin|admin'
    ]
], function () {
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

Route::group([
    'prefix' => 'super-admin',
    'middleware' => [
        'auth',
        'role:super-admin|admin'
    ]
], function () {
    Route::get('', 'SuperAdmin\DashboardController@index')->name('super-admin.dashboard');
});

Route::group([
    'prefix' => 'admin',
    'middleware' => [
        'auth',
        'role:super-admin|admin'
    ]
], function () {
    Route::get('', 'Admin\DashboardController@index')->name('admin.dashboard');

    Route::get('home', 'HomeController@index')->name('admin.home');

    Route::get('/employee/add', 'EmployeeDataController@addEmployee')->name('employee/add');
    Route::get('profile-employee/emergencycontact', 'AdminController@displayEmergencyContact')->name('admin/emergencycontact');
    Route::get('profile-employee/dependent', 'AdminController@displayEmployeeDependent')->name('admin/dependent');
    Route::get('profile-employee/employeeimmigration', 'AdminController@displayEmployeeImmigration')->name('admin/employeeimmigration');
    Route::get('profile-employee/employeevisa', 'AdminController@displayEmployeeVisa')->name('admin/employeevisa');
    Route::get('profile-employee/employeebank', 'AdminController@displayEmployeeBank')->name('admin/employeebank');
    Route::get('profile-employee/employeejob', 'AdminController@displayEmployeeJob')->name('admin/employeejob');
    Route::get('profile-employee/employee_experience', 'AdminController@displayQualificationExperience')->name('admin/employee_bank');
    Route::get('profile-employee/employee_education', 'AdminController@displayQualificationEducation')->name('admin/employee_bank');
    Route::get('profile-employee/employee_skill', 'AdminController@displayQualificationSkill')->name('admin/employee_bank');
    Route::get('profile-employee/attachment', 'AdminController@displayAttachment')->name('admin/attachment');
    Route::get('employee_list', 'AdminController@displayAllEmployee')->name('admin/employee_list');
    // Route::get('user_list', 'EmployeeDataController@index')->name('admin/user_list');
    Route::get('/admin/report-to', 'AdminController@displayReportTo')->name('admin/report-to');
    Route::get('/admin/history', 'AdminController@displayHistory')->name('admin/history');
    Route::get('/profile-employee/{id}', 'AdminController@displayProfile2')->name('admin/profile-employee/{id}');
    Route::get('user-list', 'AdminController@displayUserList')->name('admin/user_list');
    Route::get('edit-employee/{id}', 'AdminController@displayAddEmployeeProfile')->name('admin/edit-employee/{id}');
    Route::get('edit-employee', 'AdminController@displayAddEmployeeProfile')->name('admin/edit-employee');
    Route::get('resign', 'AdminController@employeeResign')->name('resign');

    // --setup company--
    Route::get('/setup/company-details/{id}', 'AdminController@displayCompanyDetails')->name('/setup/company-details/{id}');
    Route::get('/setup/company-bank', 'AdminController@displayCompanyBank')->name('/setup/company-bank');
    Route::post('add_company_bank', 'AdminController@addCompanyBank')->name('add_company_bank');
    Route::post('add_security_group', 'AdminController@addSecurityGroup')->name('add_security_group');
    Route::post('add_company_addition', 'AdminController@addCompanyAddition')->name('add_company_addition');
    Route::post('add_company_deduction', 'AdminController@addCompanyDeduction')->name('add_company_deduction');

    Route::post('edit_employee_dependent', 'AdminController@editEmployeeDependent')->name('edit_employee_dependent');
    Route::post('edit_emergency_contact', 'AdminController@editEmergencyContact')->name('edit_emergency_contact');
    Route::post('edit_immigration', 'AdminController@editEmployeeImmigration')->name('edit_immigration');
    Route::post('edit_visa', 'AdminController@editEmployeeVisa')->name('edit_visa');
    Route::post('edit_bank', 'AdminController@editEmployeeBank')->name('edit_bank');
    Route::post('edit_qualification_company', 'AdminController@editQualificationCompany')->name('edit_qualification_company');
    Route::post('edit_qualification_education', 'AdminController@editQualificationEducation')->name('edit_qualification_education');
    Route::post('edit_qualification_skills', 'AdminController@editQualificationSkills')->name('edit_qualification_skills');
    Route::post('edit_cost_centre', 'AdminController@editCostCentre')->name('edit_cost_centre');
    Route::post('edit_grade', 'AdminController@editGrade')->name('edit_grade');
    Route::post('edit_position', 'AdminController@editPosition')->name('edit_position');
    Route::post('edit_department', 'AdminController@editDepartment')->name('edit_department');
    Route::post('edit_team', 'AdminController@editTeam')->name('edit_team');
    Route::post('edit_branch', 'AdminController@editBranch')->name('edit_branch');
    Route::post('edit_company', 'AdminController@editCompany')->name('edit_company');
    Route::post('edit_leave_balance', 'AdminController@editLeaveBalance')->name('edit_leave_balance');
    Route::post('edit_company_bank', 'AdminController@editCompanyBank')->name('edit_company_bank');
    Route::post('edit_security_group', 'AdminController@editSecurityGroup')->name('edit_security_group');
    Route::post('edit_company_addition', 'AdminController@editCompanyAddition')->name('edit_company_addition');
    Route::post('edit_company_deduction', 'AdminController@editCompanyDeduction')->name('edit_company_deduction');
    Route::post('edit_job', 'AdminController@editJob')->name('edit_job');

    Route::post('edit_employee_popup', 'AdminController@editEmployeeProfileBasic')->name('edit_employee_popup');
    Route::post('edit_profile_popup', 'AdminController@editProfilePopup')->name('edit_profile_popup');
    Route::post('edit_company_popup', 'AdminController@editCompanyPopup')->name('edit_company_popup');

    Route::post('add_emergency_contact', 'AdminController@addEmergencyContact')->name('add_emergency_contact');
    Route::post('add_employee_dependent', 'AdminController@addEmployeeDependent')->name('add_employee_dependent');
    Route::post('add_employee_immigration', 'AdminController@addEmployeeImmigration')->name('add_employee_immigration');
    Route::post('add_employee_visa', 'AdminController@addEmployeeVisa')->name('add_employee_visa');
    Route::post('add_employee_bank', 'AdminController@addEmployeeBank')->name('add_employee_bank');
    Route::post('add_qualification_experience', 'AdminController@addQualificationCompany')->name('add_qualification_experience');
    Route::post('add_qualification_education', 'AdminController@addQualificationEducation')->name('add_qualification_education');
    Route::post('add_qualification_skills', 'AdminController@addQualificationSkills')->name('add_qualification_skills');
    Route::post('add_report_to', 'AdminController@addReportTo')->name('add_report_to');
    Route::post('add_cost_centre', 'AdminController@addCostCentre')->name('add_cost_centre');
    Route::post('add_department', 'AdminController@addDepartment')->name('add_department');
    Route::post('add_branch', 'AdminController@addBranch')->name('add_branch');
    Route::post('add_team', 'AdminController@addTeam')->name('add_team');
    Route::post('add_position', 'AdminController@addPosition')->name('add_position');
    Route::post('add_grade', 'AdminController@addGrade')->name('add_grade');
    Route::post('add_company', 'AdminController@addSetupCompany')->name('add_company');
    Route::post('add_holiday', 'AdminController@addHoliday')->name('add_holiday');
    Route::post('register_employee4', 'AdminController@addProfile3')->name('register_employee4');
    Route::post('register_employee', 'EmployeeDataController@insert')->name('register_employee');
    Route::post('approve_leave', 'AdminController@approvedLeaveRequest')->name('approve_leave');
    Route::post('disapprove_leave', 'AdminController@disapprovedLeaveRequest')->name('disapprove_leave');
    Route::post('add_leave_balance', 'AdminController@addLeaveBalance')->name('add_leave_balance');
    Route::post('add_job', 'AdminController@addJob')->name('add_job');

    Route::get('leaveapplication', 'EmployeeController@displayLeaveApplication')->name('admin/leaveapplication');
    Route::get('leavetype', 'AdminController@displayEmployeeLeave')->name('admin/leavetype');
    Route::get('leaverequest', 'AdminController@displayLeaveRequest')->name('admin/leaverequest');
    Route::get('leavebalance', 'AdminController@displayLeaveBalance')->name('admin/leavebalance');
    Route::get('leaveholiday', 'AdminController@displayLeaveHoliday')->name('admin/leaveholiday');
});

Route::group([
    'middleware' => [
        'auth',
        'role:super-admin|admin|employee'
    ]
], function () {
    Route::get('', 'HomeController@index')->name('home');
    Route::get('/employee', 'EmployeeController@displayProfile')->name('employee');
    Route::get('profile', 'EmployeeController@displayProfile')->name('profile');
    Route::get('emergencycontact', 'EmployeeController@displayEmergencyContact')->name('emergencycontactdata');
    Route::get('dependentdata', 'EmployeeController@displayEmployeeDependent')->name('dependent');
    Route::get('employeeimmigrationdata', 'EmployeeController@displayImmigration')->name('immigration');
    Route::get('qualificationcompaniesdata', 'EmployeeController@displayQualificationCompanies')->name('companies');
    Route::get('qualificationeducationsdata', 'EmployeeController@displayQualificationEducations')->name('educations');
    Route::get('qualificationskillsdata', 'EmployeeController@displayQualificationSkills')->name('skills');
    Route::get('employeevisadata', 'EmployeeController@displayVisa')->name('visa');
    Route::get('employeebankdata', 'EmployeeController@displayBank')->name('bank');
    Route::get('jobdata', 'EmployeeController@displayJob')->name('job');
    Route::get('reporttodata', 'EmployeeController@displayReportTo')->name('reportto');
    Route::get('historydata', 'EmployeeController@displayHistory')->name('history');
    Route::get('attachmentdata', 'EmployeeController@displayAttachment')->name('attachment');

    Route::get('leaveapplication', 'EmployeeController@displayLeaveApplication')->name('employee/leaveapplication');
    Route::get('leavetype', 'EmployeeController@displayEmployeeLeave')->name('employee/leavetype');
    Route::get('leaverequest', 'EmployeeController@displayLeaveRequest')->name('employee/leaverequest');
    Route::get('leavebalance', 'EmployeeController@displayLeaveBalance')->name('employee/leavebalance');
    Route::get('leaveholiday', 'EmployeeController@displayLeaveHoliday')->name('employee/leaveholiday');

    Route::post('add_leave_application', 'EmployeeController@addLeaveApplication')->name('add_leave_application');
});

// Route::group(['prefix' => 'admin', 'middleware' => ['role:employee']], function() {
// Route::get('/', function () {
// return view('home');
// })->name('/');

// Route::get('leaveapplication','EmployeeController@displayLeaveApplication')->name('admin/leaveapplication');
// });

/**
 * Payroll related route
 */

Route::resource('payroll', 'Payroll\PayrollController');
Route::get('payroll', 'Payroll\PayrollController@index')->name('payroll');
Route::post('payroll/store', 'Payroll\PayrollController@store')->name('payroll.store');
Route::get('payroll/{id}', 'Payroll\PayrollController@show')->name('payroll.show');
// Route::get('/payroll/show/{id}', 'Payroll\PayrollController@show')->name('payroll/show/{id}');
Route::post('/payroll/status/{id}', 'Payroll\PayrollController@updatePayrollStatus')->name('payroll.status.update');
Route::get('/payroll/trx/{id}', 'Payroll\PayrollController@showPayrollTrx')->name('payroll.trx.show');
Route::post('/payroll/trx/{id}', 'Payroll\PayrollController@updatePayrollTrx')->name('payroll.trx.update');

Route::get('government_report', 'payroll\GovernmentReportController@viewGovernmentReport')->name('payroll/government_report');
