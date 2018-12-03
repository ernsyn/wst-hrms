<?php

use Illuminate\Database\Seeder;

use App\Constants\LeaveTypeRule;

class LeaveTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // LeaveTypeRule::GENDER
        // LeaveTypeRule::CAN_CARRY_FORWARD
        // LeaveTypeRule::MULTIPLE_APPROVAL_LEVELS_NEEDED
        // LeaveTypeRule::REQUIRED_ATTACHMENT
        // LeaveTypeRule::MIN_APPLY_DAYS_BEFORE
        // LeaveTypeRule::CONSECUTIVE
        // LeaveTypeRule::MIN_EMPLOYMENT_PERIOD
        // LeaveTypeRule::MAX_NO_OF_CHILDREN
        // LeaveTypeRule::UNPAID
        // LeaveTypeRule::INC_OFF_DAYS_BASED_ON_APPLIED_DAYS
        // LeaveTypeRule::EMPLOYEE_CANNOT_APPLY
        // LeaveTypeRule::INC_OFF_DAYS
        // LeaveTypeRule::MAX_AFTER_APPLIED_DAYS
        // LeaveTypeRule::DEDUCT_AFTER_LEAVE_TYPES_INSUFFICIENT
        // LeaveTypeRule::MAX_APPLICATIONS
        // LeaveTypeRule::NO_LIMIT
        // LeaveTypeRule::MAX_DAYS_PER_APPLICATION

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
                'rule' => LeaveTypeRule::MIN_APPLY_DAYS_BEFORE,
                'configuration' =>json_encode(array(
                    ['min_leave_days' => 2, 'min_apply_days_before' => 7],
                    ['min_leave_days' => 5, 'min_apply_days_before' => 30],
                ))
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::MULTIPLE_APPROVAL_LEVELS_NEEDED,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::CAN_CARRY_FORWARD,
                'configuration' => json_encode([
                    'max_carry_forward_days' => 6,
                    'valid_till_end_month' => 3
                ])
            ]),
            // new App\LTAppliedRule([
            //     'rule' => LeaveTypeRule::INC_OFF_DAYS_BASED_ON_APPLIED_DAYS,
            //     'configuration' => json_encode([
            //         'min_apply_days' => 6,
            //     ])
            // ]),
        ]);


        // Leave Type: Maternity
        
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
                'rule' => LeaveTypeRule::REQUIRED_ATTACHMENT,
                'configuration' => json_encode([
                    'attachment_type' => 'Birth Certificate',
                ])
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::CONSECUTIVE,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::NON_PRORATED,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INC_OFF_DAYS,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::GENDER,
                'configuration' => json_encode([
                    'gender' => 'female',
                ])
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::MIN_EMPLOYMENT_PERIOD,
                'configuration' => json_encode([
                    'min_days' => 60,
                ])
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::MAX_NO_OF_CHILDREN,
                'configuration' => json_encode([
                    'max_no_of_children' => 5,
                ])
            ]),
        ]);

        // Leave Type: Paternity
        
        $leaveType = App\LeaveType::create([
            'code' => 'PATERNITY',
            'name' => 'Paternity Leave',
            'description' => 'Leave allocated to fathers post-partum.',
            'is_custom' => false,
            'entitled_days' => 10,
            'active' => true,
        ]);

        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::REQUIRED_ATTACHMENT,
                'configuration' => json_encode([
                    'attachment_type' => 'Birth Certificate',
                ])
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::CONSECUTIVE,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::NON_PRORATED,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::GENDER,
                'configuration' => json_encode([
                    'gender' => 'male',
                ])
            ]),
        ]);

        // Leave Type: Unpaid Leave

        $leaveType = App\LeaveType::create([
            'code' => 'UNPAID',
            'name' => 'Unpaid Leave',
            'description' => 'Leave taken by an employee where he will not be paid.',
            'is_custom' => false,
            'entitled_days' => 0,
            'active' => true,
        ]);

        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::UNPAID,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INC_OFF_DAYS_BASED_ON_APPLIED_DAYS,
                'configuration' => json_encode([
                    'min_apply_days' => 7,
                ])
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::EMPLOYEE_CANNOT_APPLY,
            ])
        ]);

        // Leave Type: Unpaid Leave

        $leaveType = App\LeaveType::create([
            'code' => 'TRAINING',
            'name' => 'Training or Business Related Leave',
            'description' => 'Leave taken by an employee when under business or training for the company.',
            'is_custom' => false,
            'entitled_days' => 0,
            'active' => true,
        ]);

        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::NO_LIMIT,
            ]),
        ]);

        // Leave Type: Hospitalization Leave

        $leaveType = App\LeaveType::create([
            'code' => 'HOSPITAL',
            'name' => 'Hospitalization Leave',
            'description' => 'Leave taken when admitted to the hospital.',
            'is_custom' => false,
            'entitled_days' => 60,
            'active' => true,
        ]);

        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::REQUIRED_ATTACHMENT,
                'configuration' => json_encode([
                    'attachment_type' => 'Medical Certificate',
                ])
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INC_OFF_DAYS,
            ]),
        ]);

        $hospitalizationLeaveType = $leaveType;

        // Leave Type: Sick Leave

        $leaveType = App\LeaveType::create([
            'code' => 'SICK',
            'name' => 'Sick Leave',
            'description' => 'Leave taken when employee is medically unwell.',
            'is_custom' => false,
            'entitled_days' => 15,
            'active' => true,
            'subset_entitlement_leave_type_id' => $hospitalizationLeaveType->id,
        ]);

        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::REQUIRED_ATTACHMENT,
                'configuration' => json_encode([
                    'attachment_type' => 'Medical Certificate',
                ])
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::MAX_AFTER_APPLIED_DAYS,
                'configuration' => json_encode([
                    'max_after_applied_days' => 1,
                ])
            ]),
        ]);

        // Leave Type: Marriage Leave

        $leaveType = App\LeaveType::create([
            'code' => 'MARRIAGE',
            'name' => 'Marriage Leave',
            'description' => 'Leave taken when employee has just gotten married.',
            'is_custom' => false,
            'entitled_days' => 5,
            'active' => true,
        ]);

        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::REQUIRED_ATTACHMENT,
                'configuration' => json_encode([
                    'attachment_type' => 'Marriage Certificate',
                ])
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::CONSECUTIVE,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::NON_PRORATED,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INC_OFF_DAYS,
            ]),
        ]);

        // Leave Type: Marriage Leave

        $leaveType = App\LeaveType::create([
            'code' => 'COMPASSIONATE',
            'name' => 'Compassionate Leave',
            'description' => 'Leave taken when a tragedy has happened to your close family.',
            'is_custom' => false,
            'entitled_days' => 5,
            'active' => true,
        ]);

        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::REQUIRED_ATTACHMENT,
                'configuration' => json_encode([
                    'attachment_type' => 'Relevant Document',
                ])
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::MAX_DAYS_PER_APPLICATION,
                'configuration' => json_encode([
                    'max_days_per_application' => 3,
                ])
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INC_OFF_DAYS,
            ]),
        ]);
    }
}
