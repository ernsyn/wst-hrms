<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

use App\User;
use App\Employee;
use App\EmployeeDependent;
use App\EmployeeImmigration;
use App\EmployeeVisa;
use App\EmployeeBankAccount;
use App\EmployeeJob;
use App\EmployeeExperience;
use App\EmployeeEducation;
use App\EmployeeSkill;
use App\EmployeeAttachment;
use App\EmployeeEmergencyContact;
use App\EmployeeReportTo;
use App\EmployeeSecurityGroup;
use App\EmployeeWorkingDay;
use App\Media;

class EmployeeController extends Controller
{
    //

    public function displayProfile()
    {
        try {
            $id = Auth::user()->employee->id;
            $employee = Employee::with('user', 'employee_jobs')->find($id);


            $userMedia = DB::table('users')
            ->join('medias', 'users.profile_media_id', '=', 'medias.id')
            ->join('employees', 'employees.user_id', '=', 'users.id')
            ->select('medias.*')
            ->where('employees.id', $id)
            ->first();

            return view('pages.employee.id', ['employee' => $employee,'userMedia' => $userMedia]);

        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', 'You have no profile!');
        }
    }

    public function postEditPicture(Request $request, $id) {
        $pictureData = $request->validate([
            'attachment' => 'required|max:2000000|regex:/^data:image/'
        ],
        [
            'attachment.max' => 'The file size may not be greater than 2MB.'
        ]);

        $picture_data_url = $pictureData['attachment'];
        $attach = self::processBase64DataUrl($picture_data_url);
        $updatepictureData['category']= 'employee-picture';
        $updatepictureData['mimetype']= $attach['mime_type'];
        $updatepictureData['data']= $attach['data'];
        $updatepictureData['size']= $attach['size'];
        $updatepictureData['filename']= 'employee_'.($id).'_'.date('Y-m-d_H:i:s').".".$attach['extension'];
        Media::where('id', $id)->update($updatepictureData);


        return response()->json(['success'=>'Profile Picture was successfully updated.']);
    }

    public function postEditProfile(Request $request, $id)
    {
        $profileUpdatedData = $request->validate([
            'ic_no' => 'required|numeric',
            'dob' => 'required|date',
            'gender' => 'required',
            'contact_no' => 'required|numeric',
            'marital_status' => 'required',
            'race' => 'required|alpha',
            'total_children' => 'nullable|numeric',
            'driver_license_no' => 'nullable',
            'driver_license_expiry_date' => 'nullable',
            'epf_no' => 'required',
            'tax_no' => 'required',
            'eis_no' => 'required',
            'socso_no' => 'required'
        ]);

        Employee::where('id', $id)->update($profileUpdatedData);

        return response()->json(['success'=>'Profile was successfully updated.']);
    }


