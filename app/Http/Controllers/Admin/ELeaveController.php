<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Log;

use App\LeaveType;

class ELeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|admin']);
    }

    public function displayConfiguration() 
    {
        $defaultLeaveTypes = LeaveType::default()->get();
        $customLeaveTypes = LeaveType::custom()->get();

        return view('pages.admin.e-leave.configuration', ['defaultLeaveTypes' => $defaultLeaveTypes, 'customLeaveTypes' => $customLeaveTypes]);
    }

    public function addLeaveType() {
        return view('pages.admin.e-leave.configuration.add-leave-type');
    }

    public function postAddLeaveType(Request $request) {
        $leaveTypeData = $request->validate([
            "code" => 'required',
            "name" => 'required',
            "description" => 'required',
            "entitled_days" => '',
        ]);

        $appliedRulesData =  $request->validate([
            "applied_rules" => '',
        ]);

        $gradeGroupsData =  $request->validate([
            "grade_groups" => '',
        ]);

        $conditionalEntitlementsData =  $request->validate([
            "conditional_entitlements" => '',
        ]);

        // dd($conditionalEntitlementsData);

        $leaveType = LeaveType::create($leaveTypeData);

        if(array_key_exists("applied_rules", $appliedRulesData)) {
            foreach ($appliedRulesData['applied_rules'] as $key => $ruleData)  {
                if(array_key_exists('configuration', $ruleData)) {
                    $appliedRulesData['applied_rules'][$key]['configuration'] = json_encode($ruleData['configuration']);
                }
            }
            // dd($appliedRulesData);
            $leaveType->applied_rules()->createMany(
                $appliedRulesData['applied_rules']
            );
        }

        if(array_key_exists("grade_groups", $gradeGroupsData)) {
            // $leaveType->lt_entitlement_grade_groups()->createMany(
            //     $gradeGroupsData["grade_groups"]
            // ); 
        } else {
            if(array_key_exists("conditional_entitlements", $conditionalEntitlementsData)) {
                $leaveType->lt_conditional_entitlements()->createMany(
                    $conditionalEntitlementsData["conditional_entitlements"]
                ); 
            }
        }
        
        return response()->json(['success'=>'Record is successfully added']);
    }
}
