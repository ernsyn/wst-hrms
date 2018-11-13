<?php
// Home
Breadcrumbs::for('/', function ($trail) {
    $trail->push('Home', route('/'));
});

// Login
Breadcrumbs::for('login', function ($trail) {
    $trail->push('Login', route('login'));
});
Breadcrumbs::for('profile', function ($trail) {
    $trail->push('Profile', route('profile'));
});

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > Employee > Application Leave
Breadcrumbs::for('employee/leaveapplication', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Leave Application', route('employee/leaveapplication'));
});

// Home > Employee > Application Leave
Breadcrumbs::for('employee/leavebalance', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Leave Balance', route('employee/leavebalance'));
});

// Home > Employee List
Breadcrumbs::for('admin/employee_list', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee List', route('admin/employee_list'));
});



Breadcrumbs::for('add_employee_dependent', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Dependent', route('add_employee_dependent'));
});
Breadcrumbs::for('admin/user_list', function ($trail) {
    $trail->parent('home');
    $trail->push('User List', route('admin/user_list'));
});

Breadcrumbs::for('register_employee', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee List', route('register_employee'));
});
Breadcrumbs::for('register_employee4', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee List', route('register_employee'));
});


Breadcrumbs::for('employee/add', function ($trail) {
    $trail->parent('home');
    $trail->push('User Add', route('employee/add'));
});

// Home > Setup
Breadcrumbs::for('setup', function ($trail) {
    $trail->parent('home');
    $trail->push('Setup', route('setup'));
});

// Home > Setup > Company
Breadcrumbs::for('admin/setup/company', function ($trail) {
    $trail->parent('setup');
    $trail->push('Company', route('admin/setup/company'));
});
Breadcrumbs::for('admin/setup/add-company', function ($trail) {
    $trail->parent('setup');
    $trail->push('Company', route('admin/setup/add-company'));
});

// Home > Setup > Cost-Centre
Breadcrumbs::for('admin/setup/cost-centre', function ($trail) {
    $trail->parent('setup');
    $trail->push('Cost-Centre', route('admin/setup/cost-centre'));
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
Breadcrumbs::for('admin/setup/department', function ($trail) {
    $trail->parent('setup');
    $trail->push('Department', route('admin/setup/department'));
});

// Home > Setup > Team
Breadcrumbs::for('admin/setup/team', function ($trail) {
    $trail->parent('setup');
    $trail->push('Team', route('admin/setup/team'));
});

// Home > Setup > Position
Breadcrumbs::for('admin/setup/position', function ($trail) {
    $trail->parent('setup');
    $trail->push('Position', route('admin/setup/position'));
});

// Home > Setup > Grade
Breadcrumbs::for('setup/grade', function ($trail) {
    $trail->parent('setup');
    $trail->push('Grade', route('setup/grade'));
});
Breadcrumbs::for('setup/branch', function ($trail) {
    $trail->parent('setup');
    $trail->push('Branch', route('setup/branch'));
});

// Home > Admin
Breadcrumbs::for('admin.home', function ($trail) {
    $trail->parent('home');
    $trail->push('Admin', route('admin.home'));
});

// Home > Admin > Leave Request
Breadcrumbs::for('admin/leaverequest', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Leave Request', route('admin/leaverequest'));
});

Breadcrumbs::for('employee/leaverequest', function ($trail) {
    $trail->parent('home');
    $trail->push('Leave Request', route('employee/leaverequest'));
});

// Home > Admin > Leave Holiday
Breadcrumbs::for('admin/leaveholiday', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Leave Holiday', route('admin/leaveholiday'));
});

// Home > Admin > Leave Holiday
Breadcrumbs::for('add_holiday', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Leave Holiday', route('add_holiday'));
});

// Home > Admin > Leave Application
Breadcrumbs::for('add_leave_application', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Leave Application', route('add_leave_application'));
});

// Home > Admin > Leave Approve
Breadcrumbs::for('approve_leave', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Leave Request', route('approve_leave'));
});

// Home > Admin > Leave Disapprove
Breadcrumbs::for('disapprove_leave', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Leave Request', route('disapprove_leave'));
});

// Home > Admin > Leave Balance
Breadcrumbs::for('admin/leavebalance', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Leave Balance', route('admin/leavebalance'));
});

// Home > Admin > Leave Holiday
Breadcrumbs::for('add_leave_balance', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Leave Balance', route('add_leave_balance'));
});

// Home > Admin > Leave Holiday
Breadcrumbs::for('edit_leave_balance', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Leave Balance', route('edit_leave_balance'));
});


// Home > Admin > Employee List
// Breadcrumbs::for('admin/employee_list', function ($trail) {
//     $trail->parent('admin.home');
//     $trail->push('Employee List', route('admin/employee_list'));
// });

// Home > Admin > Employee List > Profile
Breadcrumbs::for('admin/profile-employee/{id}', function ($trail) {
    $trail->parent('admin/employee_list');
    $trail->push('Employee Profile', route('admin/profile-employee/{id}', ''));
});

// Home > Admin > Employee List > Profile
Breadcrumbs::for('admin/edit-employee/{id}', function ($trail) {
    $trail->parent('admin/employee_list');
    $trail->push('Add Employee', route('admin/edit-employee/{id}', ''));
});


// Home > Admin > Leave Type
Breadcrumbs::for('admin/leavetype', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Leave Type', route('admin/leavetype'));
});

// Home > Admin > Leave Type
Breadcrumbs::for('admin/leaveapplication', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Leave Type', route('admin/leaveapplication'));
});

// Home > Admin > Employee List > Profile
Breadcrumbs::for('add_emergency_contact', function ($trail) {
    $trail->parent('admin/employee_list');
    $trail->push('Employee Profile', route('add_emergency_contact'));
});

Breadcrumbs::for('add_grade', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Add Grade', route('add_grade'));
});
Breadcrumbs::for('add_position', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Add Position', route('add_position'));
});

Breadcrumbs::for('add_team', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Add Team', route('add_team'));
});



// Breadcrumbs::for('add_holiday', function ($trail) {
//     $trail->parent('admin.home');
//     $trail->push('Holiday Setup', route('add_holiday'));
// });

Breadcrumbs::for('add_company', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Company Setup', route('add_company'));
});


Breadcrumbs::for('add_department', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Department Setup', route('add_department'));
});
Breadcrumbs::for('add_cost_centre', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Cost Centre Setup', route('add_cost_centre'));
});




// // Home > Blog > [Category]
// Breadcrumbs::for('category', function ($trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category->id));
// });

// // Home > Blog > [Category] > [Post]
// Breadcrumbs::for('post', function ($trail, $post) {
//     $trail->parent('category', $post->category);
//     $trail->push($post->title, route('post', $post->id));
// });

//--- setup company ----
// Home > Admin > Employee List > Profile
Breadcrumbs::for('/setup/company-details/{id}', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Company Details', route('/setup/company-details/{id}', ''));
});

// Home > Admin > Employee List > Profile
Breadcrumbs::for('edit_company_bank', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Company Details', route('edit_company_bank'));
});

// Home > Admin > Employee List > Profile
Breadcrumbs::for('add_company_bank', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Company Details', route('add_company_bank'));
});





// Error 404
Breadcrumbs::for('errors.404', function ($trail) {
    $trail->parent('home');
    $trail->push('Page Not Found');
});
