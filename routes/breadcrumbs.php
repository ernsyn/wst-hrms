<?php


// Login
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('login', function ($trail) {
    $trail->push('Login', route('login'));
});

// SECTION: Employee
// Home
Breadcrumbs::for('employee.dashboard', function ($trail) {
    $trail->push('Dashboard', route('employee.dashboard'));
});

Breadcrumbs::for('employee.e-leave.request', function ($trail) {
    // $trail->parent('profile');
    $trail->push('Leave Approvals', route('employee.e-leave.request'));
});
Breadcrumbs::for('employee.e-leave.history', function ($trail) {
    // $trail->parent('profile');
    $trail->push('Leave Requests', route('employee.e-leave.history'));
});

Breadcrumbs::for('employee.profile', function ($trail) {
    // $trail->parent('profile');
    $trail->push('My Profile', route('employee.profile'));
});

Breadcrumbs::for('super-admin.dashboard', function ($trail) {
    $trail->push('Super Admin Dashboard', route('super-admin.dashboard'));
});

Breadcrumbs::for('employee.e-leave.leave-application', function ($trail) {
    $trail->push('Leave Application', route('employee.e-leave.leave-application', ''));
});

Breadcrumbs::for('employee.e-leave.add-leave-request', function ($trail, $id) {
    $trail->parent('admin.e-leave.configuration.leave-requests');
    $trail->push('Approve Leave', route('employee.e-leave.add-leave-request', $id));
});

Breadcrumbs::for('employee.e-leave.add-leave-request-disapprove', function ($trail, $id) {
    $trail->parent('admin.e-leave.configuration.leave-requests');
    $trail->push('Dissapprove Leave', route('employee.e-leave.add-leave-request-disapprove', $id));
});


// SECTION: Admin

//dashboard
Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Admin Dashboard', route('admin.dashboard'));
});

//employee list
Breadcrumbs::for('admin.employees', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Employees', route('admin.employees'));
});

//add employee
Breadcrumbs::for('admin.employees.add', function ($trail) {
    $trail->parent('admin.employees');
    $trail->push('Add Employee', route('admin.employees.add'));
});

// Home > Admin > Employee List > Profile
Breadcrumbs::for('admin.employees.id', function ($trail) {
    $trail->parent('admin.employees');
    $trail->push('Employee Profile', route('admin.employees.id', ''));
});

// SECTION: (Admin) E-Leave

//E-Leave Configuration 
Breadcrumbs::for('admin.e-leave.configuration', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('E-Leave Configuration', route('admin.e-leave.configuration'));
});

//Add Leave Type
Breadcrumbs::for('admin.e-leave.configuration.leave-types.add', function ($trail) {
    $trail->parent('admin.e-leave.configuration');
    $trail->push('Add Leave Type', route('admin.e-leave.configuration.leave-types.add'));
});

//Edit Leave Type
Breadcrumbs::for('admin.e-leave.configuration.leave-types.edit', function ($trail, $id) {
    $trail->parent('admin.e-leave.configuration');
    $trail->push('Edit Leave Type', route('admin.e-leave.configuration.leave-types.edit', $id));
});

// Home > Leave > Leave Holiday
Breadcrumbs::for('admin.e-leave.configuration.leave-holidays', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: Holidays', route('admin.e-leave.configuration.leave-holidays'));
});

// Home > E-Leave > Leave Holiday
Breadcrumbs::for('admin.e-leave.configuration.generate-leave-allocation', function ($trail) {
    $trail->parent('admin.e-leave.configuration');
    $trail->push('Generate Leave Allocation', route('admin.e-leave.configuration.generate-leave-allocation'));
});
// Home > E-Leave > Leave Holiday- Add
Breadcrumbs::for('admin.e-leave.configuration.leave-holidays.add', function ($trail) {
    $trail->parent('admin.e-leave.configuration.leave-holidays');
    $trail->push('Add Holiday', route('admin.e-leave.configuration.leave-holidays.add'));
});