    public function postChangePassword(Request $request, $id) {
        $data = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:5|required_with:confirm_new_password|same:confirm_new_password',
        ]);

        if (!(Hash::check($data['current_password'],  Auth::user()->password))) {
            response()->json(['errors'=> [
                'current_password' => ['The current password is incorrect.']
            ]], 422);
            return response()->json(['fail'=>'The current password is incorrect. Password was not successfully updated.']);
        } else {
            User::where('id', Auth::user()->id)->update([
                'password' => bcrypt($data['new_password'])
            ]);
            return response()->json(['success'=>'Password was successfully updated.']);
        }
    }


    // SECTION: Data Tables
    public function getDataTableDependents()
    {
        $dependents = EmployeeDependent::where('emp_id', Auth::user()->employee->id)->get();

        return DataTables::of($dependents)
        ->editColumn('dob', function ($dependent) {
            return date('d/m/Y', strtotime($dependent->dob) );
        })
        ->editColumn('alt_dob', function ($dependent) {
            return date('Y-m-d', strtotime($dependent->dob) );
        })
        ->make(true);
    }

    public function getDataTableImmigrations()
    {
        $immigrations = EmployeeImmigration::where('emp_id', Auth::user()->employee->id)->get();

        return DataTables::of($immigrations)
        ->editColumn('issued_date', function ($immigration) {
            return date('d/m/Y', strtotime($immigration->issued_date) );
        })
        ->editColumn('expiry_date', function ($immigration) {
            return date('d/m/Y', strtotime($immigration->expiry_date) );
        })
        ->make(true);
    }

    public function getDataTableVisas()
    {
        $visas = EmployeeVisa::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($visas)
        ->editColumn('issued_date', function ($visa) {
            return date('d/m/Y', strtotime($visa->issued_date) );
        })
        ->editColumn('expiry_date', function ($visa) {
            return date('d/m/Y', strtotime($visa->expiry_date) );
        })
        ->make(true);
    }


    public function getDataTableJobs()
    {
        $jobs = EmployeeJob::with('main_position','department', 'team', 'cost_centre', 'grade', 'branch')->where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($jobs)
        ->editColumn('start_date', function ($job) {
            return date('d/m/Y', strtotime($job->start_date) );
        })
        ->make(true);
    }

    public function getDataTableBankAccounts()
    {
        $banks = EmployeeBankAccount::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($banks)->make(true);
    }

    public function getDataTableExperiences()
    {
        $experiences = EmployeeExperience::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($experiences)
        ->editColumn('start_date', function ($experience) {
            return date('d/m/Y', strtotime($experience->start_date) );
        })
        ->editColumn('end_date', function ($experience) {
            return date('d/m/Y', strtotime($experience->end_date) );
        })
        ->make(true);
    }

    public function getDataTableEducation()
    {
        $educations = EmployeeEducation::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($educations)->make(true);
    }

    public function getDataTableSkills()
    {
        $skills = EmployeeSkill::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($skills)->make(true);
    }

    public function getDataTableAttachments()
    {
        $attachments = EmployeeAttachment::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($attachments)->make(true);
    }

    public function getDataTableEmergencyContacts()
    {
        $contacts = EmployeeEmergencyContact::where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($contacts)->make(true);
    }

    public function getDataTableReportTo()
    {
        $reportTos = EmployeeReportTo::with('employee_report_to.user')->where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($reportTos)->make(true);
    }

    public function getDataTableMainSecurityGroup()
    {
        $employee = Employee::with('security_groups')->where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($employee)->make(true);
    }

    public function getDataTableSecurityGroup()
    {
        $security_groups = EmployeeSecurityGroup::with('security_groups')->where('emp_id', Auth::user()->employee->id)->get();
        return DataTables::of($security_groups)->make(true);
    }

    // SECTION: Add
    public function postEmergencyContact(Request $request, $id)
    {
        $emergencyContactData = $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'contact_no' => 'required|numeric',
        ]);
        $emergencyContactData['created_by'] = auth()->user()->id;
        $emergencyContact = new EmployeeEmergencyContact($emergencyContactData);

        $employee = Employee::find($id);
        $employee->employee_emergency_contacts()->save($emergencyContact);

        return response()->json(['success'=>'Record is successfully added']);
    }

    public function postDependent(Request $request, $id)
    {
        $dependentData = $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'dob' => 'required'
        ]);
        $dependentData['dob'] = implode("-", array_reverse(explode("/", $dependentData['dob'])));
        $dependentData['created_by'] = auth()->user()->id;
        $dependent = new EmployeeDependent($dependentData);

        $employee = Employee::find($id);
        $employee->employee_dependents()->save($dependent);

        return response()->json(['success'=>'Dependent is successfully added']);
    }

    public function postImmigration(Request $request, $id)
    {
        $immigrationData = $request->validate([
            'passport_no' => 'required|alpha_num',
            'expiry_date' => 'required|date',
            'issued_by' => 'required',
            'issued_date' => 'required|date'
        ]);
        $immigrationData['created_by'] = auth()->user()->id;
        $immigration = new EmployeeImmigration($immigrationData);

        $employee = Employee::find($id);
        $employee->employee_immigrations()->save($immigration);

        return response()->json(['success'=>'Record is successfully added']);
    }

    public function postVisa(Request $request, $id)
    {
        $visaData = $request->validate([
            'type' => 'required',
            'visa_number' => 'required|alpha_num',
            'passport_no' => 'required|alpha_num',
            'issued_by' => 'required',
            'issued_date' => 'required|date',
            'expiry_date' => 'required|date',
            'family_members' => 'required'
        ]);
        $visaData['created_by'] = auth()->user()->id;
        $visa = new EmployeeVisa($visaData);

        $employee = Employee::find($id);
        $employee->employee_visas()->save($visa);

        return response()->json(['success'=>'Visa is successfully added']);
    }

    public function postJob(Request $request, $id)
    {
        $jobData = $request->validate([
            'branch_id' => 'required',
            'emp_mainposition_id' => 'required',
            'department_id' => 'required',
            'team_id' => 'required',
            'cost_centre_id' => 'required',
            'emp_grade_id' => 'required',
            'start_date' => 'required',
            'basic_salary' => 'required',
            'remarks' => ''
        ]);
        $jobData['created_by'] = auth()->user()->id;

        $jobData['status'] = 'active';
        $jobData['start_date'] = date("Y-m-d", strtotime($jobData['start_date']));

        $end_date=   EmployeeJob::where('id', $id)
        ->whereNull('end_date');

        EmployeeJob::where('emp_id', $id)
        ->whereNull('end_date')
        ->update(array('end_date'=> date("Y-m-d", strtotime($jobData['start_date']))));

        $employee = Employee::find($id);
        $employee->employee_jobs()->save($job);

        return response()->json(['success'=>'Job is successfully added']);
    }

    public function postBankAccount(Request $request, $id)
    {
        $bankAccountData = $request->validate([
            'bank_code' => 'required',
            'acc_no' => 'required|numeric',
            'acc_status' => 'required'
        ]);
        $bankAccountData['created_by'] = auth()->user()->id;
        $bankAccount = new EmployeeBankAccount($bankAccountData);

        $employee = Employee::find($id);
        $employee->employee_bank_accounts()->save($bankAccount);

        return response()->json(['success'=>'Record is successfully added']);
    }

    public function postCompany(Request $request, $id)
    {
        $experienceData = $request->validate([
            'company' => 'required',
            'position' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'notes' => 'required'
        ]);
        $experienceData['created_by'] = auth()->user()->id;
        $experience = new EmployeeExperience($experienceData);

        $employee = Employee::find($id);
        $employee->employee_experiences()->save($experience);

        return response()->json(['success'=>'Experience is successfully added']);
    }

    public function postEducation(Request $request, $id)
    {
        $educationData = $request->validate([
            'institution' => 'required',
            'start_year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'end_year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'level' => 'required',
            'major' => 'required',
            'gpa' => 'required|numeric|between:0.00,4.00',
            'description' => 'required'
        ]);
        $educationData['created_by'] = auth()->user()->id;
        $education = new EmployeeEducation($educationData);

        $employee = Employee::find($id);
        $employee->employee_educations()->save($education);

        return response()->json(['success'=>'Education is successfully added']);
    }

    public function postSkill(Request $request, $id)
    {
        $skillData = $request->validate([
            'name' => 'required',
            'years_of_experience' => 'required|numeric',
            'competency' => 'required'
        ]);
        $skillData['created_by'] = auth()->user()->id;
        $skill = new EmployeeSkill($skillData);

        $employee = Employee::find($id);
        $employee->employee_skills()->save($skill);

        return response()->json(['success'=>'Skill is successfully added']);
    }

    public function postAttachment(Request $request, $id)
    {
        $attachmentData = $request->validate([
            'name' => 'required',
            'notes' => 'required'
        ]);
        $attachmentData['created_by'] = auth()->user()->id;
        $attachment = new EmployeeAttachment($attachmentData);

        $employee = Employee::find($id);
        $employee->employee_attachments()->save($attachment);

        return response()->json(['success'=>'Attachment is successfully added']);
    }

    private static function processBase64DataUrl($dataUrl) {
        $parts = explode(',', $dataUrl);

        preg_match('#data:(.*?);base64#', $parts[0], $matches);
        $mimeType = $matches[1];
        $extension = explode('/', $mimeType)[1];

        $data = $parts[1];

        return [
            'data' => $data,
            'mime_type' => $mimeType,
            'size' => mb_strlen($data),
            'extension' => $extension
        ];
    }

    // SECTION: Employee Working Day Setup
    public function postWorkingDay(Request $request, $id)
    {
        $workingDayData = $request->validate([
            'monday' => 'required',
            'tuesday' => 'required',
            'wednesday' => 'required',
            'thursday' => 'required',
            'friday' => 'required',
            'saturday' => 'required',
            'sunday' => 'required',
            'start_work_time' => 'required',
            'end_work_time' => 'required',
        ]);
        $workingDaysData['is_template'] = false;
        $workingDaysData['created_by'] = auth()->user()->id;
        $workingDay = new EmployeeWorkingDay($workingDayData);

        $employee = Employee::find($id);
        $employee->working_day()->save($workingDay);

        return response()->json(['success' => 'Working Day is successfully added']);

    }

    public function postEditWorkingDay(Request $request, $id)
    {
        $workingDayUpdateData = $request->validate([
            'monday' => 'required',
            'tuesday' => 'required',
            'wednesday' => 'required',
            'thursday' => 'required',
            'friday' => 'required',
            'saturday' => 'required',
            'sunday' => 'required',
            'start_work_time' => 'required',
            'end_work_time' => 'required',
        ]);
        $workingDayUpdateData['is_template'] = false;
        EmployeeWorkingDay::where('emp_id', $id)->update($workingDayUpdateData);

        return response()->json(['success'=>'Working Day was successfully updated.']);
    }

    public function getWorkingDay($id)
    {
        $working_day = EmployeeWorkingDay::templates()->where('id', $id)->get();

        return response()->json($working_day);
    }

    public function getEmployeeWorkingDay($emp_id)
    {
        $working_day = EmployeeWorkingDay::where('emp_id', $emp_id)->get();

        return response()->json($working_day);
    }

    public function postReportTo(Request $request, $id)
    {
        $reportToData = $request->validate([
            'report_to_emp_id' => 'required',
            'type' => 'required',
            'kpi_proposer' => 'required',
            'notes' => 'required'
        ]);
        $reportToData['created_by'] = auth()->user()->id;
        $reportTo = new EmployeeReportTo($reportToData);

        $employee = Employee::find($id);
        $employee->report_tos()->save($reportTo);

        return response()->json(['success'=>'Record is successfully added']);
    }

    public function postSecurityGroup(Request $request, $id)
    {
        $securityGroupData = $request->validate([
            'security_group_id' => 'required|unique:employee_security_groups,security_group_id,NULL,id,deleted_at,NULL,emp_id,'.$id
        ]);
        $securityGroupData['created_by'] = auth()->user()->id;
        $securityGroup = new EmployeeSecurityGroup($securityGroupData);

        $employee = Employee::find($id);
        $employee->employee_security_groups()->save($securityGroup);

        return response()->json(['success'=>'Security Group was successfully updated.']);
    }


    public function postMainSecurityGroup(Request $request, $id)
    {
        $mainSecurityGroupData = $request->validate([
            'main_security_group_id' => 'required'
        ]);

        Employee::update(array('main_security_group_id' => $mainSecurityGroupData));

        return response()->json(['success'=>'Security Group was successfully updated.']);
    }

    // SECTION: Edit
    public function postEditEmergencyContact(Request $request, $emp_id, $id)
    {
        $emergencyContactUpdatedData = $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'contact_no' => 'required|numeric',
        ]);

        EmployeeEmergencyContact::where('id', $id)->update($emergencyContactUpdatedData);

        return response()->json(['success'=>'Emergency Contact was successfully updated.']);
    }

    public function postEditDependent(Request $request, $emp_id, $id)
    {
        $dependentUpdatedData = $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'dob' => 'required'
        ]);
        $dependentUpdatedData['dob'] = implode("-", array_reverse(explode("/", $dependentUpdatedData['dob'])));
        EmployeeDependent::where('id', $id)->update($dependentUpdatedData);

        return response()->json(['success'=>'Dependent was successfully updated.']);
    }

    public function postEditImmigration(Request $request, $emp_id, $id)
    {
        $immigrationUpdatedData = $request->validate([
            'passport_no' => 'required|alpha_num',
            'expiry_date' => 'required|date',
            'issued_by' => 'required',
            'issued_date' => 'required|date'
        ]);

        EmployeeImmigration::where('id', $id)->update($immigrationUpdatedData);

        return response()->json(['success'=>'Immigration was successfully updated.']);
    }

    public function postEditVisa(Request $request, $emp_id, $id)
    {
        $visaUpdatedData = $request->validate([
            'type' => 'required',
            'visa_number' => 'required|alpha_num',
            'passport_no' => 'required|alpha_num',
            'expiry_date' => 'required|date',
            'issued_by' => 'required',
            'issued_date' => 'required|date',
            'family_members' => 'required'
        ]);

        EmployeeVisa::where('id', $id)->update($visaUpdatedData);

        return response()->json(['success'=>'Visa was successfully updated.']);
    }

    public function postEditBankAccount(Request $request, $emp_id, $id)
    {
        $bankAccountUpdateData = $request->validate([
            'bank_code' => 'required',
            'acc_no' => 'required|numeric',
            'acc_status' => 'required'
        ]);

        EmployeeBankAccount::where('id', $id)->update($bankAccountUpdateData);

        return response()->json(['success'=>'Bank Account was successfully updated.']);
    }

    public function postEditCompany(Request $request, $emp_id, $id)
    {
        $experienceUpdatedData = $request->validate([
            'company' => 'required',
            'position' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'notes' => 'required'
        ]);

        EmployeeExperience::where('id', $id)->update($experienceUpdatedData);

        return response()->json(['success'=>'Experience was successfully updated.']);
    }

    public function postEditEducation(Request $request, $emp_id, $id)
    {
        $educationUpdatedData = $request->validate([
            'institution' => 'required',
            'start_year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'end_year' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'level' => 'required',
            'major' => 'required',
            'gpa' => 'required|numeric|between:0.00,4.00',
            'description' => 'required'
        ]);

        EmployeeEducation::where('id', $id)->update($educationUpdatedData);

        return response()->json(['success'=>'Education was successfully updated.']);
    }

    public function postEditSkill(Request $request, $emp_id, $id)
    {
        $skillUpdatedData = $request->validate([
            'name' => 'required',
            'years_of_experience' => 'required|numeric',
            'competency' => 'required',
        ]);

        EmployeeSkill::where('id', $id)->update($skillUpdatedData);

        return response()->json(['success'=>'Skill was successfully updated.']);
    }

    public function postEditReportTo(Request $request, $emp_id, $id)
    {
        $reportToUpdatedData = $request->validate([
            'report_to_emp_id' => 'required',
            'type' => 'required',
            'kpi_proposer' => 'required',
            'notes' => 'required'
        ]);

        EmployeeReportTo::where('id', $id)->update($reportToUpdatedData);

        return response()->json(['success'=>'Report To was successfully updated.']);
    }

    public function postEditAttachment(Request $request, $emp_id, $id)
    {
        $attachmentUpdatedData = $request->validate([
            'name' => 'required',
            'notes' => 'required'
        ]);

        EmployeeAttachment::where('id', $id)->update($attachmentUpdatedData);

        return response()->json(['success'=>'Attachment was successfully updated.']);
    }



    //delete function
    public function deleteEmergencyContact(Request $request, $emp_id, $id)
    {
        EmployeeEmergencyContact::find($id)->delete();
        return response()->json(['success'=>'Emergency Contact was successfully deleted.']);
    }

    public function deleteDependent(Request $request, $emp_id, $id)
    {
        EmployeeDependent::find($id)->delete();
        return response()->json(['success'=>'Dependent was successfully deleted.']);
    }

    public function deleteImmigration(Request $request, $emp_id, $id)
    {
        EmployeeImmigration::find($id)->delete();
        return response()->json(['success'=>'Immigration was successfully deleted.']);
    }

    public function deleteVisa(Request $request, $emp_id, $id)
    {
        EmployeeVisa::find($id)->delete();
        return response()->json(['success'=>'Visa was successfully deleted.']);
    }

    public function deleteBankAccount(Request $request, $emp_id, $id)
    {
        EmployeeBankAccount::find($id)->delete();
        return response()->json(['success'=>'Bank Account was successfully deleted.']);
    }

    public function deleteExperience(Request $request, $emp_id, $id)
    {
        EmployeeExperience::find($id)->delete();
        return response()->json(['success'=>'Experience was successfully deleted.']);
    }

    public function deleteEducation(Request $request, $emp_id, $id)
    {
        EmployeeEducation::find($id)->delete();
        return response()->json(['success'=>'Education was successfully deleted.']);
    }

    public function deleteSkill(Request $request, $emp_id, $id)
    {
        EmployeeSkill::find($id)->delete();
        return response()->json(['success'=>'Skill was successfully deleted.']);
    }

    public function deleteAttachment(Request $request, $emp_id, $id)
    {
        EmployeeAttachment::find($id)->delete();
        return response()->json(['success'=>'Attachment was successfully deleted.']);
    }

    public function deleteReportTo(Request $request, $emp_id, $id)
    {
        EmployeeReportTo::find($id)->delete();
        return response()->json(['success'=>'Report To was successfully deleted.']);
    }

    public function deleteSecurityGroup(Request $request, $emp_id, $id)
    {
        EmployeeSecurityGroup::find($id)->delete();
        return response()->json(['success'=>'Security Group was successfully deleted.']);
    }
}
