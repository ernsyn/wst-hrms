<?php

use App\Constants\PermissionConstant;

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

Route::group(['middleware' => ['auth']], function() {
    Route::get('/profile','Employee\EmployeeController@displayProfile')->name('employee.profile');
    Route::get('/asset','Employee\EmployeeController@displayAsset')->name('employee.asset');
    Route::post('auth/{id}/change-password','AuthController@postChangePassword')->name('auth.change-password.post')->where('id', '[0-9]+');
     Route::get('/assetattach/{id}','Employee\EmployeeController@displayAttach')->name('employee.assetattach')->where('id', '[0-9]+');
});

// MODE: Employee
Route::group(['middleware' => ['auth']], function() {
    Route::get('', 'HomeController@index')->name('employee.dashboard');

    Route::post('profile/change-password','Employee\EmployeeController@postChangePassword')->name('employee.change-password.post')->where('id', '[0-9]+');
    Route::get('employees/id/working-days/{emp_id}', 'Employee\EmployeeController@getEmployeeWorkingDay')->name('employee.id.working-day.get')->where('id', '[0-9]+');
    Route::get('employee/e-leave/{id}/attachment', 'Employee\EleaveController@getLeaveRequestAttachment')->name('employee.e-leave.attachment')->where('id', '[0-9]+');;
    //employee leave
    Route::get('employee/e-leave','Employee\ELeaveController@displayLeaveApplication')->name('employee.e-leave.leave-application');
    Route::get('employee/e-leave/approve-leave/{id}/add','Employee\ELeaveController@addLeaveApproval')->name('employee.e-leave.add-leave-request')->where('id', '[0-9]+');
    Route::post('employee/e-leave/approve-leaves/{id}/add','Employee\ELeaveController@postAddApproval')->name('employee.e-leave.add-leave-request.post')->where('id', '[0-9]+');
    Route::post('employee/e-leave/approve-leave','Employee\ELeaveController@approvedLeaveRequest')->name('approve-leave');
    Route::get('employee/e-leave/disapprove-leave/{id}/add','Employee\ELeaveController@rejectLeaveApproval')->name('employee.e-leave.add-leave-request-disapprove')->where('id', '[0-9]+');
    Route::post('employee/e-leave/approve-leaves/{id}/reject','Employee\ELeaveController@postDisapproved')->name('employee.e-leave.add-leave-request-disapprove.post')->where('id', '[0-9]+');
    Route::get('employee/e-leave/approvals','Employee\ELeaveController@displayLeaveApproval')->name('employee.e-leave.request');
    Route::get('employee/e-leave/requests','Employee\ELeaveController@displayLeaveRequests')->name('employee.e-leave.history');
    Route::get('e-leave/rules/{leave_type_id}', 'Employee\ELeaveController@ajaxGetLeaveRules')->name('employee.e-leave.rules.ajax.get')->where('leave_type_id', '[0-9]+');
    Route::get('e-leave/days/{start_date}/{end_date}', 'Employee\ELeaveController@ajaxCalculateActualLeaveDays')
    ->name('employee.e-leave.days.ajax.get')->where(['start_date' => '[A-Za-z0-9\-\/]+', 'end_date' => '[A-Za-z0-9\-\/]+']);
    Route::post('e-leave/working-day','Employee\ELeaveController@postLeaveRequest')->name('employee.e-leave.leave-request.post')->where('id', '[0-9]+');

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

    Route::get('employees/dt/audit-trail', 'Employee\EmployeeController@getDataTableAuditTrails')->name('employee.dt.audit-trail');

    Route::get('employee/attendances', 'Employee\EmployeeController@ajaxGetAttendances')->name('employee.attendances.get');
    Route::post('employee/dependents','Employee\EmployeeController@postDependent')->name('employee.dependents.post');

    //employee edit profile
    Route::post('employees/profile-pic','Employee\EmployeeController@postEditProfilePicture')->name('employees.profile-pic.edit.post');
    Route::post('employee/emergency-contacts/{id}/edit','Employee\EmployeeController@postEditEmergencyContact')->name('employee.emergency-contacts.edit.post');
    Route::post('employee/dependents/{id}/edit','Employee\EmployeeController@postEditDependent')->name('employee.dependents.edit.post');
    Route::post('employee/profile/edit','Employee\EmployeeController@postEditProfile')->name('employee.profile.edit.post');

    Route::post('employee/emergency-contacts','Employee\EmployeeController@postEmergencyContact')->name('employee.emergency-contacts.post');
    
    Route::post('employee/immigrations','Employee\EmployeeController@postImmigration')->name('employee.immigrations.post');
    Route::post('employee/visas','Employee\EmployeeController@postVisa')->name('employee.visas.post');
    Route::post('employees/{emp_id}/attachments','Employee\EmployeeController@postAttachment')->name('employee.attachments.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/attachments/{id}/edit','Employee\EmployeeController@postEditAttachment')->name('employee.attachments.edit.post')->where('id', '[0-9]+');
    Route::get('employees/{emp_id}/attachments/{id}/delete','Employee\EmployeeController@deleteAttachment')->name('employee.attachments.delete')->where('id', '[0-9]+');
    
    Route::post('e-leave/working-day','Employee\ELeaveController@postLeaveRequest')->name('employee.e-leave.leave-request.post')->where('id', '[0-9]+');
    Route::get('e-leave/types', 'Employee\ELeaveController@ajaxGetLeaveTypes')->name('employee.e-leave.ajax.types');
    Route::post('e-leave/request/check', 'Employee\ELeaveController@ajaxPostCheckLeaveRequest')->name('employee.e-leave.ajax.request.check');
    Route::post('e-leave/request', 'Employee\ELeaveController@ajaxPostCreateLeaveRequest')->name('employee.e-leave.ajax.request');
    Route::get('e-leave/request/{status}', 'Employee\ELeaveController@ajaxGetEmployeeLeaves')->name('employee.e-leave.ajax.status')->where('status', '[A-Za-z0-9\-\/]+');
    Route::get('e-leave/working-days', 'Employee\ELeaveController@ajaxGetEmployeeWorkingDays')->name('employee.e-leave.ajax.working-days');
    Route::get('e-leave/employee-job', 'Employee\ELeaveController@ajaxCheckEmployeeJob')->name('employee.e-leave.ajax.employee-job');
    Route::get('e-leave/holidays', 'Employee\ELeaveController@ajaxGetHolidays')->name('employee.e-leave.ajax.holidays');
    Route::get('e-leave/edit/{id}', 'Employee\ELeaveController@ajaxGetLeaveRequestSingle')->name('employee.e-leave.ajax.edit')->where('id', '[0-9]+');
    Route::post('e-leave/edit/{id}/post','Employee\ELeaveController@ajaxPostEditLeaveRequest')->name('employee.e-leave.ajax.edit.post')->where('id', '[0-9]+');
    Route::get('e-leave/delete/{id}','Employee\ELeaveController@ajaxCancelLeaveRequest')->name('employee.e-leave.ajax.delete')->where('id', '[0-9]+');

    //employee/delete
    Route::get('employees/emergency-contacts/{id}/delete','Employee\EmployeeController@deleteEmergencyContact')->name('employee.emergency-contacts.delete');
    Route::get('employees/dependents/{id}/delete','Employee\EmployeeController@deleteDependent')->name('employee.dependents.delete')->where('id', '[0-9]+');
    
});

