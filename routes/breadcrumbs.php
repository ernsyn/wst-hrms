<?php
// Home
Breadcrumbs::for('/', function ($trail) {
    $trail->push('Home', route('/'));
});

// Login
Breadcrumbs::for('login', function ($trail) {
    $trail->push('Login', route('login'));
});

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
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

// Home > Setup > Cost-Centre
Breadcrumbs::for('admin/setup/cost-centre', function ($trail) {
    $trail->parent('setup');
    $trail->push('Cost-Centre', route('admin/setup/cost-centre'));
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

// Home > Admin > Leave Balance
Breadcrumbs::for('admin/leavebalance', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Leave Balance', route('admin/leavebalance'));
});


// Home > Admin > Employee List
Breadcrumbs::for('admin/employee_list', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Employee List', route('admin/employee_list'));
});

// Home > Admin > Profile
Breadcrumbs::for('admin/profile-employee/{id}', function ($trail) {
    $trail->parent('admin.home');
    $trail->push('Employee', route('admin/profile-employee/{id}', 1));
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




// Error 404
Breadcrumbs::for('errors.404', function ($trail) {
    $trail->parent('home');
    $trail->push('Page Not Found');
});