<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
            'name' => 'Super Admin',
            'password' => bcrypt('superadmin'),
            'email' => 'superadmin@wisetech.com',
        ]);

        $user->assignRole('super-admin');

//         $employee = App\User::create([
//             'name' => 'Nad',
//             'password' => bcrypt('123456'),
//             'email' => '123456@wisetech.com',
//         ]);

//         $employee->assignRole('employee');

//         $employeejob = App\EmployeeJob::create([
//             'emp_id' => 2,
//             'branch_id' => 1,
//             'emp_mainposition_id' => 4,
//             'department_id' => 2,
//             'team_id' => 2,
//             'cost_centre_id' => 2,
//             'emp_grade_id' => '',
//             'start_date' => '',
//             'basic_salary' => '',
//             'specification' => '',
//             'status' => '',            
//         ]);
    }
}
