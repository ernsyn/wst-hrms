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


Breadcrumbs::for('employee.profile', function ($trail) {
    // $trail->parent('profile');
    $trail->push('My Profile', route('employee.profile'));
});

Breadcrumbs::for('super-admin.dashboard', function ($trail) {
    $trail->push('Super Admin Dashboard', route('super-admin.dashboard'));
});


//--- Settings company ----



// SECTION: Admin
Breadcrumbs::for('admin.dashboard', function ($trail) {
    $trail->push('Admin Dashboard', route('admin.dashboard'));
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

// Home > Settings > Company
Breadcrumbs::for('admin.settings.working-days', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: Working Days (Templates)', route('admin.settings.working-days'));
});

// Home > Settings > Company - Add
Breadcrumbs::for('admin.settings.working-days.add', function ($trail) {
    $trail->parent('admin.settings.working-days');
    $trail->push('Add Working Days', route('admin.settings.working-days.add'));
});

// Home > Settings > Company - Edit
Breadcrumbs::for('admin.settings.working-days.edit', function ($trail, $id) {
    $trail->parent('admin.settings.working-days');
    $trail->push('Edit Working Days', route('admin.settings.working-days.edit', $id));
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

// Home > Settings > Branch - Add
Breadcrumbs::for('admin.settings.branches.add', function ($trail) {
    $trail->parent('admin.settings.branches');
    $trail->push('Add Branch', route('admin.settings.branches.add'));
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
    $trail->push('Add Team', route('admin.settings.teams.add'));
});

// Home > Settings > Team - Edit
Breadcrumbs::for('admin.settings.teams.edit', function ($trail, $id) {
    $trail->parent('admin.settings.teams');
    $trail->push('Edit Team', route('admin.settings.teams.edit', $id));
});
// Home > Settings > Department - Edit
Breadcrumbs::for('admin.settings.departments.edit', function ($trail, $id) {
    $trail->parent('admin.settings.departments');
    $trail->push('Edit Department', route('admin.settings.departments.edit', $id));
});


// Home > Settings > Branches - Edit
Breadcrumbs::for('admin.settings.branches.edit', function ($trail, $id) {
    $trail->parent('admin.settings.branches');
    $trail->push('Edit Branch', route('admin.settings.branches.edit', $id));
});

// Home > Settings > Department - Edit
Breadcrumbs::for('admin.settings.departments.edit.post', function ($trail, $id) {
    $trail->parent('admin.settings.departments');
    $trail->push('Edit Team', route('admin.settings.departments.edit.post', $id));
});

// // Home > Settings > Cost-Centre
Breadcrumbs::for('admin.settings.cost-centres', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: Cost Centres', route('admin.settings.cost-centres'));
});

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
    $trail->push('Settings: Departments', route('admin.settings.departments'));
});

// // Home > Settings > Team
Breadcrumbs::for('admin.settings.teams', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: Teams', route('admin.settings.teams'));
});

// Home > Settings > Grade
Breadcrumbs::for('admin.settings.grades', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: Grades ', route('admin.settings.grades'));
});

Breadcrumbs::for('admin.settings.branches', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: Branches', route('admin.settings.branches'));
});

Breadcrumbs::for('admin.settings.positions', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Settings: Employee Positions', route('admin.settings.positions'));
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

// SECTION: (Admin) E-Leave
Breadcrumbs::for('admin.e-leave.configuration', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('E-Leave Configuration', route('admin.e-leave.configuration'));
});

Breadcrumbs::for('admin.e-leave.configuration.leave-types.add', function ($trail) {
    $trail->parent('admin.e-leave.configuration');
    $trail->push('Add Leave Type', route('admin.e-leave.configuration.leave-types.add'));
});

Breadcrumbs::for('add_team', function ($trail) {
    $trail->parent('admin.dashboard');
    $trail->push('Add Team', route('add_team'));
});


// Error 404
Breadcrumbs::for('errors.404', function ($trail) {
    $trail->push('Page Not Found');
});
