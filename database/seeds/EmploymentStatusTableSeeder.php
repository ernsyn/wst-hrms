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
        EmploymentStatus::create(['code' => 'NEWLY_JOINED', 'name' => 'Newly Joined', 'canDelete' => 0, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'CONFIRMATION', 'name' => 'Confirmation', 'canDelete' => 0, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'EXTEND_PROBATION', 'name' => 'Extend Probation', 'canDelete' => 0, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'INCREMENT', 'name' => 'Increment ', 'canDelete' => 0, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'SALARY_ADJUSTMENT', 'name' => 'Salary Adjustment', 'canDelete' => 0, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'DEMOTION', 'name' => 'Demotion', 'canDelete' => 1, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'REASSIGNMENT', 'name' => 'Reassignment', 'canDelete' => 1, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'PROMOTION', 'name' => 'Promotion', 'canDelete' => 1, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'TRANSFER', 'name' => 'Transfer ', 'canDelete' => 1, 'company_id' => 1]);
        EmploymentStatus::create(['code' => 'RESIGN', 'name' => 'Resign', 'canDelete' => 0, 'company_id' => 1]);
    }
}
