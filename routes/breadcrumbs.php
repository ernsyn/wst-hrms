<?php


// Login
Breadcrumbs::for('login', function ($trail) {
    $trail->push('Login', route('login'));
});

// SECTION: Employee
// Home
Breadcrumbs::for('employee.dashboard', function ($trail) {
    $trail->push('Dashboard', route('employee.dashboard'));
});


Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('home');
    $trail->push('Profile', route('profile'));
});

Breadcrumbs::for('employee/leaverequest', function ($trail) {
    $trail->parent('home');
    $trail->push('Leave Request', route('employee/leaverequest'));
});


Breadcrumbs::for('super-admin.dashboard', function ($trail) {
    $trail->push('Super Admin Dashboard', route('super-admin.dashboard'));
});


//--- Settings company ----



// SECTION: Admin
Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Admin Dashboard', route('admin.dashboard'));
});


// Home > Employee > Application Leave
Breadcrumbs::for('employee/leaveapplication', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Application', route('employee/leaveapplication'));
});

// Home > Employee > Application Leave
Breadcrumbs::for('employee/leavebalance', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Balance', route('employee/leavebalance'));
});

Breadcrumbs::for('admin.employees', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Employees', route('admin.employees'));
});

Breadcrumbs::for('register_employee4', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Employee List', route('register_employee'));
});

Breadcrumbs::for('admin.employees.add', function ($trail) {
    $trail->parent('admin.employees');
    $trail->push('Add Employee', route('admin.employees.add'));
});


// Home > Settings > Company
Breadcrumbs::for('admin.settings.companies', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Companies Settings', route('admin.settings.companies'));
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

// Home > Settings > Department - Add
Breadcrumbs::for('admin.settings.departments.add', function ($trail) {
    $trail->parent('admin.settings.departments');
    $trail->push('Add Department', route('admin.settings.departments.add'));
});

// Home > Settings > Team - Add
Breadcrumbs::for('admin.settings.teams.add', function ($trail) {
    $trail->parent('admin.settings.teams');
    $trail->push('Add Grade', route('admin.settings.teams.add'));
});

// Home > Settings > Team - Edit
Breadcrumbs::for('admin.settings.teams.edit', function ($trail, $id) {
    $trail->parent('admin.settings.teams');
    $trail->push('Edit Team', route('admin.settings.teams.edit', $id));
});


// // Home > Settings > Cost-Centre
Breadcrumbs::for('admin.settings.cost-centres.add', function ($trail) {
    $trail->parent('admin.settings.cost-centres');
    $trail->push('Add Cost-Centres', route('admin.settings.cost-centres.add'));
});

// Home > Settings > Cost-Centre - Edit
Breadcrumbs::for('admin.settings.cost-centres.edit', function ($trail, $id) {
    $trail->parent('admin.settings.cost-centres');
    $trail->push('Edit Cost-Centres', route('admin.settings.cost-centres.edit', $id));
});

// // Home > Settings > Department
Breadcrumbs::for('admin.settings.departments', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Departments Settings', route('admin.settings.departments'));
});

// // Home > Settings > Cost Center
Breadcrumbs::for('admin.settings.cost-centres', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Cost Center Settings', route('admin.settings.cost-centres'));
});

// // Home > Settings > Cost Center
Breadcrumbs::for('admin.settings.department', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Department Settings', route('admin.settings.department'));
});
// // Home > Settings > Team
Breadcrumbs::for('admin.settings.teams', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Teams Settings', route('admin.settings.teams'));
});

// Home > Settings > Grade
Breadcrumbs::for('admin.settings.grades', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Grades Settings', route('admin.settings.grades'));
});

Breadcrumbs::for('admin.settings.branches', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Branches Settings', route('admin.settings.branches'));
});

Breadcrumbs::for('admin.settings.positions', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Employee Positions Settings', route('admin.settings.positions'));
});

// Home > Admin > Leave Request
Breadcrumbs::for('admin.e-leave', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Request', route('admin.e-leave'));
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

// Home > Admin > Leave Application
Breadcrumbs::for('add_leave_application', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Application', route('add_leave_application'));
});

// Home > Admin > Leave Approve
Breadcrumbs::for('approve_leave', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Request', route('approve_leave'));
});

// Home > Admin > Leave Disapprove
Breadcrumbs::for('disapprove_leave', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Request', route('disapprove_leave'));
});

// Home > Admin > Leave Balance
Breadcrumbs::for('admin.e-leave.configuration', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Balance', route('admin.e-leave.configuration'));
});

// Home > Admin > Leave Holiday
Breadcrumbs::for('add_leave_balance', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Balance', route('add_leave_balance'));
});

// Home > Admin > Leave Holiday
Breadcrumbs::for('edit_leave_balance', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Balance', route('edit_leave_balance'));
});

// Home > Admin > Employee List > Profile
Breadcrumbs::for('/admin.settings.company-details/{id}', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Company Details', route('/admin.settings.company-details/{id}', ''));
});

// Home > Admin > Employee List > Profile
Breadcrumbs::for('edit_company_bank', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Company Details', route('edit_company_bank'));
});

// Home > Admin > Employee List > Profile
Breadcrumbs::for('add_company_bank', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Company Details', route('add_company_bank'));
});

// Home > Admin > Employee List > Profile
Breadcrumbs::for('admin.employees.id', function ($trail) {
    $trail->parent('admin.employees');
    $trail->push('Employee Profile', route('admin.employees.id', ''));
});

// Home > Admin > Employee List > Profile
Breadcrumbs::for('admin/edit-employee/{id}', function ($trail) {
    $trail->parent('admin.employees');
    $trail->push('Add Employee', route('admin/edit-employee/{id}', ''));
});


// Home > Admin > Leave Type
Breadcrumbs::for('admin.e-leave.configuration.leave-types', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Type', route('admin.configuration.leave-types'));
});

// Home > Admin > Leave Type
Breadcrumbs::for('admin/leaveapplication', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Type', route('admin/leaveapplication'));
});

Breadcrumbs::for('add_team', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Add Team', route('add_team'));
});


// Error 404
Breadcrumbs::for('errors.404', function ($trail) {
    $trail->push('Page Not Found');
});
