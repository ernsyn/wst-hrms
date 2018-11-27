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
        // $leaveType = App\LeaveType::where('code', 'ANNUAL')->first();
        // $user = App\User::where('email', 'adrian.miller@wisetech.com')->first();
        // App\LeaveAllocation::create([
        //     'leave_type_id' => $leaveType->id,
        //     'emp_id' => $user->employee->id,
        //     'allocated_days' => 13.5,
        //     'valid_from_date' => '2018-11-30',
        //     'valid_until_date' => '2018-12-31',
        // ]);

        // $leaveAllocation = App\LeaveAllocation::where('emp_id', $user->employee->id)->where('leave_type_id', $leaveType->id)->first();
        
        // App\LeaveRequest::create([
        //     'emp_id' => $user->employee->id,
        //     'leave_type_id' => $leaveType->id,
        //     'leave_allocation_id' => $leaveAllocation->id,
        //     'applied_days' => 3,
        //     'reason' => 'Personal Vacation',
        // ]);


        // $leaveRequest = App\LeaveRequest::where('emp_id', $user->employee->id)->first();
        // $leaveRequest->approvals()->save(new App\LeaveRequestApproval([
        //     'approved_by_emp_id' => $user->employee->id
        // ]));

        // $leaveRequest->update([
        //     'is_approved' => true
        // ]);
    }
}