// Home > E-Leave >  Leave Holiday- Edit
Breadcrumbs::for('admin.e-leave.configuration.leave-holidays.edit', function ($trail, $id) {
    $trail->parent('admin.e-leave.configuration.leave-holidays');
    $trail->push('Edit Holiday', route('admin.e-leave.configuration.leave-holidays.edit', $id));
});

// Home > E-Leave >  Leave Request- List
Breadcrumbs::for('admin.e-leave.configuration.leave-requests', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Request', route('admin.e-leave.configuration.leave-requests'));
});

// Home > E-Leave >  Leave Request- Approve
Breadcrumbs::for('admin.e-leave.add-leave-request', function ($trail, $id) {
    $trail->parent('admin.e-leave.configuration.leave-requests');
    $trail->push('Approve Leave', route('admin.e-leave.add-leave-request', $id));
});

// Home > E-Leave > Leave Request- Disapprove
Breadcrumbs::for('admin.e-leave.add-leave-request-disapprove', function ($trail,$id) {
    $trail->parent('admin.e-leave.configuration.leave-requests');
    $trail->push('Leave Disapprove', route('admin.e-leave.add-leave-request-disapprove',$id));
});

// Home > E-Leave > Leave Application
Breadcrumbs::for('admin.e-leave.leave-application', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Application', route('admin.e-leave.leave-application'));
});

//Home > E-Leave > Leave Reports
Breadcrumbs::for('admin.e-leave.leave-report', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Reports', route('admin.e-leave.leave-report'));
});

//Home > E-Leave > Leave Balanced Report
Breadcrumbs::for('admin.e-leave.total-balanced-report', function ($trail, $id) {
    $trail->parent('admin.e-leave.leave-report');
    $trail->push('Total Balanced Report', route('admin.e-leave.total-balanced-report', $id));
});

//Home > E-Leave > Leave Transaction Report
Breadcrumbs::for('admin.e-leave.total-transaction-report', function ($trail, $id) {
    $trail->parent('admin.e-leave.leave-report');
    $trail->push('Total Transaction Report', route('admin.e-leave.total-transaction-report', $id));
});

//Home > E-Leave > Leave Unpaid Leave Report
Breadcrumbs::for('admin.e-leave.unpaid-leave-report', function ($trail, $id) {
    $trail->parent('admin.e-leave.leave-report');
    $trail->push('Unpaid Leave Report', route('admin.e-leave.unpaid-leave-report', $id));
});

//Home > Attendence > Current Day Attendance
Breadcrumbs::for('admin.attendance.current-day', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Current Day Attendance', route('admin.attendance.current-day'));
});

//Home > Attendence > Attendance Report
Breadcrumbs::for('admin.attendance.report', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Attendance Report', route('admin.attendance.report'));
});

// Home > Settings > Company
Breadcrumbs::for('admin.settings.companies', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: Companies', route('admin.settings.companies'));
});

// Home > Settings > Company - Add
Breadcrumbs::for('admin.settings.companies.add', function ($trail) {
    $trail->parent('admin.settings.companies');
    $trail->push('Add Company', route('admin.settings.companies.add'));
});

// Home > Settings > Company - Edit
Breadcrumbs::for('admin.settings.companies.edit', function ($trail, $id) {
    $trail->parent('admin.settings.companies');
    $trail->push('Edit Company', route('admin.settings.companies.edit', $id));
});

// Home > Admin > Settings > Company Details
Breadcrumbs::for('admin.settings.company.company-details', function ($trail, $id) {
    $trail->parent('admin.dashboard');
    $trail->push('Company Details', route('admin.settings.company.company-details', $id));
});


// // Home > Settings > Cost-Centre
Breadcrumbs::for('admin.settings.cost-centres', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: Cost Centres', route('admin.settings.cost-centres'));
});

// Home > Settings > Cost-Centre - Add
Breadcrumbs::for('admin.settings.cost-centres.add', function ($trail) {
    $trail->parent('admin.settings.cost-centres');
    $trail->push('Add Cost Centres', route('admin.settings.cost-centres.add'));
});

