<?php

use Illuminate\Database\Seeder;
use App\EmploymentStatus;

class EmploymentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmploymentStatus::create(['code' => 'NEWLY_JOINED', 'name' => 'Newly Joined', 'can_delete' => 0, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'CONFIRMATION', 'name' => 'Confirmation', 'can_delete' => 0, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'EXTEND_PROBATION', 'name' => 'Extend Probation', 'can_delete' => 0, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'INCREMENT', 'name' => 'Increment ', 'can_delete' => 0, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'SALARY_ADJUSTMENT', 'name' => 'Salary Adjustment', 'can_delete' => 0, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'DEMOTION', 'name' => 'Demotion', 'can_delete' => 1, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'REASSIGNMENT', 'name' => 'Reassignment', 'can_delete' => 1, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'PROMOTION', 'name' => 'Promotion', 'can_delete' => 1, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'TRANSFER', 'name' => 'Transfer ', 'can_delete' => 1, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'RESIGN', 'name' => 'Resign', 'can_delete' => 0, 'company_id' => 1]);
    }
}
