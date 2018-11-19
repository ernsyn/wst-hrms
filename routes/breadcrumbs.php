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


//--- setup company ----



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


// Home > Setup > Company
Breadcrumbs::for('admin.settings.company', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Company', route('admin.settings.company'));
});



// // Home > Setup > Cost-Centre
Breadcrumbs::for('admin.settings.cost-centre', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Cost-Centre Settings', route('admin.settings.cost-centre'));
});


// // Home > Setup > Department
Breadcrumbs::for('admin.settings.department', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Department Settings', route('admin.settings.department'));
});

// // Home > Setup > Team
Breadcrumbs::for('admin.settings.team', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Team', route('admin.settings.team'));
});

// Home > Setup > Grade
Breadcrumbs::for('admin.settings.grade', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Grade', route('admin.settings.grade'));
});
Breadcrumbs::for('admin.settings.branch', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Branch', route('admin.settings.branch'));
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