// Home > Settings > Cost-Centre - Edit
Breadcrumbs::for('admin.settings.cost-centres.edit', function ($trail, $id) {
    $trail->parent('admin.settings.cost-centres');
    $trail->push('Edit Cost Centres', route('admin.settings.cost-centres.edit', $id));
});

// // Home > Settings > Department
Breadcrumbs::for('admin.settings.departments', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: Departments', route('admin.settings.departments'));
});

// Home > Settings > Department - Add
Breadcrumbs::for('admin.settings.departments.add', function ($trail) {
    $trail->parent('admin.settings.departments');
    $trail->push('Add Department', route('admin.settings.departments.add'));
});

// Home > Settings > Department - Edit
Breadcrumbs::for('admin.settings.departments.edit', function ($trail, $id) {
    $trail->parent('admin.settings.departments');
    $trail->push('Edit Department', route('admin.settings.departments.edit', $id));
});

// Home > Settings > Branch
Breadcrumbs::for('admin.settings.branches', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings : Branches', route('admin.settings.branches'));
});

// Home > Settings > Branch - Add
Breadcrumbs::for('admin.settings.branches.add', function ($trail) {
    $trail->parent('admin.settings.branches');
    $trail->push('Add Branch', route('admin.settings.branches.add'));
});

// Home > Settings > Branches - Edit
Breadcrumbs::for('admin.settings.branches.edit', function ($trail, $id) {
    $trail->parent('admin.settings.branches');
    $trail->push('Edit Branch', route('admin.settings.branches.edit', $id));
});

// Home > Settings > Team
Breadcrumbs::for('admin.settings.teams', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: Teams', route('admin.settings.teams'));
});

// Home > Settings > Team - Add
Breadcrumbs::for('admin.settings.teams.add', function ($trail) {
    $trail->parent('admin.settings.teams');
    $trail->push('Add Team', route('admin.settings.teams.add'));
});

// Home > Settings > Team - Edit
Breadcrumbs::for('admin.settings.teams.edit', function ($trail, $id) {
    $trail->parent('admin.settings.teams');
    $trail->push('Edit Team', route('admin.settings.teams.edit', $id));
});

// Home > Settings > Position
Breadcrumbs::for('admin.settings.positions', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: Employee Positions', route('admin.settings.positions'));
});

// Home > Settings > Position - Add
Breadcrumbs::for('admin.settings.positions.add', function ($trail) {
    $trail->parent('admin.settings.positions');
    $trail->push('Add Position', route('admin.settings.positions.add'));
});

// Home > Settings > Position - Edit
Breadcrumbs::for('admin.settings.positions.edit', function ($trail, $id) {
    $trail->parent('admin.settings.positions');
    $trail->push('Edit Position', route('admin.settings.positions.edit', $id));
});

// Home > Settings > Grade
Breadcrumbs::for('admin.settings.grades', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: Grades ', route('admin.settings.grades'));
});

// Home > Settings > Grade - Add
Breadcrumbs::for('admin.settings.grades.add', function ($trail) {
    $trail->parent('admin.settings.grades');
    $trail->push('Add Grade', route('admin.settings.grades.add'));
});

// Home > Settings > Grade - Edit
Breadcrumbs::for('admin.settings.grades.edit', function ($trail, $id) {
    $trail->parent('admin.settings.grades');
    $trail->push('Edit Grade', route('admin.settings.grades.edit', $id));
});

// Home > Settings > Working Day
Breadcrumbs::for('admin.settings.working-days', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: Working Days (Templates)', route('admin.settings.working-days'));
});

// Home > Settings > Working Day - Add
Breadcrumbs::for('admin.settings.working-days.add', function ($trail) {
    $trail->parent('admin.settings.working-days');
    $trail->push('Add Working Days', route('admin.settings.working-days.add'));
});

// Home > Settings > Working Day - Edit
Breadcrumbs::for('admin.settings.working-days.edit', function ($trail, $id) {
    $trail->parent('admin.settings.working-days');
    $trail->push('Edit Working Days', route('admin.settings.working-days.edit', $id));
});

// Home > Settings > Epf
Breadcrumbs::for('admin.settings.epf', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: EPF', route('admin.settings.epf'));
});

