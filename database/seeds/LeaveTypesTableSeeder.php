<?php

use Illuminate\Database\Seeder;

class LeaveTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Leave Type: Annual

        $leaveType = App\LeaveType::create([
            'code' => 'ANNUAL',
            'name' => 'Annual Leave',
            'description' => 'Leave allocated to an employee every year.',
            'is_custom' => false,
            'entitled_days' => 16,
            'active' => true,
        ]);

        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => 'min_apply_days_before',
                'configuration' =>json_encode(array(
                    ['min_leave_days' => 2, 'min_apply_days_before' => 7],
                    ['min_leave_days' => 5, 'min_apply_days_before' => 30],
                ))
            ]),
            new App\LTAppliedRule([
                'rule' => 'multiple_approval_levels_required',
            ]),
            new App\LTAppliedRule([
                'rule' => 'can_carry_forward',
                'configuration' => json_encode([
                    'max_carry_forward_days' => 6,
                    'valid_till_date' => '31/03'
                ])
            ]),
        ]);

        $leaveType->lt_conditional_entitlements()->saveMany([
            new App\LTConditionalEntitlement(['min_years' => 5, 'entitled_days' => 18]),
        ]);


        // Leave Type: Annual
        
        $leaveType = App\LeaveType::create([
            'code' => 'MATERNITY',
            'name' => 'Maternity Leave',
            'description' => 'Leave allocated to mothers post-partum.',
            'is_custom' => false,
            'entitled_days' => 60,
            'active' => true,
        ]);

        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => 'leave_calculation',
                'configuration' => json_encode([
                    'consecutive' => true,
                    'include_off_days' => true,
                ])
            ]),
            new App\LTAppliedRule([
                'rule' => 'gender',
                'configuration' => json_encode([
                    'gender' => 'female',
                ])
            ]),
        ]);
    }
}
