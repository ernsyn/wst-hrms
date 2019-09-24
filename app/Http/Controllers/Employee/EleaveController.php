<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EmployeeAttachment;
use App\EmployeeBankAccount;
use App\EmployeeDependent;
use App\EmployeeEducation;
use App\EmployeeEmergencyContact;
use App\EmployeeExperience;
use App\EmployeeGrade;
use App\EmployeeBank;
use App\EmployeeImmigration;
use App\EmployeeJob;
use App\EmployeeLanguange;
use App\EmployeePosition;
use App\EmployeeSkill;
use App\EmployeeSupervisor;
use App\EmployeeVisa;
use App\EmployeeWorkingDay;
use App\Company;
use App\CostCentre;
use App\Department;
use App\Branch;
use App\Team;
use App\LeaveRequest;
use App\LeaveType;
use App\EmployeeReportTo;
use App\Country;
use App\Employee;
use App\Holiday;
use App\CompanyBank;
use App\SecurityGroup;
use App\Addition;
use App\Deduction;
use App\EaForm;
use App\LeaveRequestApproval;
use App\LeaveAllocation;
use App\LTAppliedRule;
use DatePeriod;
use DateInterval;
use \stdClass;
use DB;
use App\User;
use App\EmployeeInfo;
use \Crypt;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use \DateTime;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\Http\Services\LeaveService;
use App\Mail\LeaveApprovalMail;
use App\Mail\LeaveRequestMail;
use App\Mail\LeaveApprovalFirstApproverMail;
use App\Mail\LeaveRejectedMail;
use App\Mail\LeaveRejectedFirstApproverMail;

class ELeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:employee']);
    }
    
    public function addLeaveApplication(Request $request)
    {         
        $leaveApllicationData =$request->validate([
        ]);
        return redirect()->route('employees');
    }
    
    private static function error($message) 
    {
        return [
            'error' => true,
            'message' => $message
        ];
    }
    
    public function displayLeaveApproval()
    {
        $user = Auth::user();
        $report_to_emp_id = $user->employee->id;
        $report_to = EmployeeReportTo::select('emp_id')->where('report_to_emp_id',$report_to_emp_id)->get()->toArray();
        $report_to_employee = EmployeeReportTo::select('report_to_emp_id')->where('report_to_emp_id',$report_to_emp_id)->get()->toArray();

        $leaveRequests =LeaveRequest::with('leave_type','leave_request_approval')
            ->whereIn('emp_id',$report_to)
            ->get();
        $employee = LeaveRequest::with('report_to')->get();
        $report_to = EmployeeReportTo::select('emp_id')->where('report_to_emp_id',$report_to_emp_id)->get()->toArray();
        $leaveRequests = LeaveRequest::with('leave_type','leave_request_approval')->whereIn('emp_id',$report_to)->get();

        return view('pages.employee.e-leave.leave-request', ['leaveRequests' => $leaveRequests]);   
    }

    public function displayLeaveRequests()
    {
        $user = Auth::user();
        $emp_id = $user->employee->id;
        $leaveRequests =LeaveRequest::where('emp_id',$emp_id)->get();
        return view('pages.employee.e-leave.leave-history', ['leaveRequests' => $leaveRequests]);   
    }
    private static function mime2ext($mime) {
        $mime_map = [
            'video/3gpp2'                                                               => '3g2',
            'video/3gp'                                                                 => '3gp',
            'video/3gpp'                                                                => '3gp',
            'application/x-compressed'                                                  => '7zip',
            'audio/x-acc'                                                               => 'aac',
            'audio/ac3'                                                                 => 'ac3',
            'application/postscript'                                                    => 'ai',
            'audio/x-aiff'                                                              => 'aif',
            'audio/aiff'                                                                => 'aif',
            'audio/x-au'                                                                => 'au',
            'video/x-msvideo'                                                           => 'avi',
            'video/msvideo'                                                             => 'avi',
            'video/avi'                                                                 => 'avi',
            'application/x-troff-msvideo'                                               => 'avi',
            'application/macbinary'                                                     => 'bin',
            'application/mac-binary'                                                    => 'bin',
            'application/x-binary'                                                      => 'bin',
            'application/x-macbinary'                                                   => 'bin',
            'image/bmp'                                                                 => 'bmp',
            'image/x-bmp'                                                               => 'bmp',
            'image/x-bitmap'                                                            => 'bmp',
            'image/x-xbitmap'                                                           => 'bmp',
            'image/x-win-bitmap'                                                        => 'bmp',
            'image/x-windows-bmp'                                                       => 'bmp',
            'image/ms-bmp'                                                              => 'bmp',
            'image/x-ms-bmp'                                                            => 'bmp',
            'application/bmp'                                                           => 'bmp',
            'application/x-bmp'                                                         => 'bmp',
            'application/x-win-bitmap'                                                  => 'bmp',
            'application/cdr'                                                           => 'cdr',
            'application/coreldraw'                                                     => 'cdr',
            'application/x-cdr'                                                         => 'cdr',
            'application/x-coreldraw'                                                   => 'cdr',
            'image/cdr'                                                                 => 'cdr',
            'image/x-cdr'                                                               => 'cdr',
            'zz-application/zz-winassoc-cdr'                                            => 'cdr',
            'application/mac-compactpro'                                                => 'cpt',
            'application/pkix-crl'                                                      => 'crl',
            'application/pkcs-crl'                                                      => 'crl',
            'application/x-x509-ca-cert'                                                => 'crt',
            'application/pkix-cert'                                                     => 'crt',
            'text/css'                                                                  => 'css',
            'text/x-comma-separated-values'                                             => 'csv',
            'text/comma-separated-values'                                               => 'csv',
            'application/vnd.msexcel'                                                   => 'csv',
            'application/x-director'                                                    => 'dcr',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'   => 'docx',
            'application/x-dvi'                                                         => 'dvi',
            'message/rfc822'                                                            => 'eml',
            'application/x-msdownload'                                                  => 'exe',
            'video/x-f4v'                                                               => 'f4v',
            'audio/x-flac'                                                              => 'flac',
            'video/x-flv'                                                               => 'flv',
            'image/gif'                                                                 => 'gif',
            'application/gpg-keys'                                                      => 'gpg',
            'application/x-gtar'                                                        => 'gtar',
            'application/x-gzip'                                                        => 'gzip',
            'application/mac-binhex40'                                                  => 'hqx',
            'application/mac-binhex'                                                    => 'hqx',
            'application/x-binhex40'                                                    => 'hqx',
            'application/x-mac-binhex40'                                                => 'hqx',
            'text/html'                                                                 => 'html',
            'image/x-icon'                                                              => 'ico',
            'image/x-ico'                                                               => 'ico',
            'image/vnd.microsoft.icon'                                                  => 'ico',
            'text/calendar'                                                             => 'ics',
            'application/java-archive'                                                  => 'jar',
            'application/x-java-application'                                            => 'jar',
            'application/x-jar'                                                         => 'jar',
            'image/jp2'                                                                 => 'jp2',
            'video/mj2'                                                                 => 'jp2',
            'image/jpx'                                                                 => 'jp2',
            'image/jpm'                                                                 => 'jp2',
            'image/jpeg'                                                                => 'jpeg',
            'image/pjpeg'                                                               => 'jpeg',
            'application/x-javascript'                                                  => 'js',
            'application/json'                                                          => 'json',
            'text/json'                                                                 => 'json',
            'application/vnd.google-earth.kml+xml'                                      => 'kml',
            'application/vnd.google-earth.kmz'                                          => 'kmz',
            'text/x-log'                                                                => 'log',
            'audio/x-m4a'                                                               => 'm4a',
            'application/vnd.mpegurl'                                                   => 'm4u',
            'audio/midi'                                                                => 'mid',
            'application/vnd.mif'                                                       => 'mif',
            'video/quicktime'                                                           => 'mov',
            'video/x-sgi-movie'                                                         => 'movie',
            'audio/mpeg'                                                                => 'mp3',
            'audio/mpg'                                                                 => 'mp3',
            'audio/mpeg3'                                                               => 'mp3',
            'audio/mp3'                                                                 => 'mp3',
            'video/mp4'                                                                 => 'mp4',
            'video/mpeg'                                                                => 'mpeg',
            'application/oda'                                                           => 'oda',
            'audio/ogg'                                                                 => 'ogg',
            'video/ogg'                                                                 => 'ogg',
            'application/ogg'                                                           => 'ogg',
            'application/x-pkcs10'                                                      => 'p10',
            'application/pkcs10'                                                        => 'p10',
            'application/x-pkcs12'                                                      => 'p12',
            'application/x-pkcs7-signature'                                             => 'p7a',
            'application/pkcs7-mime'                                                    => 'p7c',
            'application/x-pkcs7-mime'                                                  => 'p7c',
            'application/x-pkcs7-certreqresp'                                           => 'p7r',
            'application/pkcs7-signature'                                               => 'p7s',
            'application/pdf'                                                           => 'pdf',
            'application/octet-stream'                                                  => 'pdf',
            'application/x-x509-user-cert'                                              => 'pem',
            'application/x-pem-file'                                                    => 'pem',
            'application/pgp'                                                           => 'pgp',
            'application/x-httpd-php'                                                   => 'php',
            'application/php'                                                           => 'php',
            'application/x-php'                                                         => 'php',
            'text/php'                                                                  => 'php',
            'text/x-php'                                                                => 'php',
            'application/x-httpd-php-source'                                            => 'php',
            'image/png'                                                                 => 'png',
            'image/x-png'                                                               => 'png',
            'application/powerpoint'                                                    => 'ppt',
            'application/vnd.ms-powerpoint'                                             => 'ppt',
            'application/vnd.ms-office'                                                 => 'ppt',
            'application/msword'                                                        => 'ppt',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
            'application/x-photoshop'                                                   => 'psd',
            'image/vnd.adobe.photoshop'                                                 => 'psd',
            'audio/x-realaudio'                                                         => 'ra',
            'audio/x-pn-realaudio'                                                      => 'ram',
            'application/x-rar'                                                         => 'rar',
            'application/rar'                                                           => 'rar',
            'application/x-rar-compressed'                                              => 'rar',
            'audio/x-pn-realaudio-plugin'                                               => 'rpm',
            'application/x-pkcs7'                                                       => 'rsa',
            'text/rtf'                                                                  => 'rtf',
            'text/richtext'                                                             => 'rtx',
            'video/vnd.rn-realvideo'                                                    => 'rv',
            'application/x-stuffit'                                                     => 'sit',
            'application/smil'                                                          => 'smil',
            'text/srt'                                                                  => 'srt',
            'image/svg+xml'                                                             => 'svg',
            'application/x-shockwave-flash'                                             => 'swf',
            'application/x-tar'                                                         => 'tar',
            'application/x-gzip-compressed'                                             => 'tgz',
            'image/tiff'                                                                => 'tiff',
            'text/plain'                                                                => 'txt',
            'text/x-vcard'                                                              => 'vcf',
            'application/videolan'                                                      => 'vlc',
            'text/vtt'                                                                  => 'vtt',
            'audio/x-wav'                                                               => 'wav',
            'audio/wave'                                                                => 'wav',
            'audio/wav'                                                                 => 'wav',
            'application/wbxml'                                                         => 'wbxml',
            'video/webm'                                                                => 'webm',
            'audio/x-ms-wma'                                                            => 'wma',
            'application/wmlc'                                                          => 'wmlc',
            'video/x-ms-wmv'                                                            => 'wmv',
            'video/x-ms-asf'                                                            => 'wmv',
            'application/xhtml+xml'                                                     => 'xhtml',
            'application/excel'                                                         => 'xl',
            'application/msexcel'                                                       => 'xls',
            'application/x-msexcel'                                                     => 'xls',
            'application/x-ms-excel'                                                    => 'xls',
            'application/x-excel'                                                       => 'xls',
            'application/x-dos_ms_excel'                                                => 'xls',
            'application/xls'                                                           => 'xls',
            'application/x-xls'                                                         => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'         => 'xlsx',
            'application/vnd.ms-excel'                                                  => 'xlsx',
            'application/xml'                                                           => 'xml',
            'text/xml'                                                                  => 'xml',
            'text/xsl'                                                                  => 'xsl',
            'application/xspf+xml'                                                      => 'xspf',
            'application/x-compress'                                                    => 'z',
            'application/x-zip'                                                         => 'zip',
            'application/zip'                                                           => 'zip',
            'application/x-zip-compressed'                                              => 'zip',
            'application/s-compressed'                                                  => 'zip',
            'multipart/x-zip'                                                           => 'zip',
            'text/x-scriptzsh'                                                          => 'zsh',
        ];
    
        return isset($mime_map[$mime]) ? $mime_map[$mime] : false;
    }
    
    public function getLeaveRequestAttachment($id) {

        // $user = Auth::user();
        // $emp_id = $user->employee->id;
        // $leaveRequests =LeaveRequest::where('emp_id',$emp_id)->get();
        $leaveRequest =  LeaveRequest::find($id);

        if(!empty($leaveRequest) && $leaveRequest['attachment_media_id']) {
            $attachment = $leaveRequest->attachment;

            // return response()->json([
            //     "size" => $attachment->size,
            //     "data" => base64_encode($attachment->data)
            // ]);
            // dd($attachment->size);
            return response($attachment->data)
                ->header('Cache-Control', 'no-cache private')
                ->header('Content-Description', 'File Transfer')
                ->header('Content-Type', $attachment->mime_type)
                ->header('Content-Length', strlen($attachment->data))
                ->header('Content-Disposition', 'attachment; filename='.$attachment->filename.".".$this::mime2ext($attachment->mimetype))
                ->header('Content-Transfer-Encoding', 'base64');
        }

        return response(null, 204);
    }
        //------ for features purposes ------------
    public function find($emp_id)
    {
        $query = EmergencyCOntact::query();

        if ($id) {
            $result = $query->where('id',$id)->first();
        } else {
            $result = $query->where('emp_id', $emp_id)->get();
        }

        return $result;
    }

    public function displayLeaveApplication()
    {      
        $leaveBalance = LeaveType::all();
        return view('pages.employee.e-leave.leave-application', ['leaveBalance'=>$leaveBalance]);
    }

    public function ajaxGetLeaveTypes()
    {
        $leaveTypes = LeaveService::getLeaveTypesForEmployee(Auth::user()->employee);
        return response()->json($leaveTypes);
    }

    public function ajaxGetEmployeeLeaves(Request $request, $status)
    {
        $leaveRequest = LeaveRequest::where('emp_id', Auth::user()->employee->id)
            ->where('status', $status)
            ->where('start_date', '>=', $request->start)
            ->where('end_date', '<=', $request->end)
            ->get();
        
        $result = array();

        foreach ($leaveRequest as $row) 
        {
            $leave = new stdClass();
            $leaveType = LeaveType::where('id', $row->leave_type_id)->first();

            $leave->id = $row->id;
            $leave->title = $leaveType->name;
            $leave->start = $row->start_date;
            $leave->end = $row->end_date."T23:59:59";
            $leave->status = $row->status;
            $leave->reason = $row->reason;

            if ($row->am_pm) {
                $leave->am_pm = strtoupper($row->am_pm);
            } else {
                $leave->am_pm = "Full Day";
            }
            
            $result[] = $leave;
        }

        return $result;
    }

    public function ajaxGetHolidays(Request $request)
    {
        $branch = DB::table('employee_jobs')
            ->join('branches', 'employee_jobs.branch_id', '=', 'branches.id')
            ->select('branches.state')
            ->where('employee_jobs.emp_id', Auth::user()->employee->id)
            ->orderBy('employee_jobs.created_at', 'DESC')
            ->first();

        if(empty($branch)) {
            return self::error("Employee job is not set yet.");
        }

        $holidays = Holiday::where('status', 'active')
            ->where('state', 'like', '%' . $branch->state . '%')
            ->where('start_date', '>=', $request->start)
            ->where('end_date', '<=', $request->end)
            ->get();            

        if(empty($holidays)) {
            return self::error("Holidays not set yet.");
        }
        
        $result = array();

        foreach ($holidays as $row) 
        {
            $holiday = new stdClass();

            $holiday->id = $row->id;
            $holiday->title = $row->name;
            $holiday->start = $row->start_date;
            $holiday->end = $row->end_date."T23:59:59";
            $holiday->status = 'holiday';
            $holiday->reason = $row->note;
            // $holiday->allDay = true;
            $result[] = $holiday;
        }

        return $result;
    }

    public function ajaxGetLeaveRequestSingle($id)
    {
        $leaveRequest = LeaveRequest::where('id', $id)->first();
        return response()->json($leaveRequest);
    }

    public function ajaxGetEmployeeWorkingDays()
    {
        $working_day = Auth::user()->employee->working_day;

        if(empty($working_day)) {
            return self::error("Employees working days not set yet.");
        }
        
        $result = array();
        $work_day = array('full', 'half', 'half_2');

        if (in_array($working_day->sunday, $work_day)) {
            array_push($result, 0);
        }

        if(in_array($working_day->monday, $work_day)) {
            array_push($result, 1);
        }

        if(in_array($working_day->tuesday, $work_day)) {
            array_push($result, 2);
        }

        if(in_array($working_day->wednesday, $work_day)) {
            array_push($result, 3);
        }

        if(in_array($working_day->thursday, $work_day)) {
            array_push($result, 4);
        }

        if(in_array($working_day->friday, $work_day)) {
            array_push($result, 5);
        }

        if(in_array($working_day->saturday, $work_day)) {
            array_push($result, 6);
        }

        return $result;
    }

    public function ajaxCheckEmployeeJob()
    {
        $employeeJob = EmployeeJob::where('emp_id', Auth::user()->employee->id)->count();
        return $employeeJob;
    }

    //create leave request
    public function ajaxPostCreateLeaveRequest(Request $request)
    {
        $requestData = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'leave_type' => 'required',
            'am_pm' => '',
            'reason' => 'required',
            'attachment' => ''
        ]);

        $am_pm = null;
        if(array_key_exists('am_pm', $requestData)) {
            $am_pm = $requestData['am_pm'];
        }

        $attachment_data_url = null;
        if(array_key_exists('attachment', $requestData)) {
            $attachment_data_url = $requestData['attachment'];
        }

        $result = LeaveService::createLeaveRequest(Auth::user()->employee, $requestData['leave_type'], $requestData['start_date'], $requestData['end_date'], $am_pm, $requestData['reason'], $attachment_data_url);

        $leave_request = LeaveRequest::where('id', $result)->first();
        
        $leave_type_id = $request->input('leave_type');   
        
        $multiple_approval_levels_required = LTAppliedRule::where('rule','multiple_approval_levels_needed')   //to get multiple_approval_levels_required
            ->where('leave_type_id',$leave_type_id)
            ->count() == 0;
        
        if ($multiple_approval_levels_required == false) {
            // send leave request email notification
            self::sendLeaveRequestNotification($leave_request);
            return response()->json($result);
        }
        else{
            // send leave request email notification
            self::sendLeaveRequestNonMultipleNotification($leave_request);
            return response()->json($result);
        }
    }

    //todo - problematic (it deletes the old entry and replace it with a newly created entry)
    public function ajaxPostEditLeaveRequest(Request $request, $id)
    {
        $requestData = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'leave_type' => 'required',
            'am_pm' => '',
            'reason' => 'required',
            'attachment' => ''
        ]);

        // update leave allocations and remove previous leave request
        $leaveRequest = LeaveRequest::where('id', $id)->first();

        $now = Carbon::now();
        
        $leaveAllocation = LeaveAllocation::where('emp_id', Auth::user()->employee->id)
            ->where('leave_type_id', $request['leave_type'])
            ->where('valid_from_date', '<=', $now)
            ->where('valid_until_date', '>=', $now)
            ->first();

        $leaveAllocation->update([
            'spent_days' => $leaveAllocation->spent_days - $leaveRequest->applied_days
        ]);

        $leaveRequest->delete();

        $am_pm = null;
        if(array_key_exists('am_pm', $requestData)) {
            $am_pm = $requestData['am_pm'];
        }

        $attachment_data_url = null;
        if(array_key_exists('attachment', $requestData)) {
            $attachment_data_url = $requestData['attachment'];
        }

        $result = LeaveService::createLeaveRequest(Auth::user()->employee, $requestData['leave_type'], $requestData['start_date'], $requestData['end_date'], $am_pm, $requestData['reason'], $attachment_data_url);
        $leave_request = LeaveRequest::where('id', $result)->first();

        // send leave request email notification
        self::sendLeaveRequestNotification($leave_request);
        return response()->json($result);
    }

    public function ajaxCancelLeaveRequest($id)
    {
        // update leave allocations and remove previous leave request
        $leaveRequest = LeaveRequest::where('id', $id)->first();

        $now = Carbon::now();
        
        $leaveAllocation = LeaveAllocation::where('emp_id', Auth::user()->employee->id)
            ->where('leave_type_id', $leaveRequest['leave_type_id'])
            ->where('valid_from_date', '<=', $now)
            ->where('valid_until_date', '>=', $now)
            ->first();

        $leaveAllocation->update([
            'spent_days' => $leaveAllocation->spent_days - $leaveRequest->applied_days
        ]);

        $leaveRequest->delete();
        return response()->json(['success'=>'Leave Request was successfully cancelled.']);
    }

    public function ajaxPostCheckLeaveRequest(Request $request)
    {
        $requestData = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'leave_type' => 'required',
            'am_pm' => '',
            'edit_leave_request_id' => 'integer'
        ]);

        $am_pm = null;
        if(array_key_exists('am_pm', $requestData)) {
            $am_pm = $requestData['am_pm'];
        }

        $edit_leave_request_id = null;
        if(array_key_exists('edit_leave_request_id', $requestData)) {
            $edit_leave_request_id = $requestData['edit_leave_request_id'];
        }

        $result = LeaveService::checkLeaveRequest(Auth::user()->employee, $requestData['leave_type'], $requestData['start_date'], $requestData['end_date'], $am_pm, $edit_leave_request_id);

        // $result = LeaveService::checkLeaveRequest(Auth::user()->employee, $requestData['leave_type'], $requestData['start_date'], $requestData['end_date'], $am_pm);
        return response()->json($result);
    }

    public function ajaxGetLeaveRules($leave_type_id)
    {
        $emp_id = Auth::user()->employee->id;

        $now = Carbon::now();
        $ltAppliedRule = LTAppliedRule::where('leave_type_id', $leave_type_id)
            ->whereNull('deleted_at')
            ->get();

        return response()->json($ltAppliedRule);
    }

    public function ajaxCalculateActualLeaveDays($start_date, $end_date)
    {
        $start_date = explode("-", $start_date);
        $start_string = $start_date[2].'-'.$start_date[1].'-'.$start_date[0];

        $end_date = explode("-", $end_date);
        $end_string = $end_date[2].'-'.$end_date[1].'-'.$end_date[0];

        $start = new DateTime($start_string);
        $end = new DateTime($end_string);

        // Add the previous Sunday to leave period if start is a Monday
        if($start->format('D') == 'Mon') {
            $start->modify('-1 day');
        }
        
        $end->modify('+1 day'); // fix for end date is excluded
        $interval = $end->diff($start);

        // total days
        $days = $interval->days;

        $getHolidays = Holiday::where('start_date', '>=', $start->format('Y-m-d'))->where('status', 'active')->get();

        // Array of holidays to check the dates against
        $holidays = array();

        foreach ($getHolidays as $getHoliday) {
            $includeDatesBetween = new DatePeriod(
                new DateTime($getHoliday->start_date),
                new DateInterval('P1D'),
                new DateTime($getHoliday->end_date.'+1 day') // fix for excluding end_date
            );

            foreach($includeDatesBetween as $date) { 
                if(!in_array($date->format('Y-m-d'), $holidays, true)) {
                    array_push($holidays, $date->format('Y-m-d'));
                } 
            }
        }

        // Create an iterateable period of date (P1D equates to 1 day)
        $period = new DatePeriod($start, new DateInterval('P1D'), $end);

        foreach($period as $dt) {
            $curr = $dt->format('D');

            // Substract if Saturday or Sunday
            if ($curr == 'Sat' || $curr == 'Sun') {
                $days--;
                
                // Subtract if Holidays falls on a Sunday
                if($curr == 'Sun' && in_array($dt->format('Y-m-d'), $holidays)) {
                    $days--;
                }
            }
            // Subtract Holidays 
            else if (in_array($dt->format('Y-m-d'), $holidays)) {
                $days--;
            }
        }

        return $days;
    }

    public function postLeaveRequest(Request $request, $id)
    {
        $leaveRequestData = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'reason' => 'required'
        ]);

        $leaveRequestData['is_template'] = false;

        $leaveRequest = new LeaveRequest($leaveRequestData);

        $employee = Employee::find($id);
        $employee->leave_request()->save($leaveRequest);

        return response()->json(['success' => 'Leave Request is successfully added']);
    }

    public function displayLeaveBalance()
    {
        $leaveBalance = LeaveBalance::join('employees','employees.id','=','leave_balance.user_id')
            ->join('leave_types','leave_types.id','=','leave_balance.id_leave_type')
            ->join('users','users.id','=','employees.user_id')
            ->select(
                'users.name as name','users.id as user_id',
                'leave_balance.balance as balance','leave_balance.id as balance_id',
                'leave_balance.carry_forward as carry',
                'leave_types.name as leave','leave_types.id as type_id'
            )
            ->get();
    }

    public function addLeaveApproval(Request $request, $id) 
    {
        $leaveRequest = LeaveRequest::find($id);
        return view('pages.employee.e-leave.add-leave-request', ['leaveRequest' => $leaveRequest]);
    }        
    
    public function rejectLeaveApproval(Request $request, $id) 
    {
        $leaveRequest = LeaveRequest::find($id);
        return view('pages.employee.e-leave.reject-leave-request', ['leaveRequest' => $leaveRequest]);
    }
   
    public function postAddApproval(Request $request)
    {        
        Log::debug('Approve Leave');
        $id = $request->input('id');     
        $emp_id = $request->input('emp_id');    
        $leave_type_id = $request->input('leave_type_id');   
        $total_days =$request->input('total_days');
        $user = Auth::user();
        $report_to_emp_id = $user->employee->id;

        $multiple_approval_levels_required = LTAppliedRule::where('rule','multiple_approval_levels_needed')   //to get multiple_approval_levels_required
            ->where('leave_type_id',$leave_type_id)
            ->count();

//         $employee_report_to_level = EmployeeReportTo::select('report_to_level')  //to check employee report to level = 1 
//             ->where('report_to_emp_id','=',$report_to_emp_id)
//             ->where('emp_id','=',$emp_id)  
//             ->where ('report_to_level','=','1')
//             ->get();  

        $leave_request_approval = LeaveRequestApproval::where('leave_request_id','=',$id) //check leave_request id in leave request approval
            ->count(); 

        $leave_status =LeaveRequest::select('status')
           ->where('id',$id)   //to get leave request status
           ->where('status','new')
           ->count();
        
        $report_to_level = EmployeeReportTo::select('report_to_level')  //to check employee report to level = 1 
            ->where('report_to_emp_id','=',$report_to_emp_id)
            ->where('emp_id','=',$emp_id) 
            ->where('report_to_level','1') 
            ->count(); 
        
        Log::debug('Leave Request ID: '.$id);
        Log::debug('Employee ID: '.$emp_id);
        Log::debug('Report To ID: '.$report_to_emp_id);
        Log::debug('Multiple approval levels required: '.$multiple_approval_levels_required);
        Log::debug('Leave request approval: '.$leave_request_approval);
        Log::debug('Leave Status: '.$leave_status);
        Log::debug('Report To Level: '.$report_to_level);
        
        if ($leave_status == 1) {
            Log::debug('Leave Status == 1');
            
            if ($multiple_approval_levels_required == 1) {
                Log::debug('Multiple approval levels required == 1');
	            if ($report_to_level == 1) 
	            {
	                Log::debug('Report To Level == 1');
		            if($leave_request_approval == 0)
		            {
		                Log::debug('Leave request approval == 0');
			       	    LeaveRequest::find($id)->update(array('status' => 'new'));      //then update leave request status = new
                        $leaveTotalDays = LeaveRequest::select('applied_days')->where('id', $id )->get();                       
                        $leaveRequestData = $request->validate([
                        ]);
        
                        $leaveRequestData['leave_request_id'] = $request->id;
                        $leaveRequestData['approved_by_emp_id'] = $report_to_emp_id;
                        $leaveRequestData = new LeaveRequestApproval($leaveRequestData);  
                        Log::debug('leaveRequestData');
                        Log::debug($leaveRequestData);
                        $employee = Employee::find($report_to_emp_id);
                        $leave_approval = $employee->leave_request_approvals()->save($leaveRequestData);
                        $leave_request_approval = LeaveRequestApproval::where('leave_request_id', $id)
                            ->orderby('created_at', 'desc')->first();
                        
                        // send leave request email notification
                        self::sendLeaveRequestApprovalFirstApproverNotification($leave_request_approval, $emp_id); 
                        Log::debug('Leave request is approved by level one report to');
                        return redirect()->route('employee.e-leave.request')->with('status','Leave request is approved');
                    }
	        	    else 
	        	    {
		               return redirect()->route('employee.e-leave.request')->with('status','You already approved this leave');
	        	    }
                } else {
                    Log::debug('Report To Level != 1'); // admin?
                    if($leave_request_approval == 0) {
                        Log::debug('Leave request approval == 0');
                        return redirect()->route('employee.e-leave.request')->with('status','You are not level one report to');
                    } else {
                        Log::debug('Leave request approval != 0');
	        		    LeaveRequest::find($id)->update(array('status' => 'approved'));      //then update leave request status = new
                        $leaveTotalDays = LeaveRequest::select('applied_days')->where('id', $id )->get();                       
                        $leaveRequestData = $request->validate([]);
        
                        $leaveRequestData['leave_request_id'] = $request->id;
                        $leaveRequestData['approved_by_emp_id'] = $report_to_emp_id;
                        $leaveRequestData = new LeaveRequestApproval($leaveRequestData);  
                        Log::debug('leaveRequestData');
                        Log::debug($leaveRequestData);
                        $employee = Employee::find($report_to_emp_id);
                        $leave_approval = $employee->leave_request_approvals()->save($leaveRequestData);
            
                        // $leave_request_approval = LeaveRequestApproval::where('leave_request_id', $id)->first();
                        $leave_request_approval = LeaveRequestApproval::where('leave_request_id', $id)
                            ->orderby('created_at', 'desc')->first();
                        
                        // send leave request email notification
                        self::sendLeaveRequestApprovalNotification($leave_request_approval,$emp_id);
                        Log::debug('Leave request is approved');
                        return redirect()->route('employee.e-leave.request')->with('status','Leave request is approved');
                    }
                }
            }
            else
            {
                Log::debug('Multiple approval levels required != 1');
                LeaveRequest::find($id)->update(array('status' => 'approved'));
                $leaveTotalDays = LeaveRequest::select('applied_days')->where('id', $id )->get();
                $leaveRquestData = $request->validate([
                ]);
        
                $leaveRequestData['leave_request_id'] =$request->id;
                $leaveRequestData['approved_by_emp_id'] = $report_to_emp_id;

                $leaveRequestData = new LeaveRequestApproval($leaveRequestData);
                Log::debug('leaveRequestData');
                Log::debug($leaveRequestData);
                $employee = Employee::find($report_to_emp_id);
                $leave_approval = $employee->leave_request_approvals()->save($leaveRequestData);
                $leave_request_approval = LeaveRequestApproval::where('leave_request_id', $id)
                    ->orderby('created_at', 'desc')->first();
                
                // send leave request email notification
                self::sendLeaveRequestApprovalNotification($leave_request_approval, $emp_id);
                Log::debug('Leave request is approved');
                return redirect()->route('employee.e-leave.request')->with('status','Leave request is approved');
            } 
        }
        else 
        {
            return redirect()->route('employee.e-leave.request')->with('status', 'Unable to approve leave request.');
        }
    }

    public function postDisapproved(Request $request) 
    {    
        Log::debug('Reject Leave');
        $id = $request->input('id');     
        $emp_id = $request->input('emp_id');    
        $leave_type_id = $request->input('leave_type_id');   
        $total_days =$request->input('total_days');
        $user = Auth::user();
        $report_to_emp_id = $user->employee->id;

        $multiple_approval_levels_required =LTAppliedRule::where('rule','multiple_approval_levels_needed')   //to get multiple_approval_levels_required
            ->where('leave_type_id',$leave_type_id)
            ->count();

//         $employee_report_to_level = EmployeeReportTo::select('report_to_level')  //to check employee report to level = 1 
//             ->where('report_to_emp_id','=',$report_to_emp_id)
//             ->where('emp_id','=',$emp_id)  
//             ->where ('report_to_level','=','1')
//             ->get();  

        $leave_request_approval = LeaveRequestApproval::where('leave_request_id','=',$id) //check leave_request id in leave request approval
            ->count(); 

        $leave_status =LeaveRequest::select('status')
           ->where('id',$id)   //to get leave request status
           ->where('status','new')
           ->count();
        
        $report_to_level = EmployeeReportTo::select('report_to_level')  //to check employee report to level = 1 
           ->where('report_to_emp_id','=',$report_to_emp_id)
           ->where('emp_id','=',$emp_id) 
           ->where('report_to_level','1') 
           ->count(); 
       
        Log::debug('Leave Request ID: '.$id);
        Log::debug('Employee ID: '.$emp_id);
        Log::debug('Report To ID: '.$report_to_emp_id);
        Log::debug('Multiple approval levels required: '.$multiple_approval_levels_required);
        Log::debug('Leave request approval: '.$leave_request_approval);
        Log::debug('Leave Status: '.$leave_status);
        Log::debug('Report To Level: '.$report_to_level);
        
        if ($leave_status == 1) {
            Log::debug('Leave Status == 1');
            
            if ($multiple_approval_levels_required == 1) {
                Log::debug('Multiple approval levels required == 1');
	            
	            if ($report_to_level == 1) {
	                Log::debug('Report To Level == 1');
	                
		            if($leave_request_approval == 0) {
		                Log::debug('Leave request approval == 0');
		                
                        $leaveAllocationApprovalData = LeaveAllocation::select ('spent_days')
                            ->where('emp_id',$emp_id)
                            ->where('leave_type_id',$leave_type_id)->first()->spent_days;
            
                        $leaveAllocationData = number_format($leaveAllocationApprovalData,1);
                        $total_days =number_format($total_days,1);
                        $leaveAllocationDataEntry = $leaveAllocationData - $total_days;

                        LeaveRequest::where('id',$id)
                            ->update(array('status' => 'rejected'));
                        
                        $leaveTotalDays = LeaveRequest::select('applied_days')
                            ->where('id', $id )
                            ->get();

                        $spent_days_allocation = LeaveAllocation::where('emp_id',$emp_id)
                            ->where('leave_type_id',$leave_type_id)
                            ->update(array('spent_days'=>$leaveAllocationDataEntry));
            
                        $leave_request_rejected = LeaveRequest::where('id', $id)->first();
                        
                        // send leave request email notification
                        self::sendLeaveRequestRejectedNotification($leave_request_rejected, $emp_id);
                        Log::debug('Leave request is rejected by level one report to.');
                        
                        return redirect()->route('employee.e-leave.request')->with('status','Leave request is rejected.');
                    }
	        	    else 
	        	    {
                        return redirect()->route('employee.e-leave.request')->with('status','You already rejected this request');
	        	    }
                }
                else {
                    Log::debug('Report To Level != 1');
                    
                    if($leave_request_approval == 0) {
		                Log::debug('Leave request approval == 0');
                    
                        return redirect()->route('employee.e-leave.request')->with('status','You are not level one report to.');  
                    }
                    else {
                        Log::debug('Leave request approval != 0');
                        
                        $leaveAllocationApprovalData = LeaveAllocation::select ('spent_days')
                            ->where('emp_id',$emp_id)
                            ->where('leave_type_id',$leave_type_id)->first()->spent_days;
            
                        $leaveAllocationData = number_format($leaveAllocationApprovalData,1);
                        $total_days =number_format($total_days,1);
                        $leaveAllocationDataEntry = $leaveAllocationData - $total_days;

                        LeaveRequest::where('id',$id)
                            ->update(array('status' => 'rejected'));
                        
                        $leaveTotalDays = LeaveRequest::select('applied_days')
                            ->where('id', $id )
                            ->get();

                        $spent_days_allocation = LeaveAllocation::where('emp_id',$emp_id)
                            ->where('leave_type_id',$leave_type_id)
                            ->update(array('spent_days'=>$leaveAllocationDataEntry));
            
                        $leave_request_rejected = LeaveRequest::where('id', $id)->first();
                        
                        // send leave request email notification
                        self::sendLeaveRequestRejectedNotification($leave_request_rejected, $emp_id);
                        Log::debug('Leave request id rejected by level two report to.');
                
                        return redirect()->route('employee.e-leave.request')->with('status','Leave request is rejected');
                    }
                }
            }
            else {
                Log::debug('Multiple approval levels required != 1');
                
            	$leaveAllocationApprovalData = LeaveAllocation::select ('spent_days')
                    ->where('emp_id',$emp_id)
                    ->where('leave_type_id',$leave_type_id)->first()->spent_days;
    
                $leaveAllocationData = number_format($leaveAllocationApprovalData,1);
                $total_days =number_format($total_days,1);
                $leaveAllocationDataEntry = $leaveAllocationData - $total_days;

                LeaveRequest::where('id',$id)
                    ->update(array('status' => 'rejected'));
                
                $leaveTotalDays = LeaveRequest::select('applied_days')
                    ->where('id', $id )
                    ->get();

                $spent_days_allocation = LeaveAllocation::where('emp_id',$emp_id)
                    ->where('leave_type_id',$leave_type_id)
                    ->update(array('spent_days'=>$leaveAllocationDataEntry));

                $leave_request_rejected = LeaveRequest::where('id', $id)->first();
                
                // send leave request email notification
                self::sendLeaveRequestRejectedNotification($leave_request_rejected, $emp_id);
                Log::debug('Leave request is rejected.');
                
                return redirect()->route('employee.e-leave.request')->with('status','Leave request is rejected');
            } 
        }
        else 
        {
            return redirect()->route('employee.e-leave.request')->with('status', 'Leave Request Cant Be Reject');
        }
    }

    public function sendLeaveRequestNotification(LeaveRequest $leave_request) 
    {
        $user = Auth::user();
        $to_recipients = array();
        $cc_recipients = array();
        $bcc_recipients = array();
        array_push($cc_recipients, $user->email);
        array_push($bcc_recipients, config('logging.developer'));
        
        Log::debug('Multi Approval: Employee apply leave, send email notification to level one report to');
        Log::debug('Employee ID: '.$user->employee->id);
        $report_to_level_one = EmployeeReportTo::where('emp_id', $user->employee->id)
            ->join('employees', 'employees.id', '=', 'employee_report_to.report_to_emp_id')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->where('employee_report_to.report_to_level', '1')
            ->where('employee_report_to.deleted_at', null)
            ->select('users.email')
            ->first();
        
        Log::debug($report_to_level_one->email);
        Log::debug($user->email);
        Log::debug(config('logging.developer'));
        
        if($report_to_level_one != null) {
            array_push($to_recipients, $report_to_level_one->email);
            
            Log::debug($to_recipients);
            Log::debug($cc_recipients);
            Log::debug($bcc_recipients);
            
            \Mail::to($to_recipients) //($report_to_level_one->email)
            ->cc($cc_recipients)
            ->bcc($bcc_recipients)
            ->send(new LeaveRequestMail($leave_request));
        }
    }
    
    public function sendLeaveRequestNonMultipleNotification(LeaveRequest $leave_request) 
    {
        Log::debug('Employee apply leave, send email notification to level one report to');
        Log::debug('Employee ID: '.Auth::user()->employee->id);
        
        $to_recipients = array();
        $cc_recipients = array();
        $bcc_recipients = array();
        array_push($cc_recipients, Auth::user()->email);
        array_push($bcc_recipients, config('logging.developer'));
        
        $report_to = EmployeeReportTo::where('emp_id', Auth::user()->employee->id)
            ->join('employees', 'employees.id', '=', 'employee_report_to.report_to_emp_id')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->where('employee_report_to.deleted_at', null)
            ->select('users.email')
            ->get();
        Log::debug($report_to);
        
        if ($report_to != null) {
            array_push($to_recipients, $report_to->email);
        }
        
        Log::debug($to_recipients);
        Log::debug($cc_recipients);
        Log::debug($bcc_recipients);
        
        \Mail::to($to_recipients)
            ->cc($cc_recipients)
            ->bcc($bcc_recipients)
            ->send(new LeaveRequestMail($leave_request));
    }

    public function sendLeaveRequestApprovalFirstApproverNotification(LeaveRequestApproval $leave_request_approval, $emp_id) 
    {
        $to_recipients = array();
        $cc_recipients = array();
        $bcc_recipients = array();
        array_push($bcc_recipients, config('logging.developer'));
        
        //send email to second approver 
        $report_to = EmployeeReportTo::where('emp_id', $emp_id)
            ->join('employees', 'employees.id', '=', 'employee_report_to.report_to_emp_id')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->where('report_to_level', '2')
            ->where('employee_report_to.deleted_at', null)
            ->select('users.email')
            ->first();
        Log::debug($report_to);
        
        if ($report_to != null) {
            array_push($to_recipients, $report_to->email);
        }

        Log::debug('>>>>>>>>>>>> ');
        //find employee
        $employees = EmployeeReportTo::select('users.email')
            ->join('employees', 'employees.id', '=', 'employee_report_to.emp_id')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->where('emp_id', $emp_id)
            ->first();
            Log::debug('******* ');
        if ($employees != null) {
            array_push($cc_recipients, $employees->email);
        }

        Log::debug($to_recipients);
        Log::debug($cc_recipients);
        Log::debug($bcc_recipients);
        
        \Mail::to($to_recipients)
            ->cc($cc_recipients)
            ->bcc($bcc_recipients)
            ->send(new LeaveApprovalFirstApproverMail($leave_request_approval));
    }

    public function sendLeaveRequestRejectedNotification(LeaveRequest $leave_request_rejected, $emp_id) 
    {
        $to_recipients = array();
        $bcc_recipients = array();
        array_push($bcc_recipients, config('logging.developer'));
        
        //find employee
        $employees = EmployeeReportTo::select('users.email')
            ->join('employees', 'employees.id', '=', 'employee_report_to.emp_id')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->where('emp_id', $emp_id)
            ->first();
        
        if ($employees != null) {
            array_push($to_recipients, $employees->email);
            
            \Mail::to($to_recipients)
                ->bcc($bcc_recipients)
                ->send(new LeaveRejectedMail($leave_request_rejected));
        }
    }
    
    public function sendLeaveRequestRejectedByFirstApproverNotification(LeaveRequest $leave_request_rejected, $emp_id) 
    {
        $to_recipients = array();
        $bcc_recipients = array();
        array_push($bcc_recipients, config('logging.developer'));

        //find employee
        $employees = EmployeeReportTo::select('users.email')
            ->join('employees', 'employees.id', '=', 'employee_report_to.emp_id')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->where('emp_id', $emp_id)
            ->first();
        
        if ($employees != null) {
            array_push($to_recipients, $employees->email);
            
            \Mail::to($to_recipients)
                ->bcc($bcc_recipients)
                ->send(new LeaveRejectedFirstApproverMail($leave_request_rejected));
        }
    }

    public function sendLeaveRequestApprovalNotification(LeaveRequestApproval $leave_request_approval, $emp_id) 
    {
        $to_recipients = array();
        $bcc_recipients = array();
        array_push($bcc_recipients, config('logging.developer'));

        //find employee
        $employees = EmployeeReportTo::select('users.email')
            ->join('employees', 'employees.id', '=', 'employee_report_to.emp_id')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->where('emp_id', $emp_id)
            ->first();
        
        if ($employees != null) {
            array_push($to_recipients, $employees->email);
            
            \Mail::to($to_recipients)
                ->bcc($bcc_recipients)
                ->send(new LeaveApprovalMail($leave_request_approval));
        }
    }
}
    