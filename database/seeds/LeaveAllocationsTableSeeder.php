<?php

use Illuminate\Database\Seeder;

class LeaveAllocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leaveType = App\LeaveType::where('code', 'ANNUAL')->first();
        $user = App\User::where('email', 'adrian.miller@wisetech.com')->first();
        App\LeaveAllocation::create([
            'leave_type_id' => $leaveType->id,
            'emp_id' => $user->employee->id,
            'allocated_days' => 13.5,
            'valid_from_date' => '2018-11-30',
            'valid_until_date' => '2018-12-31',
        ]);
    }
}
