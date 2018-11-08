<?php

use Illuminate\Database\Seeder;

class EmployeeJobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $employeejob = App\EmployeeJob::create([
            'emp_id' =>'1',
            'branch_id' => '1',
            'emp_mainposition_id' =>'1',
            'department_id' => '1',
            'department_id' =>'1',
            'team_id' => '1',
            'cost_centre_id' => '1',
            'emp_grade_id' => '1',
            'basic_salary' =>'41000',
            'start_date' =>'2018-09-22',
            'specification' =>'auto',
            'status' =>'active'

        ]);
     

    }
}
