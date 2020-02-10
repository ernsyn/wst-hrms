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
        $leaveType = App\LeaveType::create([
            'code' => 'ANNUAL',
            'name' => 'Annual Leave',
            'description' => 'Leave allocated to an employee every year.',
            'is_custom' => false,
            'active' => true,
            'created_by' => 1,
        ]);

        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::ALLOW_BACKDATED,
                'created_by' => 1,
            ]),
        ]);

        $annualLeaveType = $leaveType;
                
        $appliedRule = App\LTAppliedRule::create([
                'leave_type_id' => $annualLeaveType->id,
                'rule' => LeaveTypeRule::MIN_APPLY_DAYS_BEFORE,
                'created_by' => 1,
        ]);
        
        $appliedRule->applied_rule_min_apply_days_before()->saveMany([
            new App\LTAppliedRuleMinApplyDaysBefore([
                'min_leave_days' => 2,
                'min_apply_days_before' => 7,
            ]),
            
            new App\LTAppliedRuleMinApplyDaysBefore([
                'min_leave_days' => 5,
                'min_apply_days_before' => 30,
            ]),
        ]);
            
            
        $appliedRule = App\LTAppliedRule::create([
                'leave_type_id' => $annualLeaveType->id,
                'rule' => LeaveTypeRule::CAN_CARRY_FORWARD,
                'created_by' => 1,
        ]);
            
        $appliedRule->applied_rule_carry_forwards()->saveMany([
            new App\LTAppliedRuleCarryForward([
                'max_carry_forward_days' => 6,
                'valid_until' => 3,
            ]),
        ]);

        // Leave Type: Maternity
        
        $leaveType = App\LeaveType::create([
            'code' => 'MATERNITY',
            'name' => 'Maternity Leave',
            'description' => 'Leave allocated to mothers post-partum.',
            'is_custom' => false,
            'active' => true,
            'created_by' => 1,
        ]);
        
        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::REQUIRED_ATTACHMENT,
                'value' => 'Birth Certificate',
                'created_by' => 1,
            ]),            
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::NON_PRORATED,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INC_OFF_DAYS,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::GENDER,
                'value' => 'female',
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::MIN_EMPLOYMENT_PERIOD,
                'value' => 60,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::MAX_NO_OF_CHILDREN,
                'value' => 5,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INCLUDE_HR_VERIFY,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INCLUDE_HR_FINAL_APPROVAL,
                'created_by' => 1,
            ]),
        ]);

        // Leave Type: Paternity
        
        $leaveType = App\LeaveType::create([
            'code' => 'PATERNITY',
            'name' => 'Paternity Leave',
            'description' => 'Leave allocated to fathers post-partum.',
            'is_custom' => false,
            'active' => true,
            'created_by' => 1,
        ]);
        
        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::REQUIRED_ATTACHMENT,
                'value' => 'Birth Certificate',
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::NON_PRORATED,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::GENDER,
                'value' => 'male',
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INCLUDE_HR_VERIFY,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INCLUDE_HR_FINAL_APPROVAL,
                'created_by' => 1,
            ]),
        ]);

        // Leave Type: Unpaid Leave

        $leaveType = App\LeaveType::create([
            'code' => 'UNPAID',
            'name' => 'Unpaid Leave',
            'description' => 'Leave taken by an employee where he will not be paid.',
            'is_custom' => false,
            'active' => true,
            'created_by' => 1,
        ]);
        
        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::UNPAID,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INC_OFF_DAYS_BASED_ON_APPLIED_DAYS,
                'value' => 7,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::EMPLOYEE_CANNOT_APPLY,
                'created_by' => 1,
            ])
        ]);

        // Leave Type: Training Leave

        $leaveType = App\LeaveType::create([
            'code' => 'TRAINING',
            'name' => 'Training or Business Related Leave',
            'description' => 'Leave taken by an employee when under business or training for the company.',
            'is_custom' => false,
            'active' => true,
            'created_by' => 1,
        ]);
        
        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::NO_LIMIT,
                'created_by' => 1,
            ]),
        ]);

        // Leave Type: Hospitalization Leave

        $leaveType = App\LeaveType::create([
            'code' => 'HOSPITAL',
            'name' => 'Hospitalization Leave',
            'description' => 'Leave taken when admitted to the hospital.',
            'is_custom' => false,
            'active' => true,
            'created_by' => 1,
        ]);
        
        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::REQUIRED_ATTACHMENT,
                'value' => 'Medical Certificate',
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INC_OFF_DAYS,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::NON_PRORATED,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INCLUDE_HR_VERIFY,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INCLUDE_HR_FINAL_APPROVAL,
                'created_by' => 1,
            ]),
        ]);

        $hospitalizationLeaveType = $leaveType;

        // Leave Type: Sick Leave

        $leaveType = App\LeaveType::create([
            'code' => 'SICK',
            'name' => 'Sick Leave',
            'description' => 'Leave taken when employee is medically unwell.',
            'is_custom' => false,
            'active' => true,
            'subset_entitlement_leave_type_id' => $hospitalizationLeaveType->id,
            'created_by' => 1,
        ]);
        
        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::REQUIRED_ATTACHMENT,
                'value' => 'Medical Certificate',
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::ALLOW_BACKDATED,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INCLUDE_HR_VERIFY,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INCLUDE_HR_FINAL_APPROVAL,
                'created_by' => 1,
            ]),
        ]);

        // Leave Type: Marriage Leave

        $leaveType = App\LeaveType::create([
            'code' => 'MARRIAGE',
            'name' => 'Marriage Leave',
            'description' => 'Leave taken when employee has just gotten married.',
            'is_custom' => false,
            'active' => true,
            'created_by' => 1,
        ]);
        
        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::REQUIRED_ATTACHMENT,
                'value' => 'Marriage Certificate',
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::NON_PRORATED,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INC_OFF_DAYS,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INCLUDE_HR_VERIFY,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INCLUDE_HR_FINAL_APPROVAL,
                'created_by' => 1,
            ]),
        ]);

        // Leave Type: Compassionate Leave

        $leaveType = App\LeaveType::create([
            'code' => 'COMPASSIONATE',
            'name' => 'Compassionate Leave',
            'description' => 'Leave taken when a tragedy has happened to your close family.',
            'is_custom' => false,
            'active' => true,
            'created_by' => 1,
        ]);
        
        $leaveType->applied_rules()->saveMany([
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::REQUIRED_ATTACHMENT,
                'value' => 'Relevant Document',
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::MAX_DAYS_PER_APPLICATION,
                'value' => 3,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INC_OFF_DAYS,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INCLUDE_HR_VERIFY,
                'created_by' => 1,
            ]),
            new App\LTAppliedRule([
                'rule' => LeaveTypeRule::INCLUDE_HR_FINAL_APPROVAL,
                'created_by' => 1,
            ]),
        ]);

    }
}