// Home > Settings > Epf - Add
Breadcrumbs::for('admin.settings.epf.add', function ($trail) {
    $trail->parent('admin.settings.epf');
    $trail->push('Add EPF', route('admin.settings.epf.add'));
});

// Home > Settings > Epf - Edit
Breadcrumbs::for('admin.settings.epf.edit', function ($trail, $id) {
    $trail->parent('admin.settings.epf');
    $trail->push('Edit EPF', route('admin.settings.epf.edit', $id));
});

// Home > Settings > Eis
Breadcrumbs::for('admin.settings.eis', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: EIS', route('admin.settings.eis'));
});

// Home > Settings > Epf - Add
Breadcrumbs::for('admin.settings.eis.add', function ($trail) {
    $trail->parent('admin.settings.eis');
    $trail->push('Add EIS', route('admin.settings.eis.add'));
});

// Home > Settings > Epf - Edit
Breadcrumbs::for('admin.settings.eis.edit', function ($trail, $id) {
    $trail->parent('admin.settings.eis');
    $trail->push('Edit EIS', route('admin.settings.eis.edit', $id));
});



// Home > Settings > Socso
Breadcrumbs::for('admin.settings.socso', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: Socso', route('admin.settings.socso'));
});

// Home > Settings > Socso - Add
Breadcrumbs::for('admin.settings.socso.add', function ($trail) {
    $trail->parent('admin.settings.socso');
    $trail->push('Add Socso', route('admin.settings.socso.add'));
});

// Home > Settings > Socso - Edit
Breadcrumbs::for('admin.settings.socso.edit', function ($trail, $id) {
    $trail->parent('admin.settings.socso');
    $trail->push('Edit Socso', route('admin.settings.socso.edit', $id));
});

// Home > Settings > Pcb
Breadcrumbs::for('admin.settings.pcb', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: PCB', route('admin.settings.pcb'));
});

// Home > Settings > Pcb - Add
Breadcrumbs::for('admin.settings.pcb.add', function ($trail) {
    $trail->parent('admin.settings.pcb');
    $trail->push('Add PCB', route('admin.settings.pcb.add'));
});

// Home > Settings > Pcb - Edit
Breadcrumbs::for('admin.settings.pcb.edit', function ($trail, $id) {
    $trail->parent('admin.settings.pcb');
    $trail->push('Edit PCB', route('admin.settings.pcb.edit', $id));
});


// Home > Admin > Employee List > Profile
Breadcrumbs::for('edit-company-bank', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Company Details', route('edit-company-bank'));
});

// Home > Admin > Employee List > Profile
Breadcrumbs::for('add-company-bank', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Company Details', route('add-company-bank'));
});

Breadcrumbs::for('admin.changepassword', function ($trail) {
    $trail->parent('admin.employees');
    $trail->push('Change Password', route('admin.changepassword'));
});

// Home > Settings > Leave Holiday- Add
Breadcrumbs::for('admin.e-leave.configuration.leavetypes.add', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Add Leave', route('admin.e-leave.configuration.leavetypes.add'));
});

Breadcrumbs::for('admin.e-leave.configuration.leavetypes.edit', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Edit Leave', route('admin.e-leave.configuration.leavetypes.edit'));
});



// Home > Settings > Leave Holiday
Breadcrumbs::for('admin.e-leave.configuration.leave-balances', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: Holidays', route('admin.e-leave.configuration.leave-balances'));
});

// Home > Settings > Leave Holiday- Add
Breadcrumbs::for('admin.e-leave.configuration.leave-balances.add', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Add Leave', route('admin.e-leave.configuration.leave-balances.add'));
});

// Home > Settings > Department - Edit
Breadcrumbs::for('admin.settings.departments.edit.post', function ($trail, $id) {
    $trail->parent('admin.settings.departments');
    $trail->push('Edit Team', route('admin.settings.departments.edit.post', $id));
});


Breadcrumbs::for('admin.settings.cost-centres.add', function ($trail) {
    $trail->parent('admin.settings.cost-centres');
    $trail->push('Add Cost Centre', route('admin.settings.cost-centres.add'));
});

