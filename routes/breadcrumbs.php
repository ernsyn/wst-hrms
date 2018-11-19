<?php


// Login
Breadcrumbs::for('login', function ($trail) {
    $trail->push('Login', route('login'));
});





// SECTION: Employee
// Home
// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});


Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('home');
    $trail->push('Profile', route('profile'));
});


// TODO: To split for employee and admin
// Breadcrumbs::for('add_employee_dependent', function ($trail) {
//     $trail->parent('home');
//     $trail->push('Employee Dependent', route('add_employee_dependent'));
// });

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

// Breadcrumbs::for('register_employee', function ($trail) {
//     $trail->parent('admin.dashboard');
//     $trail->push('Employee List', route('register_employee'));
// });
Breadcrumbs::for('register_employee4', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Employee List', route('register_employee'));
});

Breadcrumbs::for('admin.employees.add', function ($trail) {
    $trail->parent('admin.employees');
    $trail->push('Add Employee', route('admin.employees.add'));
});

// Home > Setup
Breadcrumbs::for('setup', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Setup', route('setup'));
});

// Home > Setup > Company
Breadcrumbs::for('admin.settings.setting-company', function ($trail) {
    $trail->parent('setup');
    $trail->push('Company', route('admin.settings.setting-company'));
});
Breadcrumbs::for('admin.settings.setting-add-company', function ($trail) {
    $trail->parent('setup');
    $trail->push('Company', route('admin.settings.setting-add-company'));
});

// Home > Setup > Cost-Centre
Breadcrumbs::for('admin.settings.setting-cost-centre', function ($trail) {
    $trail->parent('setup');
    $trail->push('Cost-Centre', route('admin.settings.setting-cost-centre'));
});

Breadcrumbs::for('add_branch', function ($trail) {
    $trail->parent('setup');
    $trail->push('Add Branch', route('add_branch'));
});


Breadcrumbs::for('edit_cost_centre', function ($trail) {
    $trail->parent('setup');
    $trail->push('Add Branch', route('edit_cost_centre'));
});

Breadcrumbs::for('edit_position', function ($trail) {
    $trail->parent('setup');
    $trail->push('Add Position', route('edit_position'));
});
Breadcrumbs::for('edit_department', function ($trail) {
    $trail->parent('setup');
    $trail->push('Add Department', route('edit_department'));
});

Breadcrumbs::for('edit_team', function ($trail) {
    $trail->parent('setup');
    $trail->push('Add Team', route('edit_team'));
});

Breadcrumbs::for('edit_branch', function ($trail) {
    $trail->parent('setup');
    $trail->push('Add Branch', route('edit_branch'));
});


Breadcrumbs::for('edit_grade', function ($trail) {
    $trail->parent('setup');
    $trail->push('Add Branch', route('edit_grade'));
});

Breadcrumbs::for('edit_company', function ($trail) {
    $trail->parent('setup');
    $trail->push('Add Company', route('edit_company'));
});
// Home > Setup > Department
Breadcrumbs::for('admin.settings.setting-department', function ($trail) {
    $trail->parent('setup');
    $trail->push('Department', route('admin.settings.setting-department'));
});

// Home > Setup > Team
Breadcrumbs::for('admin.settings.setting-team', function ($trail) {
    $trail->parent('setup');
    $trail->push('Team', route('admin.settings.setting-team'));
});

// Home > Setup > Position
Breadcrumbs::for('admin.settings.setting-position', function ($trail) {
    $trail->parent('setup');
    $trail->push('Position', route('admin.settings.setting-position'));
});

// Home > Setup > Grade
Breadcrumbs::for('admin.settings.setting-grade', function ($trail) {
    $trail->parent('setup');
    $trail->push('Grade', route('admin.settings.setting-grade'));
});
Breadcrumbs::for('admin.settings.setting-branch', function ($trail) {
    $trail->parent('setup');
    $trail->push('Branch', route('admin.settings.setting-branch'));
});

// Home > Admin > Leave Request
Breadcrumbs::for('admin/leaverequest', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Request', route('admin/leaverequest'));
});

// Home > Admin > Leave Holiday
Breadcrumbs::for('admin/leaveholiday', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Holiday', route('admin/leaveholiday'));
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
Breadcrumbs::for('admin/leavebalance', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Balance', route('admin/leavebalance'));
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

Breadcrumbs::for('add_company', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Company Setup', route('add_company'));
});


Breadcrumbs::for('add_department', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Department Setup', route('add_department'));
});
Breadcrumbs::for('add_cost_centre', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Cost Centre Setup', route('add_cost_centre'));
});

// Home > Admin > Employee List > Profile
Breadcrumbs::for('/admin.settings.setting-company-details/{id}', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Company Details', route('/admin.settings.setting-company-details/{id}', ''));
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
Breadcrumbs::for('admin/leavetype', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Type', route('admin/leavetype'));
});

// Home > Admin > Leave Type
Breadcrumbs::for('admin/leaveapplication', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Leave Type', route('admin/leaveapplication'));
});

// Home > Admin > Employee List > Profile
// Breadcrumbs::for('add_emergency_contact', function ($trail) {
//     $trail->parent('admin.employees');
//     $trail->push('Employee Profile', route('add_emergency_contact'));
// });

// Breadcrumbs::for('add_grade', function ($trail) {
//     $trail->parent('admin.dashboard');
//     $trail->push('Add Grade', route('add_grade'));
// });
// Breadcrumbs::for('add_position', function ($trail) {
//     $trail->parent('admin.dashboard');
//     $trail->push('Add Position', route('add_position'));
// });

Breadcrumbs::for('add_team', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Add Team', route('add_team'));
});


// Error 404
Breadcrumbs::for('errors.404', function ($trail) {
    $trail->push('Page Not Found');
});