// MODE: Admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_ADMIN_DASHBOARD]], function () {
        Route::get('', 'Admin\DashboardController@index')->name('admin.dashboard');
    });
    
    // SECTION: EMPLOYEE
    // > View
    // Employee
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_EMPLOYEE]], function () {
        Route::get('employees', 'Admin\EmployeeController@index')->name('admin.employees');
        Route::get('get-employees-datatables', 'Admin\EmployeeController@getDataTableEmployees')->name('get.employees.data');
        Route::get('employees/{id}','Admin\EmployeeController@display')->name('admin.employees.id')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_EMPLOYEE]], function () {
        Route::get('employees/add', 'Admin\EmployeeController@add')->name('admin.employees.add')->where('id', '[0-9]+');
        Route::post('employees/add','Admin\EmployeeController@postAdd')->name('admin.employees.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::RESET_PASSWORD]], function () {
        Route::post('employees/{id}/reset-password','Admin\EmployeeController@postResetPassword')->name('admin.employees.reset-password.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::EDIT_PROFILE]], function () {
        Route::post('employees/{id}/edit','Admin\EmployeeController@postEditProfile')->name('admin.employees.profile.edit.post')->where('id', '[0-9]+');
        Route::post('employees/{emp_id}/profile-pic/edit','Admin\EmployeeController@postEditProfilePicture')->name('admin.employees.profile-pic.edit.post')->where('emp_id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::EXPORT_EMPLOYEE]], function () {
        Route::get('export-employees', 'Admin\EmployeeController@exportEmployees')->name('export.employees');
    });
    
    // Emergency_Contact
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_EMERGENCY_CONTACT]], function () {
        Route::get('employees/{id}/dt/emergency-contacts', 'Admin\EmployeeController@getDataTableEmergencyContacts')->name('admin.employees.dt.emergency-contacts')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_EMERGENCY_CONTACT]], function () {
        Route::post('employees/{emp_id}/emergency-contacts','Admin\EmployeeController@postEmergencyContact')->name('admin.employees.emergency-contacts.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_EMERGENCY_CONTACT]], function () {
        Route::post('employees/{emp_id}/emergency-contacts/{id}/edit','Admin\EmployeeController@postEditEmergencyContact')->name('admin.employees.emergency-contacts.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_EMERGENCY_CONTACT]], function () {
        Route::get('employees/{emp_id}/emergency-contacts/{id}/delete','Admin\EmployeeController@deleteEmergencyContact')->name('admin.settings.emergency-contacts.delete')->where('id', '[0-9]+');
    });
    
    // Dependent
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_DEPENDENT]], function () {
        Route::get('employees/{id}/dt/dependents', 'Admin\EmployeeController@getDataTableDependents')->name('admin.employees.dt.dependents')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_DEPENDENT]], function () {
        Route::post('employees/{emp_id}/dependents','Admin\EmployeeController@postDependent')->name('admin.employees.dependents.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_DEPENDENT]], function () {
        Route::post('employees/{emp_id}/dependents/{id}/edit','Admin\EmployeeController@postEditDependent')->name('admin.employees.dependents.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_DEPENDENT]], function () {
        Route::get('employees/{emp_id}/dependents/{id}/delete','Admin\EmployeeController@deleteDependent')->name('admin.settings.dependents.delete')->where('id', '[0-9]+');
    });
    
    // Immigration
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_IMMIGRATION]], function () {
        Route::get('employees/{id}/dt/immigrations', 'Admin\EmployeeController@getDataTableImmigrations')->name('admin.employees.dt.immigrations')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_IMMIGRATION]], function () {
        Route::post('employees/{emp_id}/immigrations','Admin\EmployeeController@postImmigration')->name('admin.employees.immigrations.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_IMMIGRATION]], function () {
        Route::post('employees/{emp_id}/immigrations/{id}/edit','Admin\EmployeeController@postEditImmigration')->name('admin.employees.immigrations.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_IMMIGRATION]], function () {
        Route::get('employees/{emp_id}/immigrations/{id}/delete','Admin\EmployeeController@deleteImmigration')->name('admin.settings.immigrations.delete')->where('id', '[0-9]+');
    });
    
    // Visa
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_VISA]], function () {
        Route::get('employees/{id}/dt/visas', 'Admin\EmployeeController@getDataTableVisas')->name('admin.employees.dt.visas')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_VISA]], function () {
        Route::post('employees/{emp_id}/visas','Admin\EmployeeController@postVisa')->name('admin.employees.visas.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_VISA]], function () {
        Route::post('employees/{emp_id}/visas/{id}/edit','Admin\EmployeeController@postEditVisa')->name('admin.employees.visas.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_VISA]], function () {
        Route::get('employees/{emp_id}/visas/{id}/delete','Admin\EmployeeController@deleteVisa')->name('admin.settings.visas.delete')->where('id', '[0-9]+');
    });
    
    // Job
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_JOB]], function () {
        Route::get('employees/{id}/dt/jobs', 'Admin\EmployeeController@getDataTableJobs')->name('admin.employees.dt.jobs')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_JOB]], function () {
        Route::post('employees/{emp_id}/jobs','Admin\EmployeeController@postJob')->name('admin.employees.jobs.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_JOB]], function () {
        Route::post('employees/{emp_id}/jobs/{id}/edit','Admin\EmployeeController@postEditJob')->name('admin.employees.jobs.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_JOB]], function () {
        Route::get('employees/{emp_id}/jobs/{id}/delete','Admin\EmployeeController@deleteJob')->name('admin.employees.jobs.delete')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::RESIGN]], function () {
        Route::post('employees/{id}/action/resign', 'Admin\EmployeeController@postResign')->name('admin.employees.id.action.resign')->where('id', '[0-9]+');
    });
    
    // Bank
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_BANK]], function () {
        Route::get('employees/{id}/dt/bank-accounts', 'Admin\EmployeeController@getDataTableBankAccounts')->name('admin.employees.dt.bank-accounts')->where('id', '[0-9]+');
    });

     Route::get('employees/{id}/dt/overview', 'Admin\EmployeeController@getDataTableDiscipline')->name('admin.employees.dt.overview')->where('id', '[0-9]+');

    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_BANK]], function () {
        Route::post('employees/{emp_id}/bank-accounts','Admin\EmployeeController@postBankAccount')->name('admin.employees.bank-accounts.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_BANK]], function () {
        Route::post('employees/{emp_id}/bank-accounts/{id}/edit','Admin\EmployeeController@postEditBankAccount')->name('admin.employees.bank-accounts.edit')->where('id', '[0-9]+');
        Route::post('employees/{emp_id}/bank-accounts/{id}/edit','Admin\EmployeeController@postEditBankAccount')->name('admin.employees.bank-accounts.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_BANK]], function () {
        Route::get('employees/{emp_id}/bank-accounts/{id}/delete','Admin\EmployeeController@deleteBankAccount')->name('admin.settings.bank-accounts.delete')->where('id', '[0-9]+');
    });
    
    // Experience
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_EXPERIENCE]], function () {
        Route::get('employees/{id}/dt/experiences', 'Admin\EmployeeController@getDataTableExperiences')->name('admin.employees.dt.experiences')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_EXPERIENCE]], function () {
        Route::post('employees/{emp_id}/companies','Admin\EmployeeController@postExperience')->name('admin.employees.experiences.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_EXPERIENCE]], function () {
        Route::post('employees/{emp_id}/experiences/{id}/edit','Admin\EmployeeController@postEditExperience')->name('admin.employees.experiences.edit')->where('id', '[0-9]+');
        Route::post('employees/{emp_id}/experiences/{id}/edit','Admin\EmployeeController@postEditExperience')->name('admin.employees.experiences.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_EXPERIENCE]], function () {
        Route::get('employees/{emp_id}/experiences/{id}/delete','Admin\EmployeeController@deleteExperience')->name('admin.settings.experiences.delete')->where('id', '[0-9]+');
    });
    
    // Education
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_EDUCATION]], function () {
        Route::get('employees/{id}/dt/education', 'Admin\EmployeeController@getDataTableEducation')->name('admin.employees.dt.education')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_EDUCATION]], function () {
        Route::post('employees/{emp_id}/educations','Admin\EmployeeController@postEducation')->name('admin.employees.educations.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_EDUCATION]], function () {
        Route::post('employees/{emp_id}/educations/{id}/edit','Admin\EmployeeController@postEditEducation')->name('admin.employees.educations.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_EDUCATION]], function () {
        Route::get('employees/{emp_id}/educations/{id}/delete','Admin\EmployeeController@deleteEducation')->name('admin.settings.educations.delete')->where('id', '[0-9]+');
    });
    
    // Skill
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_SKILL]], function () {
        Route::get('employees/{id}/dt/skills', 'Admin\EmployeeController@getDataTableSkills')->name('admin.employees.dt.skills')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_SKILL]], function () {
        Route::post('employees/{emp_id}/skills','Admin\EmployeeController@postSkill')->name('admin.employees.skills.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_SKILL]], function () {
        Route::post('employees/{emp_id}/skills/{id}/edit','Admin\EmployeeController@postEditSkill')->name('admin.employees.skills.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_SKILL]], function () {
        Route::get('employees/{emp_id}/skills/{id}/delete','Admin\EmployeeController@deleteSkill')->name('admin.settings.skills.delete')->where('id', '[0-9]+');
    });
    
    // Attachment
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_ATTACHMENT]], function () {
        Route::get('employees/{id}/dt/attachments', 'Admin\EmployeeController@getDataTableAttachments')->name('admin.employees.dt.attachments')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_ATTACHMENT]], function () {
        Route::post('employees/{emp_id}/attachments','Admin\EmployeeController@postAttachment')->name('admin.employees.attachments.post')->where('id', '[0-9]+');
    });
    Route::post('employees/{emp_id}/attachments/{id}/edit','Admin\EmployeeController@postEditAttachment')->name('admin.employees.attachments.edit.post')->where('id', '[0-9]+');

    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_ATTACHMENT]], function () {
        Route::get('employees/{emp_id}/attachments/{id}/delete','Admin\EmployeeController@deleteAttachment')->name('admin.settings.attachments.delete')->where('id', '[0-9]+');
    });
    
    // Work Days
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_WORK_DAYS]], function () {
        Route::get('employees/id/working-days/{emp_id}', 'Admin\EmployeeController@getEmployeeWorkingDay')->name('admin.employees.id.working-day.get')->where('id', '[0-9]+');
    });
    
    // Report To
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_REPORT_TO]], function () {
        Route::get('employees/{id}/dt/report-tos', 'Admin\EmployeeController@getDataTableReportTo')->name('admin.employees.dt.report-tos')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_REPORT_TO]], function () {
        Route::post('employees/{emp_id}/report-to','Admin\EmployeeController@postReportTo')->name('admin.employees.report-to.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_REPORT_TO]], function () {
        Route::post('employees/{emp_id}/report-to/{id}/edit','Admin\EmployeeController@postEditReportTo')->name('admin.employees.report-to.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_REPORT_TO]], function () {
        Route::get('employees/{emp_id}/report-tos/{id}/delete','Admin\EmployeeController@deleteReportTo')->name('admin.settings.report-tos.delete')->where('id', '[0-9]+');
    });
    
    // History
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_HISTORY]], function () {
        Route::get('employees/{id}/dt/audit-trail', 'Admin\EmployeeController@getDataTableAuditTrails')->name('admin.employees.dt.audit-trail')->where('id', '[0-9]+');
    });  
        
    // Security Group
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_EMP_SECURITY_GROUP]], function () {
        Route::get('employees/{id}/security-groups','Admin\EmployeeController@securityGroupDisplay')->name('admin.employees.id.security-group')->where('id', '[0-9]+');
        Route::get('employees/{id}/dt/security-groups', 'Admin\EmployeeController@getDataTableSecurityGroup')->name('admin.employees.dt.security-groups')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_EMP_SECURITY_GROUP]], function () {
       Route::post('employees/{emp_id}/security-group','Admin\EmployeeController@postSecurityGroup')->name('admin.employees.security-groups.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_EMP_SECURITY_GROUP]], function () {
        Route::post('employees/{emp_id}/security-group/{id}/delete','Admin\EmployeeController@postDeleteSecurityGroup')->name('admin.employees.security-groups.delete')->where('id', '[0-9]+');
        Route::post('employees/{emp_id}/main-security-group/{id}/delete','Admin\EmployeeController@postDeleteSecurityGroup')->name('admin.employees.main-security-groups.delete')->where('id', '[0-9]+');
        Route::get('employees/{emp_id}/security-groups/{id}/delete','Admin\EmployeeController@deleteSecurityGroup')->name('admin.settings.security-groups.delete')->where('id', '[0-9]+');
    });
    
    // Attendance
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_ATTENDANCE]], function () {
        Route::get('employees/{id}/attendances', 'Admin\EmployeeController@ajaxGetAttendances')->name('admin.employees.attendances.get')->where('id', '[0-9]+');
    });
    
    Route::post('employees/{id}/roles/admin','Admin\EmployeeController@postToggleRoleAdmin')->name('admin.employees.roles.admin.post')->where('id', '[0-9]+');
    Route::get('changepassword', 'Admin\EmployeeController@changepassword')->name('admin.changepassword');
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_ASSET]], function () {
        Route::get('employees/assetlist', 'Admin\EmployeeController@assetList')->name('admin.employees.assetlist');
        Route::get('employees/assetid/{id}','Admin\EmployeeController@assetDisplay')->name('admin.employees.assetid')->where('id', '[0-9]+');  
    });
  
    Route::group(['middleware' => ['permission:Assign Role']], function () {
    Route::post('employees/{id}/update-roles','Admin\EmployeeController@postEditRoles')->name('admin.employees.update-roles.admin.post')->where('id', '[0-9]+');
    });
    
    // > Data Tables
    Route::get('employees/{id}/dt/employee-assets', 'Admin\EmployeeController@getDataTableEmployeeAssets')->name('admin.employees.dt.employee-assets')->where('id', '[0-9]+');

    // > Ajax
    Route::get('employees/{id}/report-to/employee-list', 'Admin\EmployeeController@getReportToEmployeeList')->name('admin.employees.report-to.employee-list')->where('id', '[0-9]+');
    Route::get('employees/assetlist/employee-list', 'Admin\EmployeeController@ajaxGetEmployees')->name('admin.e-leave.ajax.employees');

    // > Add / Edit
     Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_ASSET]], function () {
        Route::post('employees/{emp_id}/employee-assets','Admin\EmployeeController@postAddAsset')->name('admin.employees.employee-assets.post')->where('id', '[0-9]+');
        Route::post('employees/assetlist','Admin\EmployeeController@postAsset')->name('admin.employees.assetlist.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_ASSET_ATTACH]], function () {
        Route::post('employees/{id}/assetattach','Admin\EmployeeController@postAddAttach')->name('admin.employees.assetattach.post')->where('id', '[0-9]+');
    });
    Route::get('employees/assetattach/{id}','Admin\EmployeeController@displayAttach')->name('admin.employees.assetattach')->where('id', '[0-9]+');
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_ASSET_ATTACH]], function () {
        Route::get('employees/assetattach/{id}/delete','Admin\EmployeeController@deleteAssetAttach')->name('admin.employees.assetattach.delete')->where('id', '[0-9]+');
    });
    Route::post('employees/{emp_id}/working-day','Admin\EmployeeController@postWorkingDay')->name('admin.employees.working-days.post')->where('id', '[0-9]+');
    
    //admin edit
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_ASSET]], function () 
    {
        Route::post('employees/{emp_id}/employee-assets/{id}/edit','Admin\EmployeeController@postEditEmployeeAsset')->name('admin.employees.employee-assets.edit.post')->where('id', '[0-9]+');
    });

    Route::post('employees/{emp_id}/overview','Admin\EmployeeController@postAddDiscipline')->name('admin.employees.overview.post')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/overview/{id}/edit','Admin\EmployeeController@postEditDiscipline')->name('admin.employees.overview.edit.post')->where('id', '[0-9]+');
     Route::get('employees/{emp_id}/overview/{id}/delete','Admin\EmployeeController@deleteDisciplinary')->name('admin.settings.overview.delete')->where('id', '[0-9]+');

    Route::post('employees/{emp_id}/companies/{id}/edit','Admin\EmployeeController@postEditCompany')->name('admin.employees.companies.edit')->where('id', '[0-9]+');
    Route::post('employees/{emp_id}/companies/{id}/edit','Admin\EmployeeController@postEditCompany')->name('admin.employees.companies.edit.post')->where('id', '[0-9]+');
 
    Route::post('employees/{emp_id}/security-group/{id}/edit','Admin\EmployeeController@postEditSecurityGroup')->name('admin.employees.security-groups.edit.post')->where('id', '[0-9]+');
    
    Route::post('employees/{emp_id}/main-security-group/{id}/edit','Admin\EmployeeController@postEditSecurityGroup')->name('admin.employees.main-security-groups.edit.post')->where('id', '[0-9]+');
     
    Route::post('employees/{emp_id}/working-day/edit','Admin\EmployeeController@postEditWorkingDay')->name('admin.employees.working-day.edit.post')->where('id', '[0-9]+');

    //admin/employee/delete
     Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_ASSET]], function () 
    {
        Route::get('employees/{emp_id}/employee-assets/{id}/delete','Admin\EmployeeController@deleteEmployeeAsset')->name('admin.settings.employee-assets.delete')->where('id', '[0-9]+');
    });
    // SECTION: SETTINGS
    // Company
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_COMPANY]], function () {
        Route::get('settings/companies', 'Admin\SettingsController@displayCompanies')->name('admin.settings.companies');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_COMPANY]], function () {
        Route::get('settings/companies/add','Admin\SettingsController@addCompany')->name('admin.settings.companies.add');
        Route::post('settings/companies/add','Admin\SettingsController@postAddCompany')->name('admin.settings.companies.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_COMPANY]], function () {
        Route::get('settings/companies/{id}/edit','Admin\SettingsController@editCompany')->name('admin.settings.companies.edit')->where('id', '[0-9]+');
        Route::post('settings/companies/{id}/edit','Admin\SettingsController@postEditCompany')->name('admin.settings.companies.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_COMPANY]], function () {
        Route::get('settings/companies/{id}/delete','Admin\SettingsController@deleteCompany')->name('admin.settings.companies.delete')->where('id', '[0-9]+');
    });
    
    // Cost_Centre
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_COST_CENTRE]], function () {
        Route::get('settings/cost-centres', 'Admin\SettingsController@displayCostCentres')->name('admin.settings.cost-centres');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_COST_CENTRE]], function () {
        Route::get('settings/cost-centres/add','Admin\SettingsController@addCostCentre')->name('admin.settings.cost-centres.add');
        Route::post('settings/cost-centres/add','Admin\SettingsController@postAddCostCentre')->name('admin.settings.cost-centres.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_COST_CENTRE]], function () {
        Route::get('settings/cost-centres/{id}/edit','Admin\SettingsController@editCostCentre')->name('admin.settings.cost-centres.edit')->where('id', '[0-9]+');
        Route::post('settings/cost-centres/{id}/edit','Admin\SettingsController@postEditCostCentre')->name('admin.settings.cost-centres.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_COST_CENTRE]], function () {
        Route::get('settings/cost-centres/{id}/delete','Admin\SettingsController@deleteCostCentre')->name('admin.settings.cost-centres.delete')->where('id', '[0-9]+');
    });            
    
    // Company Details
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_COMPANY]], function () {
        Route::get('settings/company/{id}/company-details','Admin\SettingsController@displayCompanyDetails')->name('admin.settings.company.company-details')->where('id', '[0-9]+');
    });
    
    // Company Bank
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_COMPANY_BANK]], function () {
        Route::post('settings/company-banks/{id}/add','Admin\SettingsController@postAddCompanyBank')->name('admin.settings.company-banks.add.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_COMPANY_BANK]], function () {
        Route::post('settings/company-banks/edit','Admin\SettingsController@postEditCompanyBank')->name('admin.settings.company-banks.edit.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_COMPANY_BANK]], function () {
        Route::get('settings/company-banks/{id}/delete','Admin\SettingsController@deleteCompanyBank')->name('admin.settings.company-banks.delete')->where('id', '[0-9]+');
    });
    
    // Job Company
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_JOB_COMPANY]], function () {
        Route::post('settings/job-company/{id}/add','Admin\SettingsController@postAddJobCompany')->name('admin.settings.job-company.add.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_JOB_COMPANY]], function () {
        Route::post('settings/job-company/{id}/edit','Admin\SettingsController@postEditJobCompany')->name('admin.settings.job-company.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_JOB_COMPANY]], function () {
        Route::get('settings/job-company/{id}/delete','Admin\SettingsController@deleteJobCompany')->name('admin.settings.job-company.delete')->where('id', '[0-9]+');
    });
    
    // Security Group
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_SECURITY_GROUP]], function () {
        Route::get('settings/security-group', 'Admin\SettingsController@displaySecurityGroups')->name('admin.settings.security-group');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_SECURITY_GROUP]], function () {
        Route::get('settings/security-group/add','Admin\SettingsController@addSecurityGroup')->name('admin.settings.security-group.add');
        Route::post('settings/security-group/add','Admin\SettingsController@postAddSecurityGroup')->name('admin.settings.security-group.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_SECURITY_GROUP]], function () {
        Route::get('settings/security-group/{id}/edit','Admin\SettingsController@editSecurityGroup')->name('admin.settings.security-group.edit')->where('id', '[0-9]+');
        Route::post('settings/security-group/{id}/edit','Admin\SettingsController@postEditSecurityGroup')->name('admin.settings.security-group.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_SECURITY_GROUP]], function () {
        Route::get('settings/security-group/{id}/delete','Admin\SettingsController@deleteSecurityGroup')->name('admin.settings.security-group.delete')->where('id', '[0-9]+');
    });
    
    // Branch
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_BRANCH]], function () {
        Route::get('settings/branches', 'Admin\SettingsController@displayBranches')->name('admin.settings.branches');
        Route::get('settings/branches/{id}', 'Admin\SettingsController@showBranch')->name('admin.settings.branches.show')->where('id', '[0-9]+');
    });
        Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_BRANCH]], function () {
        Route::get('settings/branches/add','Admin\SettingsController@addBranch')->name('admin.settings.branches.add');
        Route::post('settings/branches/add','Admin\SettingsController@postAddBranch')->name('admin.settings.branches.add.post');
    });
        Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_BRANCH]], function () {
        Route::get('settings/branches/{id}/edit','Admin\SettingsController@editBranch')->name('admin.settings.branches.edit')->where('id', '[0-9]+');
        Route::post('settings/branches/{id}/edit','Admin\SettingsController@postEditBranch')->name('admin.settings.branches.edit.post')->where('id', '[0-9]+');
    });
        Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_BRANCH]], function () {
        Route::get('settings/branches/{id}/delete','Admin\SettingsController@deleteBranch')->name('admin.settings.branches.delete')->where('id', '[0-9]+');
    });
        
    // Team
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_TEAM]], function () {
        Route::get('settings/teams', 'Admin\SettingsController@displayTeams')->name('admin.settings.teams');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_TEAM]], function () {
        Route::get('settings/teams/add','Admin\SettingsController@addTeam')->name('admin.settings.teams.add');
        Route::post('settings/teams/add','Admin\SettingsController@postAddTeam')->name('admin.settings.teams.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_TEAM]], function () {
        Route::get('settings/teams/{id}/edit','Admin\SettingsController@editTeam')->name('admin.settings.teams.edit')->where('id', '[0-9]+');
        Route::post('settings/teams/{id}/edit','Admin\SettingsController@postEditTeam')->name('admin.settings.teams.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_TEAM]], function () {
        Route::get('settings/teams/{id}/delete','Admin\SettingsController@deleteTeam')->name('admin.settings.teams.delete')->where('id', '[0-9]+');
    });
    
    // Position
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_POSITION]], function () {
        Route::get('settings/positions', 'Admin\SettingsController@displayPositions')->name('admin.settings.positions');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_POSITION]], function () {
        Route::get('settings/positions/add','Admin\SettingsController@addPosition')->name('admin.settings.positions.add');
        Route::post('settings/positions/add','Admin\SettingsController@postAddPosition')->name('admin.settings.positions.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_POSITION]], function () {
        Route::get('settings/positions/{id}/edit','Admin\SettingsController@editPosition')->name('admin.settings.positions.edit')->where('id', '[0-9]+');
        Route::post('settings/positions/{id}/edit','Admin\SettingsController@postEditPosition')->name('admin.settings.positions.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_POSITION]], function () {
        Route::get('settings/positions/{id}/delete','Admin\SettingsController@deletePosition')->name('admin.settings.positions.delete')->where('id', '[0-9]+');
    });
    
    // Grade
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_GRADE]], function () {
        Route::get('settings/grades', 'Admin\SettingsController@displayGrades')->name('admin.settings.grades');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_GRADE]], function () {
        Route::get('settings/grades/add','Admin\SettingsController@addGrade')->name('admin.settings.grades.add');
        Route::post('settings/grades/add','Admin\SettingsController@postAddGrade')->name('admin.settings.grades.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_GRADE]], function () {
        Route::get('settings/grades/{id}/edit','Admin\SettingsController@editGrade')->name('admin.settings.grades.edit')->where('id', '[0-9]+');
        Route::post('settings/grades/{id}/edit','Admin\SettingsController@postEditGrade')->name('admin.settings.grades.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_GRADE]], function () {
        Route::get('settings/grades/{id}/delete','Admin\SettingsController@deleteGrade')->name('admin.settings.grades.delete')->where('id', '[0-9]+');
    });
    
    // Section
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_SECTION]], function () {
        Route::get('settings/sections', 'Admin\SettingsController@displaySections')->name('admin.settings.sections');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_SECTION]], function () {
        Route::get('settings/sections/add','Admin\SettingsController@addSection')->name('admin.settings.sections.add');
        Route::post('settings/sections/add','Admin\SettingsController@postAddSection')->name('admin.settings.sections.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_SECTION]], function () {
        Route::get('settings/sections/{id}/edit','Admin\SettingsController@editSection')->name('admin.settings.sections.edit')->where('id', '[0-9]+');
        Route::post('settings/sections/{id}/edit','Admin\SettingsController@postEditSection')->name('admin.settings.sections.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_SECTION]], function () {
        Route::get('settings/sections/{id}/delete','Admin\SettingsController@deleteSection')->name('admin.settings.sections.delete')->where('id', '[0-9]+');
    });
    
    // Area
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_AREA]], function () {
        Route::get('settings/areas', 'Admin\SettingsController@displayAreas')->name('admin.settings.areas');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_AREA]], function () {
        Route::get('settings/areas/add','Admin\SettingsController@addArea')->name('admin.settings.areas.add');
        Route::post('settings/areas/add','Admin\SettingsController@postAddArea')->name('admin.settings.areas.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_AREA]], function () {
        Route::get('settings/areas/{id}/edit','Admin\SettingsController@editArea')->name('admin.settings.areas.edit')->where('id', '[0-9]+');
        Route::post('settings/areas/{id}/edit','Admin\SettingsController@postEditArea')->name('admin.settings.areas.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_AREA]], function () {
        Route::get('settings/areas/{id}/delete','Admin\SettingsController@deleteArea')->name('admin.settings.areas.delete')->where('id', '[0-9]+');
    });
    
    // Bank Code
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_BANK_CODE]], function () {
        Route::get('settings/bank-code', 'Admin\SettingsController@displayBankCode')->name('admin.settings.bank-code');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_BANK_CODE]], function () {
        Route::get('settings/bank-code/add','Admin\SettingsController@addBankCode')->name('admin.settings.bank-code.add');
        Route::post('settings/bank-code/add','Admin\SettingsController@postAddBankCode')->name('admin.settings.bank-code.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_BANK_CODE]], function () {
        Route::get('settings/bank-code/{id}/edit','Admin\SettingsController@editBankCode')->name('admin.settings.bank-code.edit')->where('id', '[0-9]+');
        Route::post('settings/bank-code/{id}/edit','Admin\SettingsController@postEditBankCode')->name('admin.settings.bank-code.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_BANK_CODE]], function () {
        Route::get('settings/bank-code/{id}/delete','Admin\SettingsController@deleteBankCode')->name('admin.settings.bank-code.delete')->where('id', '[0-9]+');
    });
    
    // Category
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_CATEGORY]], function () {
        Route::get('settings/categories', 'Admin\SettingsController@displayCategories')->name('admin.settings.categories');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_CATEGORY]], function () {
        Route::get('settings/categories/add','Admin\SettingsController@addCategory')->name('admin.settings.categories.add');
        Route::post('settings/categories/add','Admin\SettingsController@postAddCategory')->name('admin.settings.categories.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_CATEGORY]], function () {
        Route::get('settings/categories/{id}/edit','Admin\SettingsController@editCategory')->name('admin.settings.categories.edit')->where('id', '[0-9]+');
        Route::post('settings/categories/{id}/edit','Admin\SettingsController@postEditCategory')->name('admin.settings.categories.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_CATEGORY]], function () {
        Route::get('settings/categories/{id}/delete','Admin\SettingsController@deleteCategory')->name('admin.settings.categories.delete')->where('id', '[0-9]+');
    });
    
    // EPF
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_EPF]], function () {
        Route::get('settings/epf', 'Admin\SettingsController@displayEpf')->name('admin.settings.epf');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_EPF]], function () {
        Route::get('settings/epf/add','Admin\SettingsController@addEpf')->name('admin.settings.epf.add');
        Route::post('settings/epf/add','Admin\SettingsController@postAddEpf')->name('admin.settings.epf.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_EPF]], function () {
        Route::get('settings/epf/{id}/edit','Admin\SettingsController@editEpf')->name('admin.settings.epf.edit')->where('id', '[0-9]+');
        Route::post('settings/epf/{id}/edit','Admin\SettingsController@postEditEpf')->name('admin.settings.epf.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_EPF]], function () {
        Route::get('settings/epf/{id}/delete','Admin\SettingsController@deleteEpf')->name('admin.settings.epf.delete')->where('id', '[0-9]+');
    });

    // EIS
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_EIS]], function () {
        Route::get('settings/eis', 'Admin\SettingsController@displayEis')->name('admin.settings.eis');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_EIS]], function () {
        Route::get('settings/eis/add','Admin\SettingsController@addEis')->name('admin.settings.eis.add');
        Route::post('settings/eis/add','Admin\SettingsController@postAddEis')->name('admin.settings.eis.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_EIS]], function () {
        Route::get('settings/eis/{id}/edit','Admin\SettingsController@editEis')->name('admin.settings.eis.edit')->where('id', '[0-9]+');
        Route::post('settings/eis/{id}/edit','Admin\SettingsController@postEditEis')->name('admin.settings.eis.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_EIS]], function () {
        Route::get('settings/eis/{id}/delete','Admin\SettingsController@deleteEis')->name('admin.settings.eis.delete')->where('id', '[0-9]+');
    });
    
    // SOCSO
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_SOCSO]], function () {
        Route::get('settings/socso', 'Admin\SettingsController@displaySocso')->name('admin.settings.socso');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_SOCSO]], function () {
        Route::get('settings/socso/add','Admin\SettingsController@addSocso')->name('admin.settings.socso.add');
        Route::post('settings/socso/add','Admin\SettingsController@postAddSocso')->name('admin.settings.socso.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_SOCSO]], function () {
        Route::get('settings/socso/{id}/edit','Admin\SettingsController@editSocso')->name('admin.settings.socso.edit')->where('id', '[0-9]+');
        Route::post('settings/socso/{id}/edit','Admin\SettingsController@postEditSocso')->name('admin.settings.socso.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_SOCSO]], function () {
        Route::get('settings/socso/{id}/delete','Admin\SettingsController@deleteSocso')->name('admin.settings.socso.delete')->where('id', '[0-9]+');
    });
                
    // PCB
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_PCB]], function () {
        Route::get('settings/pcb', 'Admin\SettingsController@displayPcb')->name('admin.settings.pcb');
        Route::get('get-pcb-data-datatables', ['as'=>'get.pcb.data','uses'=>'Admin\SettingsController@getPcbData']);
        Route::get('settings/pcb/get-category', 'Admin\SettingsController@getPcbCategory')->name('admin.settings.pcb.get-category');
        Route::get('settings/pcb/get-number-of-children', 'Admin\SettingsController@getPcbNumberOfChildren')->name('admin.settings.pcb.get-number-of-children');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_PCB]], function () {
        Route::get('settings/pcb/add','Admin\SettingsController@addPcb')->name('admin.settings.pcb.add');
        Route::post('settings/pcb/add','Admin\SettingsController@postAddPcb')->name('admin.settings.pcb.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_PCB]], function () {
        Route::get('settings/pcb/{id}/edit','Admin\SettingsController@editPcb')->name('admin.settings.pcb.edit')->where('id', '[0-9]+');
        Route::post('settings/pcb/{id}/edit','Admin\SettingsController@postEditPcb')->name('admin.settings.pcb.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_PCB]], function () {
        Route::get('settings/pcb/{id}/delete','Admin\SettingsController@deletePcb')->name('admin.settings.pcb.delete')->where('id', '[0-9]+');
    });
    
    // Employment Status
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_EMPLOYMENT_STATUS]], function () {
        Route::get('settings/employment-status', 'Admin\SettingsController@displayEmploymentStatus')->name('admin.settings.employment-status');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_EMPLOYMENT_STATUS]], function () {
        Route::get('settings/employment-status/add','Admin\SettingsController@addEmploymentStatus')->name('admin.settings.employment-status.add');
        Route::post('settings/employment-status/add','Admin\SettingsController@postAddEmploymentStatus')->name('admin.settings.employment-status.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_EMPLOYMENT_STATUS]], function () {
        Route::get('settings/employment-status/{id}/edit','Admin\SettingsController@editEmploymentStatus')->name('admin.settings.employment-status.edit')->where('id', '[0-9]+');
        Route::post('settings/employment-status/{id}/edit','Admin\SettingsController@postEditEmploymentStatus')->name('admin.settings.employment-status.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_EMPLOYMENT_STATUS]], function () {
        Route::get('settings/employment-status/{id}/delete','Admin\SettingsController@deleteEmploymentStatus')->name('admin.settings.employment-status.delete')->where('id', '[0-9]+');
    });
    
    // Company Asset
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_COMPANY_ASSET]], function () {
    Route::get('settings/company-asset', 'Admin\SettingsController@displayCompanyAsset')->name('admin.settings.company-asset');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_COMPANY_ASSET]], function () {
        Route::get('settings/company-asset/add','Admin\SettingsController@addCompanyAsset')->name('admin.settings.company-asset.add');
        Route::post('settings/company-asset/add','Admin\SettingsController@postAddCompanyAsset')->name('admin.settings.company-asset.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_COMPANY_ASSET]], function () {
        Route::get('settings/company-asset/{id}/edit','Admin\SettingsController@editCompanyAsset')->name('admin.settings.company-asset.edit')->where('id', '[0-9]+');
        Route::post('settings/company-asset/{id}/edit','Admin\SettingsController@postEditCompanyAsset')->name('admin.settings.company-asset.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_COMPANY_ASSET]], function () {
        Route::get('settings/company-asset/{id}/delete','Admin\SettingsController@deleteCompanyAsset')->name('admin.settings.company-asset.delete')->where('id', '[0-9]+');
    });
    
    // Department
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_DEPARTMENT]], function () {
        Route::get('settings/departments', 'Admin\SettingsController@displayDepartments')->name('admin.settings.departments');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_DEPARTMENT]], function () {
        Route::get('settings/departments/add','Admin\SettingsController@addDepartment')->name('admin.settings.departments.add');
        Route::post('settings/departments/add','Admin\SettingsController@postAddDepartment')->name('admin.settings.departments.add.post');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_DEPARTMENT]], function () {
        Route::get('settings/departments/{id}/edit','Admin\SettingsController@editDepartment')->name('admin.settings.departments.edit')->where('id', '[0-9]+');
        Route::post('settings/departments/{id}/edit','Admin\SettingsController@postEditDepartment')->name('admin.settings.departments.edit.post')->where('id', '[0-9]+');
    });
    Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_DEPARTMENT]], function () {
        Route::get('settings/departments/{id}/delete','Admin\SettingsController@deleteDepartment')->name('admin.settings.departments.delete')->where('id', '[0-9]+');
    });
    
    Route::get('settings/jobs', 'Admin\SettingsController@displayJobs')->name('admin-settings-jobs');
    Route::get('settings/working-days', 'Admin\SettingsController@displayWorkingDays')->name('admin.settings.working-days');

    // > View - List Company Details
    Route::get('settings/deduction', 'Admin\SettingsController@displayCompanyDeduction')->name('admin.settings.deductions');
    Route::get('settings/addition', 'Admin\SettingsController@displayCompanyAddition')->name('admin.settings.additions');
    

    // > View - List Leave Details
    
    Route::get('e-leave/configuration/leave-holidays', 'Admin\ELeaveController@displayPublicHolidays')->name('admin.e-leave.configuration.leave-holidays');
    Route::get('e-leave/configuration/leave-balances', 'Admin\ELeaveController@displayLeaveBalances')->name('admin.e-leave.configuration.leave-balances');
    Route::get('e-leave/configuration/leave-types', 'Admin\ELeaveController@displayLeaveTypes')->name('admin.e-leave.configuration.leave-types');


    Route::get('e-leave/approve-leave/{id}/add','Admin\ELeaveController@addLeaveApproval')->name('admin.e-leave.add-leave-request')->where('id', '[0-9]+');
    Route::get('e-leave/disapprove-leave/{id}/add','Admin\ELeaveController@rejectLeaveApproval')->name('admin.e-leave.add-leave-request-disapprove')->where('id', '[0-9]+');

    Route::post('e-leave/approve-leaves/{id}/add','Admin\ELeaveController@postAddApproval')->name('admin.e-leave.add-leave-request.post')->where('id', '[0-9]+');
    Route::post('e-leave/approve-leaves/{id}/reject','Admin\ELeaveController@postDisapproved')->name('admin.e-leave.add-leave-request-disapprove.post')->where('id', '[0-9]+');
    // Actions
    
    // > Settings Add
    Route::get('settings/working-days/add','Admin\SettingsController@addWorkingDay')->name('admin.settings.working-days.add');
    Route::post('settings/working-days/add','Admin\SettingsController@postAddWorkingDay')->name('admin.settings.working-days.add.post');

    // Route::get('settings/deductions/add','Admin\SettingsController@addCompanyDeduction')->name('admin.settings.deductions.add');
    Route::post('settings/deductions/add','Admin\SettingsController@postAddCompanyDeduction')->name('admin.settings.deductions.add.post');

    // Route::get('settings/additions/{id}/edit','Admin\SettingsController@editAdditions')->name('admin.settings.additions.edit')->where('id', '[0-9]+');
    Route::post('settings/additions/{id}/edit','Admin\SettingsController@postEditAdditions')->name('admin.settings.additions.edit.post')->where('id', '[0-9]+');

    // Route::get('settings/deductions/{id}/edit','Admin\SettingsController@editCompanyDeduction')->name('admin.settings.deductions.edit')->where('id', '[0-9]+');
    Route::post('settings/deductions/{id}/edit','Admin\SettingsController@postEditCompanyDeduction')->name('admin.settings.deductions.edit.post')->where('id', '[0-9]+');
    Route::post('settings/company-deduction/edit','Admin\SettingsController@postEditCompanyDeduction')->name('admin.settings.company-deduction.edit.post');

    Route::post('settings/company-addition/edit','Admin\SettingsController@postEditCompanyAddition')->name('admin.settings.company-addition.edit.post');

    Route::post('settings/additions/{id}/add','Admin\SettingsController@postAddCompanyAddition')->name('admin.settings.additions.add.post')->where('id', '[0-9]+');
    Route::post('settings/deductions/{id}/add','Admin\SettingsController@postAddCompanyDeduction')->name('admin.settings.deductions.add.post')->where('id', '[0-9]+');
    Route::post('settings/grades/add','Admin\SettingsController@postAddGrade')->name('admin.settings.grades.add.post');
    Route::post('settings/holidays/add','Admin\SettingsController@postAddHoliday')->name('admin.settings.holidays.add.post');

    // > Edit
    Route::get('settings/working-days/{id}/edit','Admin\SettingsController@editWorkingDay')->name('admin.settings.working-days.edit')->where('id', '[0-9]+');
    Route::post('settings/working-days/{id}/edit','Admin\SettingsController@postEditWorkingDay')->name('admin.settings.working-days.edit.post')->where('id', '[0-9]+');
    Route::post('settings/leave-balances/edit','Admin\SettingsController@editLeaveBalance')->name('admin.settings.leave-balances.edit.post');
    Route::post('settings/company-additions/edit','Admin\SettingsController@editCompanyAddition')->name('admin.settings.company-additions.edit.post');
    Route::post('settings/company-deductions/edit','Admin\SettingsController@editCompanyDeduction')->name('admin.settings.company-deductions.edit.post');


    // > Delete
    Route::get('settings/working-days/{id}/delete','Admin\SettingsController@deleteWorkingDay')->name('admin.settings.working-days.delete')->where('id', '[0-9]+');

    // SECTION: E-Leave
   Route::get('e-leave/configuration', 'Admin\ELeaveController@displayConfiguration')->name('admin.e-leave.configuration');
   Route::get('e-leave/configuration/leave-types/add', 'Admin\ELeaveController@addLeaveType')->name('admin.e-leave.configuration.leave-types.add');
   Route::post('e-leave/configuration/leave-types/add', 'Admin\ELeaveController@postAddLeaveType')->name('admin.e-leave.configuration.leave-types.add.post');
   Route::get('e-leave/configuration/leave-types/{id}/edit', 'Admin\ELeaveController@editLeaveType')->name('admin.e-leave.configuration.leave-types.edit');
   Route::post('e-leave/configuration/leave-types/{id}/edit', 'Admin\ELeaveController@postEditLeaveType')->name('admin.e-leave.configuration.leave-types.edit.post');

   Route::post('e-leave/configuration/leave-types/{id}/activate', 'Admin\ELeaveController@postActivateLeaveType')->name('admin.e-leave.configuration.leave-types.activate.post');
   Route::post('e-leave/configuration/leave-types/{id}/deactivate', 'Admin\ELeaveController@postDeactivateLeaveType')->name('admin.e-leave.configuration.leave-types.deactivate.post')->where('id', '[0-9]+');
   Route::get('e-leave/configuration/leave-types/{id}/delete', 'Admin\ELeaveController@deleteLeaveType')->name('admin.e-leave.configuration.leave-types.delete')->where('id', '[0-9]+');
   Route::get('e-leave/configuration/generate-leave-allocation', 'Admin\ELeaveController@generateLeaveAllocation')->name('admin.e-leave.configuration.generate-leave-allocation');

   Route::get('e-leave/configuration/holiday/{id}/edit','Admin\ELeaveController@editHoliday')->name('admin.e-leave.configuration.leave-holidays.edit')->where('id', '[0-9]+');
   Route::post('e-leave/configuration/holiday/{id}/edit','Admin\ELeaveController@postEditHoliday')->name('admin.e-leave.configuration.leave-holidays.edit.post')->where('id', '[0-9]+');

   
    //leave public holidays setup
    Route::get('e-leave/configuration/leave-holidays/add','Admin\ELeaveController@addPublicHoliday')->name('admin.e-leave.configuration.leave-holidays.add');
    Route::post('e-leave/configuration/leave-holidays/add','Admin\ELeaveController@postAddPublicHoliday')->name('admin.e-leave.configuration.leave-holidays.add.post');
    Route::get('e-leave/configuration/leave-holidays/generate', 'Admin\ELeaveController@generatePublicHolidays')->name('admin.e-leave.configuration.leave-holidays.generate');

    Route::get('e-leave/configuration/leave-requests', 'Admin\ELeaveController@displayLeaveRequests')->name('admin.e-leave.configuration.leave-requests');
    Route::get('e-leave/{id}/attachment', 'Admin\ELeaveController@getLeaveRequestAttachment')->name('admin.e-leave.attachment')->where('id', '[0-9]+');;

    Route::get('e-leave/leave-application', 'Admin\ELeaveController@displayLeaveApplication')->name('admin.e-leave.leave-application');
    Route::get('e-leave/leave-report', 'Admin\ELeaveController@displayLeaveReports')->name('admin.e-leave.leave-report');
    Route::get('e-leave/leave-report/total-balanced-report/{emp_id}','Admin\ELeaveController@getTotalBalancedReport')->name('admin.e-leave.total-balanced-report')->where('emp_id', '[A-Za-z0-9\-\/]+');
    Route::get('e-leave/leave-report/total-transaction-report/{emp_id}','Admin\ELeaveController@getTotalTransactionReport')->name('admin.e-leave.total-transaction-report')->where('emp_id', '[A-Za-z0-9\-\/]+');
    Route::get('e-leave/leave-report/unpaid-leave-report/{emp_id}','Admin\ELeaveController@getUnpaidLeaveReport')->name('admin.e-leave.unpaid-leave-report')->where('emp_id', '[A-Za-z0-9\-\/]+');
    Route::get('e-leave/employees', 'Admin\ELeaveController@ajaxGetEmployees')->name('admin.e-leave.ajax.employees');
    Route::get('e-leave/employees/{emp_id}/working-days', 'Admin\ELeaveController@ajaxGetEmployeeWorkingDays')->name('admin.e-leave.ajax.working-days')->where('emp_id', '[0-9]+');
    Route::get('e-leave/employees/{emp_id}/employee-job', 'Admin\ELeaveController@ajaxCheckEmployeeJob')->name('admin.e-leave.ajax.employee-job')->where('emp_id', '[0-9]+');
    Route::get('e-leave/employee/{emp_id}/leave-requests', 'Admin\ELeaveController@ajaxGetEmployeeLeaves')->name('admin.e-leave.ajax.employees.leave-requests')->where('status', '[A-Za-z0-9\-\/]+')->where('emp_id', '[0-9]+');
    Route::get('e-leave/employee/{emp_id}/holidays', 'Admin\ELeaveController@ajaxGetEmployeeHolidays')->name('admin.e-leave.ajax.employee.holidays')->where('emp_id', '[0-9]+');
    Route::get('e-leave/employee/{emp_id}/leave-types', 'Admin\ELeaveController@ajaxGetLeaveTypes')->name('admin.e-leave.ajax.employee.leave-types')->where('emp_id', '[0-9]+');
    Route::post('e-leave/employee/{emp_id}/leave-request/check', 'Admin\ELeaveController@ajaxPostCheckLeaveRequest')->name('admin.e-leave.ajax.employee.leave-request.check')->where('emp_id', '[0-9]+');
    Route::post('e-leave/employee/{emp_id}/leave-request/post', 'Admin\ELeaveController@ajaxPostCreateLeaveRequest')->name('admin.e-leave.ajax.employee.leave-request.post')->where('emp_id', '[0-9]+');
    Route::get('e-leave/leave-request/{id}', 'Admin\ELeaveController@ajaxGetLeaveRequestSingle')->name('admin.e-leave.ajax.leave-request.edit')->where('id', '[0-9]+');
    Route::post('e-leave/leave-request/{id}/post','Admin\ELeaveController@ajaxPostEditLeaveRequest')->name('admin.e-leave.ajax.leave-request.edit.post')->where('id', '[0-9]+');
    Route::get('e-leave/leave-request/{id}/delete','Admin\ELeaveController@ajaxCancelLeaveRequest')->name('admin.e-leave.ajax.leave-request.delete')->where('id', '[0-9]+');

    Route::get('attendance/report/{date?}','Admin\AttendanceController@getAttendanceReport')->name('admin.attendance.report')->where('date', '[A-Za-z0-9\-\/]+');
    Route::get('attendance/current-day','Admin\AttendanceController@getCurrentDayAttendance')->name('admin.attendance.current-day');

    // SECTION: Audit Trail
    Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_AUDIT_TRAIL]], function () {
        Route::get('audit-trail', 'Admin\AuditTrailController@display')->name('admin.audit-trail');
        Route::get('audit-trail/dt', 'Admin\AuditTrailController@getDataTableAuditTrails')->name('admin.audit-trail.dt');
    });
    
    // Route::get('e-leave/configuration/leaveholidays/{id}/edit','Admin\ELeaveController@editPublicHoliday')->name('admin.e-leave.configuration.leave-holidays.edit')->where('id', '[0-9]+');
    // Route::post('e-leave/configuration/leaveholidays/{id}/edit','Admin\ELeaveController@postEditPublicHoliday')->name('admin.e-leave.configuration.leave-holidays.edit.post')->where('id', '[0-9]+');

    Route::get('edit-employee/{id}', 'AdminController@displayAddEmployeeProfile')->name('admin/edit-employee/{id}');
    Route::get('edit-employee', 'AdminController@displayAddEmployeeProfile')->name('admin/edit-employee');
    
    // Roles & Permissions
    Route::group(['middleware' => ['permission:View Roles and Permissions']], function () {
        Route::get('role-permission', 'Admin\RolePermissionController@index')->name('admin.role-permission');
        Route::get('role-permission/{id}', 'Admin\RolePermissionController@show')->name('admin.role-permission.show')->where('id', '[0-9]+');
    });
    
    Route::group(['middleware' => ['permission:Add Role']], function () {
        Route::get('role-permission/add','Admin\RolePermissionController@create')->name('admin.role-permission.add');
        Route::post('role-permission/add','Admin\RolePermissionController@store')->name('admin.role-permission.add.post');
    });
    
    Route::group(['middleware' => ['permission:Update Role']], function () {
        Route::get('role-permission/{id}/edit', 'Admin\RolePermissionController@edit')->name('admin.role-permission.edit')->where('id', '[0-9]+');
        Route::post('role-permission/{id}/update','Admin\RolePermissionController@update')->name('admin.role-permission.update')->where('id', '[0-9]+');
    });
    
    Route::group(['middleware' => ['permission:Delete Role']], function () {
        Route::get('role-permission/{id}/delete','Admin\RolePermissionController@delete')->name('admin.role-permission.delete')->where('id', '[0-9]+');
    });
    
    Route::group(['middleware' => ['permission:Duplicate Role']], function () {
        Route::get('role-permission/{id}/duplicate', 'Admin\RolePermissionController@duplicate')->name('admin.role-permission.duplicate');
    });
});