// Home > Settings > Cost-Centre - Edit
Breadcrumbs::for('admin.settings.cost-centres.edit', function ($trail, $id) {
    $trail->parent('admin.settings.cost-centres');
    $trail->push('Edit Cost Centres', route('admin.settings.cost-centres.edit', $id));
});





// Home > Admin > Leave Request
Breadcrumbs::for('admin.e-leave', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Request', route('admin.e-leave'));
});


// Home > Admin > Leave Request
Breadcrumbs::for('admin.e-leave.configuration.leave-setup', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Request', route('admin.e-leave.configuration.leave-setup'));
});
// Home > Admin > Leave Holiday
Breadcrumbs::for('admin.e-leave.configuration.holidays', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Holiday', route('admin.e-leave.configuration.holidays'));
});

// Home > Admin > Leave Holiday
Breadcrumbs::for('add_holiday', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Holiday', route('add_holiday'));
});

// // Home > Admin > Leave Application
// Breadcrumbs::for('employee.e-leave.apply', function ($trail) {
//     $trail->parent('admin.dashboard');
//     $trail->push('Leave Application', route('add_leave_application'));
// });

// Home > Admin > Leave Approve
Breadcrumbs::for('approve-leave', function ($trail) {
    $trail->parent('admin.e-leave.configuration.leave-requests');
    $trail->push('Leave Request', route('approve-leave'));
});

// Home > Admin > Leave Disapprove
Breadcrumbs::for('disapprove-leave', function ($trail) {
    $trail->parent('admin.e-leave.configuration.leave-requests');
    $trail->push('Leave Request', route('disapprove-leave'));
});



// Home > Admin > Leave Balance
Breadcrumbs::for('admin.settings.securities', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Balance', route('admin.settings.securities'));
});





// Error 404
Breadcrumbs::for('errors.404', function ($trail) {
    $trail->push('Page Not Found');
});

/**
 * Payroll Breadcrumbs
 *
 * All payroll related stuff will be under here
 */

Breadcrumbs::for('payroll', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Payroll', route('payroll'));
});

Breadcrumbs::for('payroll.create', function ($trail) {
    $trail->parent('payroll');
    $trail->push('Payroll', route('payroll.create'));
});

Breadcrumbs::for('payroll.show', function ($trail) {
    $trail->parent('payroll');
    $trail->push('Payroll ', route('payroll'));
});

Breadcrumbs::for('payroll/show/{id}', function ($trail) {
    $trail->parent('payroll');
    $trail->push('Payroll Month', route('payroll/show/{id}', ''));
});

Breadcrumbs::for('payroll/government_report', function ($trail) {
    $trail->parent('payroll');
    $trail->push('Government Reports', route('payroll/government_report'));
});

Breadcrumbs::for('payroll.trx.show', function ($trail) {
    $trail->parent('payroll');
    $trail->push('Payroll ', route('payroll'));
});

Breadcrumbs::for('payroll.report.show', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Reports', route('payroll.report.show'));
});

Breadcrumbs::for('payslip.show', function ($trail) {
//     $trail->parent('admin.dashboard');
    $trail->push('Payslip', route('payslip.show'));
});

Breadcrumbs::for('payroll-setup.index', function ($trail) {
    $trail->parent('payroll');
    $trail->push('Payroll Setup', route('payroll-setup.index'));
});

Breadcrumbs::for('payroll-setup.create', function ($trail) {
    $trail->parent('payroll');
    $trail->push('Add Payroll Setup', route('payroll-setup.create'));
});

Breadcrumbs::for('payroll-setup.show', function ($trail,$id) {
    $trail->parent('payroll');
    $trail->push('Payroll Setup Detail', route('payroll-setup.show',$id));
});
    
Breadcrumbs::for('payroll-setup.edit', function ($trail,$id) {
    $trail->parent('payroll');
    $trail->push('Edit Payroll Setup', route('payroll-setup.edit',$id));
});

Breadcrumbs::for('login-activity', function ($trail) {
    $trail->push('User Login Activity', route('login-activity'));
});