// MODE: Super Admin
Route::group(['prefix' => 'super-admin', 'middleware' => ['auth', 'role:Super Admin']], function() {
    Route::get('', 'SuperAdmin\DashboardController@index')->name('super-admin.dashboard');
});
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
Route::get('/payroll/create', 'Payroll\PayrollController@create')->name('payroll.create');

Route::get('payroll-report', 'Payroll\PayrollReportController@showReport')->name('payroll.report.show');
Route::post('/payroll/generate-report', 'Payroll\PayrollController@generateReport')->name('payroll.generate-report');
Route::post('/report/generate', 'Payroll\PayrollReportController@exportReport')->name('report.generate');
Route::get('/payslip/show', 'Payroll\PayrollController@showPayslip')->name('payslip.show');
Route::get('/payslip/download/{id}', 'Payroll\PayrollController@downloadPayslip')->name('payslip.download');

Route::get('government_report', 'Payroll\GovernmentReportController@viewGovernmentReport')->name('payroll/government_report');
Route::post('generate_report', 'Payroll\GovernmentReportController@generateReport')->name('generate_report');
Route::get('government_report/employees', 'Payroll\GovernmentReportController@listEmployees')->name('payroll/government_report/employees');

Route::resource('payroll-setup', 'Payroll\PayrollSetupController');
Route::get('payroll-setup/{id}/delete','Payroll\PayrollSetupController@destroy')->name('payroll-setup.destroy')->where('id', '[0-9]+');
Route::group(['middleware' => ['permission:'.PermissionConstant::VIEW_SALARY_STRUCTURE]], function () {
    Route::get('salarystructure', 'Payroll\PayrollController@salarystructure')->name('salarystructure');
    });
Route::group(['middleware' => ['permission:'.PermissionConstant::ADD_SALARY_STRUCTURE]], function () {
    Route::post('salarystructure','Payroll\PayrollController@addSalaryStructure')->name('payroll.salarystructure.post');
    });
Route::group(['middleware' => ['permission:'.PermissionConstant::UPDATE_SALARY_STRUCTURE]], function () {
    Route::get('salarystructure/{id}/edit','Payroll\PayrollController@editSalaryStructure')->name('payroll.salarystructure.edit')->where('id', '[0-9]+');
    Route::post('salarystructure/{id}/edit','Payroll\PayrollController@updateSalaryStructure')->name('payroll.salarystructure.update.post')->where('id', '[0-9]+');
    });
Route::group(['middleware' => ['permission:'.PermissionConstant::DELETE_SALARY_STRUCTURE]], function () {
    Route::get('salarystructure/{id}/delete','Payroll\PayrollController@deleteSalaryStructure')->name('payroll.salarystructure.delete')->where('id', '[0-9]+');
    });


Route::get('settings/pcb/import', 'Admin\SettingsController@importPcb')->name('admin.settings.pcb.import');

Route::get('/login-activity', 'LoginActivityController@index')->middleware('auth')->name('login-activity');
