<?php
namespace App\Http\Controllers\Payroll;

use App\Company;
use App\CostCentre;
use App\Employee;
use App\EmployeeReportTo;
use App\LeaveAllocation;
use App\PayrollMaster;
use App\PayrollProcessedLeaveAttendance;
use App\PayrollTrx;
use App\PayrollTrxDeduction;
use App\Enums\PayrollAdditionDeductionEnum;
use App\Enums\PayrollPeriodEnum;
use App\Enums\PayrollStatus;
use App\Helpers\DateHelper;
use App\Helpers\GenerateReportsHelper;
use App\Helpers\PayrollHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PayrollRequest;
use App\Repositories\Repository;
use App\Repositories\Employee\EmployeeRepository;
use App\Repositories\Employee\EmployeeReportToRepository;
use App\Repositories\Payroll\AdditionRepository;
use App\Repositories\Payroll\DeductionRepository;
use App\Repositories\Payroll\EisRepository;
use App\Repositories\Payroll\EpfRepository;
use App\Repositories\Payroll\PayrollTrxAdditionRepository;
use App\Repositories\Payroll\PayrollTrxDeductionRepository;
use App\Repositories\Payroll\PayrollTrxRepository;
use App\Repositories\Payroll\PcbRepository;
use App\Repositories\Payroll\SocsoRepository;
use App\Services\PayrollService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PDF;
use App\Repositories\Payroll\ReportRepository;
use App\EmployeeJob;
use App\Addition;
use App\Deduction;
use App\Helpers\AccessControllHelper;
use App\PayrollTrxAddition;
use App\EmployeeWorkingDay;
use App\EmployeeClockInOutRecord;
use App\Enums\AttendanceEnum;
use App\LeaveRequest;
use App\Http\Requests\PayslipRequest;
use App\Mail\NewPayrollNotificationMail;
use Exception;

class PayrollController extends Controller
{
    protected $payrollMaster;
    protected $payrollService;
    protected $epfRepository;
    protected $eisRepository;
    protected $socsoRepository;
    protected $pcbRepository;
    protected $payrollTrxRepository;
    protected $additionRepository;
    protected $deductionRepository;
    protected $payrollTrx;
    protected $company;
    protected $employeeReportToRepository;
    protected $employeeRepository;
    protected $payrollTrxAdditionRepository;
    protected $payrollTrxDeductionRepository;
    protected $reportRepository;

    public function __construct(PayrollMaster $payrollMaster, PayrollService $payrollService, EpfRepository $epfRepository, EisRepository $eisRepository, 
        SocsoRepository $socsoRepository, PcbRepository $pcbRepository, PayrollTrxRepository $payrollTrxRepository, AdditionRepository $additionRepository,
        DeductionRepository $deductionRepository, PayrollTrxRepository $payrollTrx, Company $company,
        EmployeeReportToRepository $employeeReportToRepository, EmployeeRepository $employeeRepository, PayrollTrxAdditionRepository $payrollTrxAdditionRepository,
        PayrollTrxDeductionRepository $payrollTrxDeductionRepository, ReportRepository $reportRepository)
    {
        $this->middleware('auth');
        // set the model
        $this->payrollMaster = new Repository($payrollMaster);
        $this->payrollService = $payrollService;
        $this->epfRepository = $epfRepository;
        $this->eisRepository = $eisRepository;
        $this->socsoRepository = $socsoRepository;
        $this->pcbRepository = $pcbRepository;
        $this->payrollTrxRepository = $payrollTrxRepository;
        $this->additionRepository = $additionRepository;
        $this->deductionRepository = $deductionRepository;
        $this->payrollTrx = $payrollTrx;
        $this->company = $company;
        $this->employeeReportToRepository = $employeeReportToRepository;
        $this->employeeRepository = $employeeRepository;
        $this->payrollTrxAdditionRepository = $payrollTrxAdditionRepository;
        $this->payrollTrxDeductionRepository = $payrollTrxDeductionRepository;
        $this->reportRepository = $reportRepository;
    }

    // Payroll listing
    public function index()
    {
        //check if user has admin or hr-exec role or kpi proposer
        AccessControllHelper::hasPayrollAccess();
        
        //get company information based on user login
        $company = GenerateReportsHelper::getUserLogonCompanyInformation();
        $payroll = [];
        if($company != null){
            $payroll = PayrollMaster::leftJoin('companies', 'companies.id', '=', 'payroll_master.company_id')
            ->join('users', 'users.id', '=', 'payroll_master.created_by')
            ->where('company_id', $company->id)
            ->orderBy('year_month','desc')
            ->select('payroll_master.*','companies.name','users.name')->get();
        }

        $period = PayrollPeriodEnum::choices();
        return view('pages.payroll.index', compact('payroll', 'period'));
    }

    // Add payroll form
    public function create()
    {
        //check if user has admin role
        AccessControllHelper::hasAnyRoles('admin');
        
        $period = PayrollPeriodEnum::choices();
        return view('pages.payroll.create', ['period' => $period]);
    }

    // Add payroll
    public function store(PayrollRequest $request)
    {
        AccessControllHelper::hasAnyRoles('admin');
        $currentUser = Auth::id();
        // validate and store
        $validated = $request->validated();
        $data = array(
            'year_month' => $validated['year_month'].'-01', 
            'period' => $validated['period'] 
        );

        $payrollPeriodExists = $this->payrollService->isPayrollExists($data);
        if ($payrollPeriodExists) {
            $msg = 'Payroll '.DateHelper::dateWithFormat($validated['year_month'], 'Y-m').' '.PayrollPeriodEnum::getDescription($validated['period']).'  has already been created.';
            return redirect($request->server('HTTP_REFERER'))->with(['customMsg'=> $msg]);//withErrors([$msg]);
        }

        // Process
        DB::beginTransaction();
        
        // Step 1. get company
        $company = GenerateReportsHelper::getUserLogonCompanyInformation();
        
        // Step 2. Create payroll.
        $payroll = new PayrollMaster();
        $payroll->company_id = $company->id;
        $payroll->year_month = $validated['year_month'] . '-01';
        $payroll->period = $validated['period'];
        $payroll->created_by = $currentUser; 
        $payroll->updated_by = $currentUser; 
        $payroll->start_date = $this->payrollService->getPayrollStartDate($data);
        $payroll->end_date = date('Y-m-d', strtotime('-1 days'));
        $payroll->status = 0;
        $payroll->save();

        // Step 3. Find all employees under this company, generate all employees' payroll trx.
        $payrollId = $payroll->id;
        $firstDayOfMonth = date('Y-m-d', strtotime($validated['year_month'] . '-01'));
            
        $employeeList = Employee::leftJoin('employee_jobs', 'employee_jobs.emp_id', '=', 'employees.id')->where([
            ['company_id', $company->id]
        ])
        ->where(function ($query) use ($firstDayOfMonth) {
            // Either default or month/year greater or same
            $query->whereNull('employees.resignation_date')->orWhere('employees.resignation_date', '>=', $firstDayOfMonth);
        })
        ->where(function ($query) use ($firstDayOfMonth) {
            // Either default or month/year greater or same
            $query->where('employee_jobs.id', DB::raw('(SELECT id FROM employee_jobs WHERE emp_id = employees.id AND start_date <= "' . $firstDayOfMonth . '" ORDER BY start_date DESC LIMIT 1)'));
        })
        ->select('employees.*', 'employee_jobs.id as ejId')
        ->orderby('employees.code', 'ASC')
        ->get();
//      dd($employeeList);
        foreach ($employeeList as $employee) {
            // Step 4. Find employee's payroll's required info.
            $employeeJob = EmployeeJob::find($employee->ejId);
            $costCentre = CostCentre::where('id', $employeeJob->cost_centre_id)->get();
            $basicSalary = 0;
            $seniorityPay = 0;
            $remuneration = 0;
            if($payroll->period == PayrollPeriodEnum::END_MONTH) {
                $basicSalary = PayrollHelper::calculateSalary($employeeJob, $validated['year_month']);
                $seniorityPay = PayrollHelper::calculateSeniorityPay($employee, $validated['year_month'], $costCentre);
                $remuneration = $basicSalary + $seniorityPay;
            }

            // Step 5. Create payroll trx.
            $payrollTrxData = array();
            $payrollTrxData['payroll_master_id'] = $payrollId;
            $payrollTrxData['employee_id'] = $employee->id;
            $payrollTrxData['employee_epf'] = 0;
            $payrollTrxData['employee_eis'] = 0;
            $payrollTrxData['employee_socso'] = 0;
            $payrollTrxData['employee_pcb'] = 0;
            $payrollTrxData['employer_epf'] = 0;
            $payrollTrxData['employer_eis'] =  0;
            $payrollTrxData['employer_socso'] = 0;
            $payrollTrxData['seniority_pay'] = $seniorityPay;
            $payrollTrxData['basic_salary'] = $basicSalary;
            $payrollTrxData['take_home_pay'] = 0;
            $payrollTrxData['gross_pay'] = 0;
            $payrollTrxData['created_by'] = $currentUser;
            $payrollTrxData['updated_by'] = $currentUser;
//                 dd($payrollTrxData);
            $payrollTrxId = $this->payrollTrxRepository->create($payrollTrxData)->id;
// dd($employee);
            
            //Addition and deduction are for end month
            // Step 6. Insert addition & deduction.
            if($payroll->period == PayrollPeriodEnum::END_MONTH) {
                self::storeAdditionDeduction($company, $employee, $validated['year_month'], $payrollTrxId);
                
                $minOtHour = PayrollHelper::getMinOtHour($employee);
                $payrollBackDatePeriod = PayrollHelper::getPayrollBackDatePeriod($employee);
                $processedStartDate = DateHelper::getPastNMonthDate($payroll->end_date, $payrollBackDatePeriod) ." 00:00:00";
                $processedEndDate = $payroll->end_date." 23:59:59";
                $contributionData = self::calculateUpdateAddition($employee, $payroll, $payrollTrxId, $validated['year_month'], $minOtHour, $processedStartDate, $processedEndDate);
                $dedcution = self::calculateUpdateDeduction($payrollTrxId, $employee, $processedStartDate, $processedEndDate, $validated['year_month']);
                
                // update epf, eis, socso, pcb
                if($employee->epf_category != null) {
                    $epfFilter = array();
    //                 $epfFilter['age'] = PayrollHelper::getAge($employee->dob);
    //                 $epfFilter['nationality'] = $employee->nationality;
                    $epfFilter['salary'] = $remuneration + $contributionData['epf'];
                    $epfFilter['category'] = $employee->epf_category;
                    $epf = $this->epfRepository->findByFilter($epfFilter);
                }
                
                $eisCategory = PayrollHelper::getEisCategory($employee);//PayrollHelper::getAge($employee->dob), $employee->nationality);
                if ($eisCategory > 0) {
                    $eis = $this->eisRepository->findByCategorySalary($eisCategory, $remuneration + $contributionData['eis']);
                }
                
                if ($employee->socso_category != null) {
                    $socso = $this->socsoRepository->findByCategorySalary($employee->socso_category, $remuneration + $contributionData['socso']);
                }
                
                if($employee->tax_no != null && $employee->pcb_group != null){
                    $pcbFilter = array();
                    $pcbFilter['salary'] = $remuneration + $contributionData['pcb'];
                    $pcbFilter['pcbGroup'] = $employee->pcb_group;
                    $pcbFilter['noOfChildren'] = $employee->total_children;
                    $pcb = $this->pcbRepository->findByFilter($pcbFilter);
                }
                
                $storeData = [];
                $storeData['employee_epf'] = isset($epf->employee) ? $epf->employee : 0;
                $storeData['employee_eis'] = isset($eis->employee) ? $eis->employee : 0;
                $storeData['employee_socso'] = isset($socso->employee) ? $socso->employee : 0;
                $storeData['employee_pcb'] = isset($pcb->amount) ? $pcb->amount : 0;
                $storeData['employer_epf'] = isset($epf->employer) ? $epf->employer : 0;
                $storeData['employer_eis'] = isset($eis->employer) ? $eis->employer : 0;
                $storeData['employer_socso'] = isset($socso->employer) ? $socso->employer : 0;
                $storeData['total_addition'] = $contributionData['addition'];
                $storeData['total_deduction'] = $dedcution;
                $storeData['gross_pay'] = $basicSalary + $seniorityPay;
                $storeData['take_home_pay'] = $basicSalary + $seniorityPay + $contributionData['addition'] - $dedcution - $storeData['employee_epf'] - $storeData['employee_eis'] - $storeData['employee_socso'] - $storeData['employee_pcb'];
                PayrollTrx::where('id', $payrollTrxId)->update($storeData);
            }
        }
        
        DB::commit();
        
        // send email notification to kpi proposer
        $kpiProposers = EmployeeReportTo::join('employees', 'employees.id', '=', 'employee_report_to.report_to_emp_id')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->where('kpi_proposer',1)
            ->get();
        
        try {
            $emailData = array();
            foreach($kpiProposers as $kpiProposer){
                $emailData['name'] = $kpiProposer['name'];
                $emailData['payrollMonth'] = PayrollPeriodEnum::getDescription($validated['period']).' '.DateHelper::dateWithFormat($validated['year_month'], 'M-Y');
                
                //send email
                Mail::to($kpiProposer['email'])
                ->bcc(env('BCC_EMAIL'))
                ->send(new NewPayrollNotificationMail($emailData));
            }
            
        } catch (Exception $ex) {
            Log::error($ex);
        } 
        
        return redirect('/payroll')->with('success', 'Payroll month has been added');
    }

    // Show payroll month
    public function show($id)
    {
        /*
         * HR Admin - show all
         * HR Exec by security group
         * KPI Proposer 
         */
        AccessControllHelper::hasPayrollAccess();
        $isHrAdmin = AccessControllHelper::hasHrAdminRole(); 
        $currentUser = Employee::where('user_id',Auth::id())->first();
        $securityGroupAccess = AccessControllHelper::getSecurityGroupAccess();
        $payroll = PayrollMaster::where('id', $id)->first();
        $firstDayOfMonth = date('Y-m-d', strtotime($payroll->year_month. '-01'));
            
        $list = PayrollTrx::join('payroll_master as pm', 'pm.id', '=', 'payroll_trx.payroll_master_id')
            ->join('employees as e', 'e.id', '=', 'payroll_trx.employee_id')
            ->join('users as u', 'u.id', '=', 'e.user_id') 
            ->join('employee_jobs as ej', function ($join) {
                $join->on('ej.emp_id', '=', 'e.id');
            })
            ->join('employee_positions as ep', 'ep.id', '=', 'ej.emp_mainposition_id')
            ->leftjoin('employee_report_to as ert', 'ert.emp_id', '=', 'e.id')
            ->select('payroll_trx.*', 'pm.company_id as company_id', 'pm.year_month', 'pm.period', 'pm.status', 'e.id as employee_id', 'e.code as employee_code', 'u.name','ep.name as position', 'payroll_trx.basic_salary as bs', 'payroll_trx.seniority_pay as is', 'payroll_trx.note as remark', DB::raw('
                    (SELECT start_date FROM employee_jobs WHERE emp_id = ej.id ORDER BY id ASC LIMIT 1) as joined_date,
                    (payroll_trx.basic_salary + payroll_trx.seniority_pay) as cb,
                    (payroll_trx.basic_salary + payroll_trx.seniority_pay) as contract_base,
                    payroll_trx.take_home_pay as thp,
                    ROUND((payroll_trx.kpi * payroll_trx.bonus),2) as total_bonus,
                    YEAR(CURDATE()) - YEAR(e.dob) as age
                '))
            ->where(function ($query) use ($id) {
                if ($id) {
                    $query->where('payroll_trx.payroll_master_id', $id);
                }
            })
            ->where(function ($query) use ($firstDayOfMonth) {
                // Either default or month/year greater or same
                $query->where('ej.id', DB::raw('(SELECT id FROM employee_jobs WHERE emp_id = e.id AND start_date <= "' . $firstDayOfMonth . '" ORDER BY start_date DESC LIMIT 1)'));
            })
            ->where(function($query) use($currentUser, $securityGroupAccess, $isHrAdmin){
                if(!$isHrAdmin) {
                    $query->whereIn('e.main_security_group_id', $securityGroupAccess)
                    ->orWhere([
                        ['ert.report_to_emp_id', $currentUser->id],
                        ['ert.kpi_proposer', 1]
                    ]);
                }
            })
            ->whereNull('ert.deleted_at')
            ->distinct()
            ->orderby('payroll_trx.id', 'ASC')
            ->get();

        // Condition
        // if(!count($list)) return redirect('/payroll')->with('error', 'Payroll not found.');

        $title = PayrollPeriodEnum::getDescription($payroll->period) .' '.DateHelper::dateWithFormat(@$payroll->year_month, 'M-Y');
        return view('pages.payroll.show', compact('id', 'title', 'payroll', 'list'));
    }

    public function updatePayrollStatus(Request $request, $id)
    {
        //check if user has admin role
        AccessControllHelper::hasAnyRoles('admin');
        
        $info = PayrollMaster::where([
            [
                'id', $id
            ]
        ])->get();
//             dd($info);
        if (! @$info) {
            return redirect($request->server('HTTP_REFERER'))->with('error', 'Payroll not found.');
        }

        DB::beginTransaction();
        $storeData = [];
        $storeData['status'] = $request['status'];
        $storeData['updated_by'] = auth()->user()->id;
        PayrollMaster::find($id)->update($storeData);
        DB::commit();

        return redirect($request->server('HTTP_REFERER'))->with('success', 'Payroll month '.DateHelper::dateWithFormat($info[0]->year_month, 'Y-m').' is '. strtolower(new PayrollStatus($request['status'])).'.');
    }
    
    public function showPayrollTrx(Request $request, $id)
    {
        /*
         * 1. Basic info
         * 2. Remarks
         * 3. Basic Earnings - hide if not end month
         * 4. KPI - hide if not end month
         * 5. Additions - hide if not end month
         * 6. Deductions - hide if not end month
         * 7. Employee Contribution
         * 8. Employer Contribution
         * 9. Summary
         * 10. Commision - show if mid month
         * 11. Bonus - show if add month
         */
        
        AccessControllHelper::hasPayrollAccess();
        $info = $this->payrollTrx->find($id)->first();
        $payrollMaster = PayrollMaster::where('id', $info->payroll_master_id)->first();
        $currentUser = Employee::where('user_id', Auth::id())->first();
        $company = GenerateReportsHelper::getUserLogonCompanyInformation();
        $info->isKpiProposer = $this->employeeReportToRepository->isKpiProposer($info->employee_id, $currentUser->id);
//         dd($info,$info->employee_id,$info->isKpiProposer,$currentUser);
        $employee = $this->employeeRepository->find($info->employee_id)->first();
        $payrollTrxAdditionList = $this->payrollTrxAdditionRepository->findByPayrollTrxId($id);
        $payrollTrxDeductionList = $this->payrollTrxDeductionRepository->findByPayrollTrxId($id);
        $additions = Addition::where([
            ['company_id', $company->id],
            ['status', 'Active']
        ])->get();
        $deductions = Deduction::where([
            ['company_id', $company->id],
            ['status', 'Active']
        ])->get();
        $title = PayrollPeriodEnum::getDescription($payrollMaster->period) .' '.DateHelper::dateWithFormat(@$payrollMaster->year_month, 'M-Y');
        $payrollId = $info->payroll_master_id;
        $addMonthBonus = $payrollMaster->period == PayrollPeriodEnum::ADD_MONTH ? $info->gross_pay : 0;
        $commission = $payrollMaster->period == PayrollPeriodEnum::MID_MONTH ? $info->gross_pay : 0;
        $addition_days_array = PayrollHelper::payroll_addition_with_days();
        $addition_hours_array = PayrollHelper::payroll_addition_with_hours();
        $deduction_days_array = PayrollHelper::payroll_deduction_with_days();
        $year_month = $info->year_month;
        $total_days = cal_days_in_month(CAL_GREGORIAN, substr($year_month,5,2), substr($year_month,0,4));
        $start_date = $year_month.'-01';
        $joined_date = $info->joined_date;
        $annualLeaves = array();
        $unpaidLeaves = array();
        $carryForwardLeaves = array();
        $ph = array();
        $rd = array();
        $od = array();
        $ot = array();
        $unpaidLeaves = array();
        
        if(strtotime($joined_date) > strtotime($start_date)) {
            $different_of_dates = date_diff(date_create($start_date), date_create($joined_date));
            $total_days = $total_days - $different_of_dates->format('%a')+1;
        }
        
        foreach($payrollTrxAdditionList as $payrollTrxAddition){
            switch ($payrollTrxAddition['code']) {
                case "ALP":
                    $annualLeaves = PayrollProcessedLeaveAttendance::join('leave_requests as lr', 'lr.id', '=', 'payroll_processed_leave_attendance.leave_request_id')
                        ->where('payroll_trx_addition_id', $payrollTrxAddition['id'])
                        ->select('payroll_processed_leave_attendance.*', 'lr.*')
                        ->get();
                    break;
                    
                case "CFLP":
                    $carryForwardLeaves = PayrollProcessedLeaveAttendance::join('leave_requests as lr', 'lr.id', '=', 'payroll_processed_leave_attendance.leave_request_id')
                        ->where('payroll_trx_addition_id', $payrollTrxAddition['id'])
                        ->select('payroll_processed_leave_attendance.*', 'lr.*')
                        ->get();
                    break;
                    
                case "PH":
                    $ph = PayrollProcessedLeaveAttendance::join('employee_attendances as ea', 'ea.id', '=', 'payroll_processed_leave_attendance.employee_attendance_id')
                        ->where('payroll_trx_addition_id', $payrollTrxAddition['id'])
                        ->select('payroll_processed_leave_attendance.*', 'ea.*')
                        ->get();
                    break;
                
                case "RD":
                    $rd = PayrollProcessedLeaveAttendance::join('employee_attendances as ea', 'ea.id', '=', 'payroll_processed_leave_attendance.employee_attendance_id')
                        ->where('payroll_trx_addition_id', $payrollTrxAddition['id'])
                        ->select('payroll_processed_leave_attendance.*', 'ea.*')
                        ->get();
                    break;
                    
                case "OD":
                    $od = PayrollProcessedLeaveAttendance::join('employee_attendances as ea', 'ea.id', '=', 'payroll_processed_leave_attendance.employee_attendance_id')
                        ->where('payroll_trx_addition_id', $payrollTrxAddition['id'])
                        ->select('payroll_processed_leave_attendance.*', 'ea.*')
                        ->get();
                    break;
                    
                case "OT":
                    $ot = PayrollProcessedLeaveAttendance::join('employee_attendances as ea', 'ea.id', '=', 'payroll_processed_leave_attendance.employee_attendance_id')
                    ->where('payroll_trx_addition_id', $payrollTrxAddition['id'])
                    ->select('payroll_processed_leave_attendance.*', 'ea.*')
                    ->get();
                    break;
            }
        }
        
        foreach($payrollTrxDeductionList as $payrollTrxDeduction){
            if($payrollTrxDeduction['code'] == 'UL') {
                $unpaid = PayrollProcessedLeaveAttendance::join('leave_requests as lr', 'lr.id', '=', 'payroll_processed_leave_attendance.leave_request_id')
                    ->where('payroll_trx_addition_id', $payrollTrxAddition['id'])
                    ->select('payroll_processed_leave_attendance.*', 'lr.*')
                    ->get();
                
                $absent = PayrollProcessedLeaveAttendance::join('employee_attendances as ea', 'ea.id', '=', 'payroll_processed_leave_attendance.employee_attendance_id')
                    ->where('payroll_trx_addition_id', $payrollTrxAddition['id'])
                    ->select('payroll_processed_leave_attendance.*', 'ea.*')
                    ->get();
                
                $unpaidLeaves = $unpaid->merge($absent);
            }
        }
       
//         dd($employee);
//         dd($payrollTrxAdditionList);
        return view('pages.payroll.show-payroll-trx', compact('id', 'payrollId', 'title', 'additions', 'deductions', 'payrollTrxAdditionList', 
            'payrollTrxDeductionList', 'info', 'company', 'employee', 'addition_days_array', 'addition_hours_array', 'deduction_days_array', 
            'year_month', 'total_days', 'unpaidLeaves', 'annualLeaves', 'carryForwardLeaves', 'ot', 'ph', 'rd', 'od', 'payrollMaster', 'addMonthBonus', 'commission'));
    }
    
    public function updatePayrollTrx(Request $request, $id)
    {
        AccessControllHelper::hasPayrollAccess();
//         dd($request->all());
        $info = $this->payrollTrx->find($id)->first();
        
        if(!@$info) {
            return redirect($request->server('HTTP_REFERER'))->with('error', 'Payroll not found.');
        } else if($info->status == 1) {
            return redirect($request->server('HTTP_REFERER'))->with('error', 'Payroll is locked.');
        }
        
        $employeeContribution = 0;
        $totalEpf = 0;
        $totalEis = 0;
        $totalSocso = 0;
        $totalPcb = 0;
        $storeData = [];
        $epfFilter = array();
        $pcbFilter = array();
//         dd($info);
        
        $payrollTrxAdditions = $this->payrollTrxAdditionRepository->findByPayrollTrxId($id);
        foreach($payrollTrxAdditions as $payrollTrxAddition){
            if (strpos($payrollTrxAddition['statutory'], 'EPF') !== false) {
                $totalEpf += $payrollTrxAddition['amount'];
            }
            
            if (strpos($payrollTrxAddition['statutory'], 'EIS') !== false) {
                $totalEis += $payrollTrxAddition['amount'];
            }
            
            if (strpos($payrollTrxAddition['statutory'], 'SOCSO') !== false) {
                $totalSocso += $payrollTrxAddition['amount'];
            }
            
            if (strpos($payrollTrxAddition['statutory'], 'PCB') !== false) {
                $totalPcb += $payrollTrxAddition['amount'];
            }
        }
        
        //update KPI
        DB::beginTransaction();
        
        if(isset($request['saveKpi'])){
            AccessControllHelper::isKpiProposer();
            
            //recalculate gross pay, epf, eis, socso, pcb, thp
            $storeData['kpi'] = $request['kpi'];
            $storeData['bonus'] = $request['bonus'];
            $storeData['gross_pay'] = $info->gross_pay + ($request['bonus'] * $request['kpi']);
            
            if($info->epf_category != null){
//                 $epfFilter['age'] = PayrollHelper::getAge($info->dob);
//                 $epfFilter['nationality'] = $info->nationality;
                $epfFilter['salary'] = $storeData['gross_pay'] + $totalEpf;
                $epfFilter['category'] = $info->epf_category;
                $epf = $this->epfRepository->findByFilter($epfFilter);
            }
            
            $eisCategory = PayrollHelper::getEisCategory($info);//PayrollHelper::getAge($info->dob), $info->nationality);
            if ($eisCategory > 0) {
                $eis = $this->eisRepository->findByCategorySalary($eisCategory, $storeData['gross_pay'] + $totalEis);
            }
            
            if($info->socso_category != null){
                $socso = $this->socsoRepository->findByCategorySalary($info->socso_category, $storeData['gross_pay'] + $totalSocso);
            }
            
            if($info->tax_no != null && $info->pcb_group != null){
                $pcbFilter['salary'] = $storeData['gross_pay'] + $totalPcb;
                $pcbFilter['pcbGroup'] = $info->pcb_group;
                $pcbFilter['noOfChildren'] = $info->total_children;
                $pcb = $this->pcbRepository->findByFilter($pcbFilter);
            }
            
            $storeData['employee_epf'] = isset($epf->employee) ? $epf->employee : 0;
            $storeData['employee_eis'] = isset($eis->employee) ? $eis->employee : 0;
            $storeData['employee_socso'] = isset($socso->employee) ? $socso->employee : 0;
            $storeData['employee_pcb'] = isset($pcb->amount) ? $pcb->amount : 0;
            $storeData['employer_epf'] = isset($epf->employer) ? $epf->employer : 0;
            $storeData['employer_eis'] = isset($eis->employer) ? $eis->employer : 0;
            $storeData['employer_socso'] = isset($socso->employer) ? $socso->employer : 0;
            $employeeContribution = $storeData['employee_epf'] + $storeData['employee_eis'] + $storeData['employee_socso'] + $storeData['employee_pcb'];
            $storeData['take_home_pay'] = $storeData['gross_pay'] + $info->total_addition - $info->total_deduction - $employeeContribution;
            $storeData['updated_by'] = auth()->user()->id;

            PayrollTrx::find($id)->update($storeData);
        }else{
            $securityGroupAccess = AccessControllHelper::getSecurityGroupAccess();
            
            if (in_array($info->main_security_group_id, $securityGroupAccess)){
                $this->payrollTrxAdditionRepository->updateMulitpleData($request->input());
                $this->payrollTrxDeductionRepository->updateMulitpleData($request->input());
                $totalAddition = DB::table("payroll_trx_addition")->where('payroll_trx_id',$id)->sum('amount');
                $totalDeduction = DB::table("payroll_trx_deduction")->where('payroll_trx_id',$id)->sum('amount');
                
                if($info->epf_category != null){
//                     $epfFilter['age'] = PayrollHelper::getAge($info->dob);
//                     $epfFilter['nationality'] = $info->nationality;
                    $epfFilter['salary'] = $info->gross_pay + $totalEpf;
                    $epfFilter['category'] = $info->epf_category;
                    $epf = $this->epfRepository->findByFilter($epfFilter);
                }
                
                $eisCategory = PayrollHelper::getEisCategory($info);//PayrollHelper::getAge($info->dob), $info->nationality);
                if ($eisCategory > 0) {
                    $eis = $this->eisRepository->findByCategorySalary($eisCategory, $info->gross_pay + $totalEis);
                }
                
                if($info->socso_category != null){
                    $socso = $this->socsoRepository->findByCategorySalary($info->socso_category, $info->gross_pay + $totalSocso);
                }
                
                if($info->tax_no != null && $info->pcb_group != null){
                    $pcbFilter['salary'] = $info->gross_pay + $totalPcb;
                    $pcbFilter['pcbGroup'] = $info->pcb_group;
                    $pcbFilter['noOfChildren'] = $info->total_children;
                    $pcb = $this->pcbRepository->findByFilter($pcbFilter);
                }
                
                $storeData['employee_epf'] = isset($epf->employee) ? $epf->employee : 0;
                $storeData['employee_eis'] = isset($eis->employee) ? $eis->employee : 0;
                $storeData['employee_socso'] = isset($socso->employee) ? $socso->employee : 0;
                $storeData['employee_pcb'] = isset($pcb->amount) ? $pcb->amount : 0;
                $storeData['employer_epf'] = isset($epf->employer) ? $epf->employer : 0;
                $storeData['employer_eis'] = isset($eis->employer) ? $eis->employer : 0;
                $storeData['employer_socso'] = isset($socso->employer) ? $socso->employer : 0;
                $storeData['total_addition'] = $totalAddition;
                $storeData['total_deduction'] = $totalDeduction;
                $employeeContribution = $storeData['employee_epf'] + $storeData['employee_eis'] + $storeData['employee_socso'] + $storeData['employee_pcb'];
                $storeData['take_home_pay'] = $storeData['gross_pay'] + $info->total_addition - $info->total_deduction - $employeeContribution;
                $storeData['updated_by'] = auth()->user()->id;
                
                PayrollTrx::find($id)->update($storeData);
                //             dd($info);
                $next = $this->payrollTrx->findNext($id, $info->payroll_master_id);
                $save_n_next = $request->input('save_n_next');
            } else {
                return redirect($request->server('HTTP_REFERER'))->with('error', 'You are not allowed to update this payroll.');
            }
        }
        DB::commit();
      
        if(!@$save_n_next) {
            return redirect($request->server('HTTP_REFERER'))->with('success', 'Successfully updated payroll.');
        }
        
        return (@$next)? redirect()->route('payroll.trx.show', ['id'=>$next->id])->with('success', 'Successfully updated payroll.') : redirect('/payroll/'.$request->input('payroll_id'))->with('success', 'All employees updated.');
    }
    
    //Reports
    //Generate Report
    public function generateReport(Request $request)
    {
//         dd($request);
        $year = "";
        $month = "";
        
        $this->validate($request, [
            'reportName' => 'required'
        ]);
        
        $reportName = $request->input('reportName');
        $date = $request->input('yearMonth');
        $periods = $request->input('selectPeriod');
        
        if($request->input('selectCostCentres') != 0){
            $filter = "costcentres";
            $value = $request->input('selectCostCentres');
            
        }else if($request->input('selectDepartments') != 0){
            $filter = "departments";
            $value = $request->input('selectDepartments');
            
        }else if($request->input('selectBranches') != 0){
            $filter = "branches";
            $value = $request->input('selectBranches');
            
        }else if($request->input('selectPositions') != 0){
            $filter = "positions";
            $value = $request->input('selectPositions');
            
        }else{
            $filter = "none";
            $value = 0;
        }
        
        //checking yearMonth
        if(empty($yearMonth)){
            $year = date("Y");
            $month;
        }
        
        $filterOption = GenerateReportsHelper::getFilterKey($filter,$value);
        return $this->generate($reportName,$periods,$date,$filterOption);
    }
    
    private function generate($reportName,$periods,$date,$filter){
        $company = GenerateReportsHelper::getUserLogonCompanyInformation();
        $filter = [
            'year_month'      => $date,
            'type'      => $reportName,
        ];
        
        switch ($reportName) {
            case '1':
                $filter['groupby'] = ['JM_department.id'];
                $data = $this->reportRepository->findByCompanyIdAndFilter($company->id, $filter);
                $pdf = PDF::loadView('pages/payroll/payrollreport/doc1',
                    [
                        'data' => $data,
                    ])->setOrientation('landscape');
                    
                    $pdf->setTemporaryFolder(storage_path("temp"));
                    // download pdf
                    return $pdf->download('doc1.pdf');
                    break;
            case '2':
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$date,1,$filter);
                $pdf = PDF::loadView('pages/payroll/payrollreport/doc2',
                    [
                        'data' => $arr['data'] ,
                        'empData' => $arr['data1'] ,
                    ])->setOrientation('landscape');
                    
                    $pdf->setTemporaryFolder(storage_path("temp"));
                    // download pdf
                    return $pdf->download('doc2.pdf');
                    break;
            case '3':
                $arr = GenerateReportsHelper::generateBean($reportName,$periods,$date,1,$filter);
                $pdf = PDF::loadView('pages/payroll/payrollreport/doc3',
                    [
                        'data' => $arr['data'] ,
                        'empData' => $arr['data1'] ,
                    ])->setOrientation('landscape');
                    
                    $pdf->setTemporaryFolder(storage_path("temp"));
                    // download pdf
                    return $pdf->download('doc3.pdf');
                    break;
            default:
                $error = 'Unknown type of report selected. Kindly contact admin to get more details.';
                break;
        }
    }
    
    private function generateReportHtml()
    {
        $css = '
                <style media="print">
                    .text-right { text-align: right; }
                    .text-left { text-align: left; }
                    .text-center { text-align: center; }
            
                    .w-1p { width: 1%; }
                    .w-2p { width: 2%; }
                    .w-3p { width: 3%; }
                    .w-4p { width: 4%; }
                    .w-5p { width: 5%; }
                    .w-10p { width: 10%; }
                    .w-15p { width: 15%; }
                    .w-20p { width: 20%; }
                    .w-25p { width: 25%; }
                    .w-30p { width: 30%; }
                    .w-35p { width: 35%; }
                    .w-40p { width: 40%; }
                    .w-45p { width: 45%; }
                    .w-50p { width: 50%; }
                    .w-55p { width: 55%; }
                    .w-60p { width: 60%; }
                    .w-65p { width: 65%; }
                    .w-70p { width: 70%; }
                    .w-75p { width: 75%; }
                    .w-80p { width: 80%; }
                    .w-85p { width: 85%; }
                    .w-90p { width: 90%; }
                    .w-95p { width: 95%; }
                    .w-100p { width: 100%; }
            
                    .black-top-border { border-top: 1px solid black; }
                    .black-bottom-border { border-bottom: 1px solid black; }
                    .bold { font-weight: bold; }
                </style>
            
                <link rel="stylesheet" media="print" href="..." />
        ';
        
        switch ($document_type) {
            case '1':
            case 1:
            case '2':
            case 2:
                $period = $extra['period'];
                
                $header = '
                    <table style="font-weight:bold; margin-bottom:10px;" cellspacing="0" cellpadding="1">
                        <tbody>
                            <tr>
                                <td class="w-15p">COMPANY</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">'.$company->name.' ('.$company->registration_number.')</td>
                                <td class="text-right">Date: '.date_format(date_create(date('Y-m-d')), 'd-M-Y (D) H:i A').' Page: {PAGENO} </td>
                            </tr>
                            <tr>
                                <td class="w-15p">FORMELY KNOWN</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">NO CUKAI PENDAPATAN: C2304727002</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">REPORT TITLE</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">MONTH-TO-DATE PAYROLL SUMMARY</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">SORTED BY</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">DEPARTMENT</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">PERIOD</td>
                                <td>:</td>
                                <td class="w-40p">'.$period.'</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                ';
                
                $sum = [];
                $content = '';
                foreach ($list as $key => $info) {
                    $display_name = ($document_type == 1)? $info->department : $info->department.'-'.$info->cost_center;
                    
                    $content .= '
                        <tr>
                            <td colspan="15">
                                GROUP : '.$display_name.'
                            </td>
                        </tr>
                        <tr>
                            <td colspan="15">Total Employee : '.$info->total_employee.'</td>
                        </tr>
                        <tr>
                            <td>Sub Total</td>
                            <td class="text-center">'.$info->total_basic_salary.'</td>
                            <td class="text-center">'.$info->total_unpaid_leave.'</td>
                            <td class="text-center">'.$info->total_overtime.'</td>
                            <td class="text-center">'.$info->total_bonus.'</td>
                            <td class="text-center">'.$info->total_other_addition.'</td>
                            <td class="text-center">'.$info->total_gross_pay.'</td>
                            <td class="text-center">'.$info->total_employee_epf.'</td>
                            <td class="text-center">'.$info->total_employee_socso.'</td>
                            <td class="text-center">'.$info->total_employee_pcb.'</td>
                            <td class="text-center">'.$info->total_other_deduction.'</td>
                            <td class="text-center">'.$info->total_net_pay.'</td>
                            <td class="text-center">'.$info->total_employer_epf.'</td>
                            <td class="text-center">'.$info->total_employer_socso.'</td>
                            <td class="text-center">'.$info->total_employer_levy.'</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-center">'.$info->total_seniority_pay.'</td>
                            <td class="text-center">'.$info->total_default_addition.'</td>
                            <td class="text-center">'.$info->total_shift.'</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">'.$info->total_employee_vol.'</td>
                            <td class="text-center">'.$info->total_employee_eis.'</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">'.$info->total_employer_vol.'</td>
                            <td class="text-center">'.$info->total_employer_eis.'</td>
                            <td></td>
                        </tr>
                    ';
                    
                    if(count($info->additional_list) > 0) {
                        $row = '';
                        foreach($info->additional_list as $key => $additional) {
                            if(!@$additional->code) break;
                            $row .= $additional->code.'..........'.$additional->amount.'&nbsp; &nbsp; &nbsp; ';
                            if(@$sum[$additional->code]) {
                                $sum[$additional->code] = $sum[$additional->code] + $additional->amount;
                            } else {
                                $sum[$additional->code] = $additional->amount;
                            }
                        }
                        $content .= '
                            <tr>
                                <td colspan="15">'.$row.'</td>
                            </tr>
                        ';
                    }
                }
                
                $final_addition_list = '';
                if(count($sum) > 0) {
                    foreach($sum as $key => $value) {
                        $final_addition_list .= $key.'..........'.$value.'&nbsp; &nbsp; &nbsp; ';
                    }
                }
                
                $body = '
                    <table style="font-size: 10px; text-align: left;" cellspacing="0" cellpadding="1">
                        <thead>
                            <tr>
                                <th class="text-left black-top-border w-30p">DEPARTMENT</th>
                                <th class="text-right black-top-border w-5p">BASIC</th>
                                <th class="text-right black-top-border w-5p">NPL</th>
                                <th class="text-right black-top-border w-5p">OT</th>
                                <th class="text-right black-top-border w-5p">BONUS</th>
                                <th class="text-right black-top-border w-5p">OTHERS</th>
                                <th class="text-right black-top-border w-5p">GROSS</th>
                                <th class="text-right black-top-border w-5p">E\'EPF</th>
                                <th class="text-right black-top-border w-5p">E\'SOC</th>
                                <th class="text-right black-top-border w-5p">E\'TAX</th>
                                <th class="text-right black-top-border w-5p">OTHERS</th>
                                <th class="text-right black-top-border w-5p">NETTPAY</th>
                                <th class="text-right black-top-border w-5p">R\'EPF</th>
                                <th class="text-right black-top-border w-5p">R\'SOC</th>
                                <th class="text-right black-top-border w-5p">R\'LEVY</th>
                            </tr>
                            <tr>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border">S\'PAY</th>
                                <th class="text-right black-bottom-border">ADDPAY</th>
                                <th class="text-right black-bottom-border">SHIFT</th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border">PAY</th>
                                <th class="text-right black-bottom-border">E\'VOL</th>
                                <th class="text-right black-bottom-border">E\'EIS</th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border"></th>
                                <th class="text-right black-bottom-border">R\'VOL</th>
                                <th class="text-right black-bottom-border">R\'EIS</th>
                                <th class="black-bottom-border"></th>
                            </tr>
                        </thead>
                        <tbody>
                            '.$content.'
                            <tr>
                                <td class="black-top-border bold">Grand Total</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_basic_salary'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_unpaid_leave'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_overtime'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_bonus'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_other_addition'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_gross_pay'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_employee_epf'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_employee_socso'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_employee_pcb'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_other_deduction'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_net_pay'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_employer_epf'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_employer_socso'),2,'.','').'</td>
                                <td class="black-top-border text-center bold">'.number_format($list->sum('total_employer_levy'),2,'.','').'</td>
                            </tr>
                            <tr>
                                <td class="black-bottom-border "></td>
                                <td class="black-bottom-border text-center bold">'.number_format($list->sum('total_seniority_pay'),2,'.','').'</td>
                                <td class="black-bottom-border text-center bold">'.number_format($list->sum('total_default_addition'),2,'.','').'</td>
                                <td class="black-bottom-border text-center bold">'.number_format($list->sum('total_shift'),2,'.','').'</td>
                                <td class="black-bottom-border "></td>
                                <td class="black-bottom-border "></td>
                                <td class="black-bottom-border "></td>
                                <td class="black-bottom-border text-center bold">'.number_format($list->sum('total_employee_vol'),2,'.','').'</td>
                                <td class="black-bottom-border text-center bold">'.number_format($list->sum('total_employee_eis'),2,'.','').'</td>
                                <td class="black-bottom-border "></td>
                                <td class="black-bottom-border "></td>
                                <td class="black-bottom-border "></td>
                                <td class="black-bottom-border text-center bold">'.number_format($list->sum('total_employer_vol'),2,'.','').'</td>
                                <td class="black-bottom-border text-center bold">'.number_format($list->sum('total_employer_eis'),2,'.','').'</td>
                                <td class="black-bottom-border "></td>
                            </tr>
                            <tr>
                                <td colspan="15">'.$final_addition_list.'</td>
                            </tr>
                        </tbody>
                    </table>
                ';
                
                $pdf_format = [
                    'format'        => 'A4-L', // L: Landscape, Default: Portrait
                    'margin_top'    => 40,
                ];
                break;
            case '3':
            case 3:
                $filter_by = $extra['filter_by'];
                $final_net_pay = 0;
                
                $sub_header = '
                    <table class="w-100p">
                        <tr>
                            <td class="text-center w-60p"> <h2> SUPPLIER PAYMENT FORM </h2> </td>
                            <td align="right" class="w-30p"> Date: ..................... </td>
                        </tr>
                    </table>
                    <table class="w-100p">
                        <tr>
                            <td class="w-20p"> Name </td>
                            <td class="w-40p"> : .......................................... <td>
                            <td class="w-40p"></td>
                        </tr>
                        <tr>
                            <td class="w-20p"> Department </td>
                            <td class="w-40p"> : .......................................... <td>
                            <td align="right" class="w-40p"> Date of Proposal : ..................... </td>
                        </tr>
                    </table>
                ';
                $sub_footer = '
                    <table class="w-100p">
                        <tr>
                            <td align="center" class="w-25p"> Prepared by </td>
                            <td align="center" class="w-25p"> Approved by </td>
                            <td align="center" class="w-25p"> Aknowledge by </td>
                            <td align="center" class="w-25p"> Issued by </td>
                        </tr>
                        <tr>
                            <td align="center" style="padding-top: 50px;"> ------------------------------- </td>
                            <td align="center" style="padding-top: 50px;"> ------------------------------- </td>
                            <td align="center" style="padding-top: 50px;"> ------------------------------- </td>
                            <td align="center" style="padding-top: 50px;"> ------------------------------- </td>
                        </tr>
                        <tr>
                            <td align="center" style="font-size: 12px;"></td>
                            <td align="center" style="font-size: 12px;"> Manager </td>
                            <td align="center" style="font-size: 12px;"> General Manager </td>
                            <td align="center" style="font-size: 12px;"> Finance and Accounting </td>
                        </tr>
                    </table>
                ';
                
                $content = '
                    <table class="w-100p" style="border-collapse:collapse;" border="1">
                        <tr>
                            <td align="center" class="w-80p"> Detail Information </td>
                            <td align="center" class="w-20p"> Total </td>
                        </tr>
                        <tr>
                            <td> '.$company->name.' </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td> &nbsp; </td>
                            <td> </td>
                        </tr>
                ';
                foreach ($list as $key => $info) {
                    $i = $key + 1;
                    
                    switch ($filter_by) {
                        case 'category':
                            $display_name = $info->cost_center;
                            break;
                        case 'department':
                            $display_name = $info->department;
                            break;
                        default:
                            $display_name = $info->department.' - '.$info->cost_center;
                            break;
                    }
                    
                    $content .= '
                        <tr>
                            <td> '.$i.') '.$display_name.' </td>
                            <td align="center"> '.$info->total_net_pay.' </td>
                        </tr>
                    ';
                    
                    $final_net_pay = $final_net_pay + $info->total_net_pay;
                    
                }
                $content .= '
                        <tr>
                            <td> &nbsp; </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td align="center"> TOTAL </td>
                            <td align="center"> '.$final_net_pay.' </td>
                        </tr>
                    </table>
                ';
                
                $body = $sub_header.$content.$sub_footer;
                break;
            case '4':
            case 4:
                $period = $extra['period'];
                $final_employee = 0;
                $final_net_pay = 0;
                $final_average_net_pay = 0;
                
                $content = '
                    <table class="w-100p">
                        <tr>
                            <td style="font-weight:bold;"> Company : '.$company->name.' </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;"> Report : Department \'s Salary </td>
                        </tr>
                        <tr>
                            <td style="font-weight:bold;"> Period : '.$period.' </td>
                        </tr>
                    </table>
                    <table class="w-100p" style="border-collapse:collapse;" border="1">
                        <tr>
                            <td align="center" class="w-40p"> Department </td>
                            <td align="center" class="w-20p"> Total Employee </td>
                            <td align="center" class="w-20p"> Total Net Pay </td>
                            <td align="center" class="w-20p"> Average Net Pay </td>
                        </tr>
                ';
                foreach ($list as $key => $info) {
                    $content .= '
                        <tr>
                            <td align="left"> '.$info->department.' </td>
                            <td align="center"> '.$info->total_employee.' </td>
                            <td align="center"> '.$info->total_net_pay.' </td>
                            <td align="center"> '.$info->average_net_pay.' </td>
                        </tr>
                    ';
                    
                    $final_employee = $final_employee + $info->total_employee;
                    $final_net_pay = $final_net_pay + $info->total_net_pay;
                    $final_average_net_pay = $final_average_net_pay + $info->average_net_pay;
                }
                $content .= '
                        <tr>
                            <td align="left"> &nbsp; &nbsp; &nbsp; TOTAL RM : </td>
                            <td align="center"> '.$final_employee.' </td>
                            <td align="center"> '.$final_net_pay.' </td>
                            <td align="center"> '.$final_average_net_pay.' </td>
                        </tr>
                    </table>
                    <table class="w-100p" style="padding-top:50px;">
                        <tr>
                            <td class="w-30p"> Prepared by : ......................................... </td>
                            <td class="w-30p"> Checked by : ......................................... </td>
                            <td class="w-30p"> Signed by : ......................................... </td>
                            <td class="w-10p"> </td>
                        </tr>
                        <tr>
                            <td align="center"> (Amanda Chong) </td>
                            <td align="center"> (Crandice Liu) </td>
                            <td align="center"> (CEO William Fang) </td>
                        </tr>
                    </table>
                ';
                
                $body = $content;
                $pdf_format = [
                    'format'        => 'A4-L',
                ];
                break;
            case '5':
            case 5:
                $period = $extra['period'];
                
                $header = '
                    <table style="font-weight:bold; margin-bottom:10px;" cellspacing="0" cellpadding="1">
                        <tbody>
                            <tr>
                                <td class="w-15p">COMPANY</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">'.$company->name.' ('.$company->registration_number.')</td>
                                <td class="text-right">Date: '.date_format(date_create(date('Y-m-d')), 'd-M-Y (D) H:i A').' Page: {PAGENO} </td>
                            </tr>
                            <tr>
                                <td class="w-15p">FORMELY KNOWN</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">NO CUKAI PENDAPATAN: C2304727002</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">REPORT TITLE</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">BANK CREDITING REPORT</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">SORTED BY</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">BANK CODE + BRANCH</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">PERIOD</td>
                                <td>:</td>
                                <td class="w-40p">'.$period.'</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                ';
                
                $content = '';
                $bank = '';
                $count = 1;
                $net_pay = 0;
                foreach ($list as $key => $info) {
                    if(!@$bank || $bank != $info->bank) {
                        $bank = $info->bank;
                        $content .= '
                            <tr>
                                <th align="left" colspan="2"> BANK : '.$bank.' Branch()</th>
                            </tr>
                            <tr>
                                <th align="left" colspan="2"> Address : </th>
                            </tr>
                        ';
                    }
                    $content .= '
                        <tr>
                            <td align="left"> '.$info->code.' </td>
                            <td align="left"> '.$info->full_name.' </td>
                            <td align="center"> </td>
                            <td align="center"> '.$info->ic_no.' </td>
                            <td align="center"> </td>
                            <td align="center"> '.$info->account_number.' </td>
                            <td align="right"> '.number_format($info->net_pay,2).' </td>
                        </tr>
                    ';
                    
                    if(@$bank != @$list[$key+1]->bank && @$bank) {
                        $content .= '
                            <tr>
                                <td class="black-top-border bold" align="left" colspan="5"> Total Employee : '.$count.' </td>
                                <td class="black-top-border bold" align="left"> Sub Total </td>
                                <td class="black-top-border bold" align="right"> '.number_format($net_pay,2).' </td>
                            </tr>
                        ';
                        $count = 1;
                        $net_pay = 0;
                        continue;
                    }
                    
                    $count++;
                    $net_pay+=$info->net_pay;
                }
                
                $content .= '
                    <tr>
                        <td class="black-top-border black-bottom-border bold" align="left" colspan="5"> Total Employee : '.$list->count().' </td>
                        <td class="black-top-border black-bottom-border bold" align="left"> Grand Total </td>
                        <td class="black-top-border black-bottom-border bold" align="right"> '.number_format($list->sum('net_pay'),2).' </td>
                    </tr>
                ';
                
                $body = '
                    <table class="w-95p" style="font-size: 12px; text-align: left;" cellspacing="0" cellpadding="1">
                        <thead>
                            <tr>
                                <th align="left" class="black-top-border black-bottom-border w-10p">EMPL NO.</th>
                                <th align="left" class="black-top-border black-bottom-border w-40p">EMPLOYEE NAME</th>
                                <th align="center" class="black-top-border black-bottom-border w-10p">OLD I/C NO</th>
                                <th align="center" class="black-top-border black-bottom-border w-10p">NEW I/C NO</th>
                                <th align="center" class="black-top-border black-bottom-border w-10p">PASSPORT NO</th>
                                <th align="center" class="black-top-border black-bottom-border w-10p">BANK A/C #</th>
                                <th align="right" class="black-top-border black-bottom-border w-10p">NET PAY (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            '.$content.'
                        </tbody>
                    </table>
                ';
                
                $pdf_format = [
                    'format'        => 'A4-L', // L: Landscape, Default: Portrait
                    'margin_top'    => 40,
                ];
                break;
            case '6':
            case 6:
                $content = '';
                $total_employee = 0;
                $total_gross_pay = 0;
                $total_net_pay = 0;
                
                foreach ($list as $key => $info) {
                    $content .= '
                        <br/>
                        <table class="w-100p" style="border-collapse:collapse;" border="1">
                            <tr>
                                <td align="left" style="width:125px; font-weight:bold;  "> '.$info->company_name.' </td>
                                <td align="right" style="width:300px;"> '.$info->total_employee.' </td>
                            </tr>
                            <tr>
                                <td align="left" style="width:125px;"> Gross Pay: </td>
                                <td align="right" style="width:300px;"> RM'.number_format($info->total_gross_pay,2).' </td>
                            </tr>
                            <tr>
                                <td align="left" style="width:125px;"> Nett Pay: </td>
                                <td align="right" style="width:300px;"> RM'.number_format($info->total_net_pay,2).' </td>
                            </tr>
                        </table>
                    ';
                    
                    $total_employee = $total_employee + $info->total_employee;
                    $total_gross_pay = $total_gross_pay + $info->total_gross_pay;
                    $total_net_pay = $total_net_pay + $info->total_net_pay;
                }
                
                $content .= '
                    <br/>
                    <table class="w-100p" style="border-collapse:collapse;" border="1">
                        <tr>
                            <td align="left" style="width:125px; font-weight:bold;  "> TOTAL P1 </td>
                            <td align="right" style="width:300px;"> '.$total_employee.' </td>
                        </tr>
                        <tr>
                            <td align="left" style="width:125px;"> Gross Pay: </td>
                            <td align="right" style="width:300px;"> RM'.number_format($total_gross_pay,2).' </td>
                        </tr>
                        <tr>
                            <td align="left" style="width:125px;"> Nett Pay: </td>
                            <td align="right" style="width:300px;"> RM'.number_format($total_net_pay,2).' </td>
                        </tr>
                    </table>
                ';
                
                $body = '
                    <table class="w-100p" cellspacing="0" cellpadding="1">
                        <thead>
                            <tr>
                                <th class="w-20p"> </th>
                                <th align="left" class="w-60p" style="text-decoration:underline;"> 2018 MAY PART 1 </th>
                                <th class="w-20p"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> </td>
                                <td>
                                    '.$content.'
                                </td>
                                <td> </td>
                            </tr>
                        </tbody>
                    </table>
                ';
                
                break;
            case '7':
            case 7:
                $period = $extra['period'];
                
                $header = '
                    <table style="font-weight:bold; margin-bottom:10px;" cellspacing="0" cellpadding="1">
                        <tbody>
                            <tr>
                                <td class="w-15p">COMPANY</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">'.$company->name.' ('.$company->registration_number.')</td>
                                <td class="text-right">Date: '.date_format(date_create(date('Y-m-d')), 'd-M-Y (D) H:i A').' Page: {PAGENO} </td>
                            </tr>
                            <tr>
                                <td class="w-15p">FORMELY KNOWN</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">NO CUKAI PENDAPATAN: C2304727002</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">REPORT TITLE</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">MONTH-TO-DATE PAYROLL DETAIL</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">SORTED BY</td>
                                <td class="w-1p">:</td>
                                <td class="w-40p">DEPARTMENT</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="w-15p">PERIOD</td>
                                <td>:</td>
                                <td class="w-40p">'.$period.'</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                ';
                $content = '';
                $department = '';
                $unreset_count = 0;
                $count = 1;
                
                foreach ($list as $key => $info) {
                    
                    if(!@$department || $department != $info->department) {
                        $department = $info->department;
                        $content .= '
                            <tr>
                                <td style="font-weight:bold;" colspan="16"> GROUP : '.strtoupper($department).'</td>
                            </tr>
                        ';
                    }
                    $content .= '
                        <tr>
                            <td class="text-left">'.$info->code.'</td>
                            <td class="text-left">'.$info->full_name.'</td>
                            <td class="text-center">'.$info->total_basic_salary.'</td>
                            <td class="text-center">'.$info->total_unpaid_leave.'</td>
                            <td class="text-center">'.$info->total_overtime.'</td>
                            <td class="text-center">'.$info->total_bonus.'</td>
                            <td class="text-center">'.$info->total_other_addition.'</td>
                            <td class="text-center">'.$info->total_gross_pay.'</td>
                            <td class="text-center">'.$info->total_employee_epf.'</td>
                            <td class="text-center">'.$info->total_employee_socso.'</td>
                            <td class="text-center">'.$info->total_employee_pcb.'</td>
                            <td class="text-center">'.$info->total_other_deduction.'</td>
                            <td class="text-center">'.$info->total_net_pay.'</td>
                            <td class="text-center">'.$info->total_employer_epf.'</td>
                            <td class="text-center">'.$info->total_employer_socso.'</td>
                            <td class="text-center">'.$info->total_employer_levy.'</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="text-center">'.$info->total_seniority_pay.'</td>
                            <td class="text-center">'.$info->total_default_addition.'</td>
                            <td class="text-center">'.$info->total_shift.'</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">'.$info->total_employee_vol.'</td>
                            <td class="text-center">'.$info->total_employee_eis.'</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">'.$info->total_employer_vol.'</td>
                            <td class="text-center">'.$info->total_employer_eis.'</td>
                            <td></td>
                        </tr>
                    ';
                    
                    if(@$department != @$list[$key+1]->department && @$department) {
                        $content .= '
                            <tr>
                                <td align="left" colspan="2" class="bold"> Total Employee : '.$count.' </td>
                            </tr>
                            <tr>
                                <td class="black-top-border bold" align="left"> Sub Total </td>
                                <td class="black-top-border bold text-left"></td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_basic_salary'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_unpaid_leave'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_overtime'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_bonus'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_other_addition'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_gross_pay'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employee_epf'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employee_socso'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employee_pcb'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_other_deduction'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_net_pay'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employer_epf'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employer_socso'),2,'.','').'</td>
                                <td class="black-top-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employer_levy'),2,'.','').'</td>
                            </tr>
                            <tr>
                                <td class="black-bottom-border bold "></td>
                                <td class="black-bottom-border bold "></td>
                                <td class="black-bottom-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_seniority_pay'),2,'.','').'</td>
                                <td class="black-bottom-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_default_addition'),2,'.','').'</td>
                                <td class="black-bottom-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_shift'),2,'.','').'</td>
                                <td class="black-bottom-border bold "></td>
                                <td class="black-bottom-border bold "></td>
                                <td class="black-bottom-border bold "></td>
                                <td class="black-bottom-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employee_vol'),2,'.','').'</td>
                                <td class="black-bottom-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employee_eis'),2,'.','').'</td>
                                <td class="black-bottom-border bold "></td>
                                <td class="black-bottom-border bold "></td>
                                <td class="black-bottom-border bold "></td>
                                <td class="black-bottom-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employer_vol'),2,'.','').'</td>
                                <td class="black-bottom-border bold text-center">'.number_format($list->slice($unreset_count)->take($key+1)->sum('total_employer_eis'),2,'.','').'</td>
                                <td class="black-bottom-border bold "></td>
                            </tr>
                        ';
                        $count = 1;
                        $unreset_count = $key+1;
                        continue;
                    }
                    
                    $count++;
                }
                
                $content .= '
                    <tr>
                        <td align="left" colspan="2" class="bold"> Total Employee : '.$list->count().' </td>
                    </tr>
                    <tr>
                        <td class="black-top-border bold" align="left"> Grand Total </td>
                        <td class="black-top-border bold text-left"></td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_basic_salary'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_unpaid_leave'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_overtime'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_bonus'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_other_addition'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_gross_pay'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_employee_epf'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_employee_socso'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_employee_pcb'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_other_deduction'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_net_pay'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_employer_epf'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_employer_socso'),2,'.','').'</td>
                        <td class="black-top-border bold text-center">'.number_format($list->sum('total_employer_levy'),2,'.','').'</td>
                    </tr>
                    <tr>
                        <td class="black-bottom-border bold "></td>
                        <td class="black-bottom-border bold "></td>
                        <td class="black-bottom-border bold text-center">'.number_format($list->sum('total_seniority_pay'),2,'.','').'</td>
                        <td class="black-bottom-border bold text-center">'.number_format($list->sum('total_default_addition'),2,'.','').'</td>
                        <td class="black-bottom-border bold text-center">'.number_format($list->sum('total_shift'),2,'.','').'</td>
                        <td class="black-bottom-border bold "></td>
                        <td class="black-bottom-border bold "></td>
                        <td class="black-bottom-border bold "></td>
                        <td class="black-bottom-border bold text-center">'.number_format($list->sum('total_employee_vol'),2,'.','').'</td>
                        <td class="black-bottom-border bold text-center">'.number_format($list->sum('total_employee_eis'),2,'.','').'</td>
                        <td class="black-bottom-border bold "></td>
                        <td class="black-bottom-border bold "></td>
                        <td class="black-bottom-border bold "></td>
                        <td class="black-bottom-border bold text-center">'.number_format($list->sum('total_employer_vol'),2,'.','').'</td>
                        <td class="black-bottom-border bold text-center">'.number_format($list->sum('total_employer_eis'),2,'.','').'</td>
                        <td class="black-bottom-border bold "></td>
                    </tr>
                ';
                
                $body = '
                    <table style="font-size: 10px; text-align: left;" cellspacing="0" cellpadding="1">
                        <thead>
                            <tr>
                                <th class="text-left black-top-border w-10p">EMP NO.</th>
                                <th class="text-left black-top-border w-20p">EMPLOYEE NAME</th>
                                <th class="text-right black-top-border w-5p">BASIC</th>
                                <th class="text-right black-top-border w-5p">NPL</th>
                                <th class="text-right black-top-border w-5p">OT</th>
                                <th class="text-right black-top-border w-5p">BONUS</th>
                                <th class="text-right black-top-border w-5p">OTHERS</th>
                                <th class="text-right black-top-border w-5p">GROSS</th>
                                <th class="text-right black-top-border w-5p">E\'EPF</th>
                                <th class="text-right black-top-border w-5p">E\'SOC</th>
                                <th class="text-right black-top-border w-5p">E\'TAX</th>
                                <th class="text-right black-top-border w-5p">OTHERS</th>
                                <th class="text-right black-top-border w-5p">NETTPAY</th>
                                <th class="text-right black-top-border w-5p">R\'EPF</th>
                                <th class="text-right black-top-border w-5p">R\'SOC</th>
                                <th class="text-right black-top-border w-5p">R\'LEVY</th>
                            </tr>
                            <tr>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border">S\'PAY</th>
                                <th class="text-right black-bottom-border">ADDPAY</th>
                                <th class="text-right black-bottom-border">SHIFT</th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border">PAY</th>
                                <th class="text-right black-bottom-border">E\'VOL</th>
                                <th class="text-right black-bottom-border">E\'EIS</th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border"></th>
                                <th class="black-bottom-border"></th>
                                <th class="text-right black-bottom-border">R\'VOL</th>
                                <th class="text-right black-bottom-border">R\'EIS</th>
                                <th class="black-bottom-border"></th>
                            </tr>
                        </thead>
                        <tbody>
                            '.$content.'
                        </tbody>
                    </table>
                ';
                
                $pdf_format = [
                    'format'        => 'A4-L', // L: Landscape, Default: Portrait
                    'margin_top'    => 40,
                ];
                break;
            default:
                break;
        }
        
        return [
            'css'           => $css,
            'header'        => @$header,
            'footer'        => @$footer,
            'body'          => $body,
            'pdf_format'    => (@$pdf_format)?:[],
        ];
    }
    
    // Payslip
    // Download payslip form
    public function showPayslip()
    {
        $user = AccessControllHelper::getCurrentUserLogon();
        
        $payslips = PayrollTrx::leftJoin('payroll_master', 'payroll_master.id', '=', 'payroll_trx.payroll_master_id')
            ->where([
                ['payroll_trx.employee_id', $user->id],
                ['payroll_master.status', PayrollStatus::LOCKED]
            ])
            ->select('payroll_master.*','payroll_trx.*')
            ->get();

        return view('pages.payroll.payslip', ['payslips' => $payslips]);
    }
    
    public function downloadPayslip(Request $request, $id)
    {
        $currentUser = AccessControllHelper::getCurrentUserLogon();
        
        $payslip = PayrollTrx::leftJoin('payroll_master', 'payroll_master.id', '=', 'payroll_trx.payroll_master_id')
            ->join('companies', 'companies.id', '=', 'payroll_master.company_id')
            ->join('employees', 'employees.id', '=', 'payroll_trx.employee_id')
            ->join('users', 'users.id', '=', 'employees.user_id')
            ->where([
                ['payroll_trx.employee_id', $currentUser->id],
                ['payroll_trx.id', $id],
            ])
            ->select('payroll_master.*','payroll_trx.*', 'companies.name as company_name', 'employees.*', 'users.name',
                DB::raw('sum(payroll_trx.employee_epf) as employee_epf '),
                DB::raw('sum(payroll_trx.employee_eis) as employee_eis'),
                DB::raw('sum(payroll_trx.employee_socso) as employee_socso'),
                DB::raw('sum(payroll_trx.employee_pcb) as employee_pcb'),
                DB::raw('sum(payroll_trx.employer_epf) as employer_epf '),
                DB::raw('sum(payroll_trx.employer_eis) as employer_eis'),
                DB::raw('sum(payroll_trx.employer_socso) as employer_socso')
            )
            ->groupBy(DB::raw("payroll_trx.employee_id"))
            ->first();
            
        if (count($payslip) > 0) {
            $employeeBranch = PayrollHelper::getEmployeeBranch($currentUser, $payslip->year_month);
            $payslip->employeeBranch = $employeeBranch;
            $employeeBankAcc = PayrollHelper::getEmployeeBankAcc($currentUser);
            $payslip->employeeBank = @$employeeBankAcc->bank_code;
            $payslip->employeeBankAccNo = @$employeeBankAcc->acc_no;
            $employeeContributions = PayrollHelper::getEmployeeContributionYTD($currentUser, $payslip->year_month);
            $addition = $this->payrollTrxAdditionRepository->findByPayrollTrxId($payslip->id); 
            $deduction = $this->payrollTrxDeductionRepository->findByPayrollTrxId($payslip->id);
            $earnings = [];
            $earnings[] = [
                'name' => 'BASIC PAY',
                'amount' => number_format($payslip->basic_salary, 2),
                'amount_numeric' => $payslip->basic_salary
            ];
            
            $earnings[] = [
                'name' => 'SENIORITY PAY',
                'amount' => number_format($payslip->seniority_pay, 2),
                'amount_numeric' => $payslip->seniority_pay
            ];
            
            $earnings[] = [
                'name' => 'BONUS',
                'amount' => number_format($payslip->bonus * $payslip->kpi, 2),
                'amount_numeric' => $payslip->bonus * $payslip->kpi
            ];
            
            foreach($addition as $a){
                $earnings[] = [
                    'name' => $a->name,
                    'amount' => number_format($a->amount, 2),
                    'amount_numeric' => $a->amount
                ];
            }
            
            $deductions = [];
            $deductions[] = [
                'name' => 'EMPLOYEE EPF (KWSP)',
                'amount' => number_format($payslip->employee_epf, 2),
                'amount_numeric' => $payslip->employee_epf
            ];
            
            $deductions[] = [
                'name' => 'EMPLOYEE SOCSO (PERKESO)',
                'amount' => number_format($payslip->employee_socso, 2),
                'amount_numeric' => $payslip->employee_socso
            ];
            
            $deductions[] = [
                'name' => 'EMPLOYEE EIS',
                'amount' => number_format($payslip->employee_eis),
                'amount_numeric' => $payslip->employee_eis
            ];
            
            $deductions[] = [
                'name' => 'INCOME TAX PCB',
                'amount' => number_format($payslip->employee_pcb),
                'amount_numeric' => $payslip->employee_pcb
            ];
            
            foreach($deduction as $d){
                $deductions[] = [
                    'name' => $d->name,
                    'amount' => number_format($d->amount, 2),
                    'amount_numeric' => $d->amount
                ];
            }
            
            $payslip->extra_count = (count($earnings) > count($deductions))? count($earnings) : count($deductions);
            
            $totalEarnings = array_sum(array_column($earnings, 'amount_numeric'));
            $totalDeductions = array_sum(array_column($deductions, 'amount_numeric'));
            $nettPay = $totalEarnings - $totalDeductions;
            
            $annualLeaves = LeaveAllocation::where([
                ['leave_type_id', 1],
                ['emp_id', $currentUser->id],
                ['valid_until_date', '<=', $payslip->end_date]
            ])->whereYear('valid_until_date', substr($payslip->year_month,0,4))
            ->get();
            
            $sickLeaves = LeaveAllocation::where([
                ['leave_type_id', 7],
                ['emp_id', $currentUser->id],
                ['valid_until_date', '<=', $payslip->end_date]
            ])->whereYear('valid_until_date', substr($payslip->year_month,0,4))
            ->get();
            
            $leavesArray = [];
            $alTaken = 0;
            $alBalance = 0;
            if(count($annualLeaves) > 0){
                $alTaken = $annualLeaves['spent_days'];
                $alBalance = $annualLeaves['allocated_days'] - $annualLeaves['spent_days'];
            }
            
            $leave = [
                'name' => 'ANNUAL LEAVE',
                'taken' => $alTaken,
                'balance' => $alBalance
            ];
            $leavesArray[] = $leave;
            
            $slTaken = 0;
            $slBalance = 0;
            if(count($sickLeaves) > 0){
                $slTaken = $sickLeaves['spent_days'];
                $slBalance = $sickLeaves['allocated_days'] - $sickLeaves['spent_days'];
            }
            $leave = [
                'name' => 'SICK LEAVE',
                'taken' => $slTaken,
                'balance' => $slBalance
            ];
            $leavesArray[] = $leave;
            
            $payslip->leave = $leavesArray;
//             dd($employeeContributions);
            $pdf = PDF::loadView('pages/payroll/payslip/payslip',
                [
                    'info' => $payslip,
                    'addition' => $earnings,
                    'deduction' => $deductions,
                    'totalEarnings' => number_format($totalEarnings ,2),
                    'totalDeductions' => number_format($totalDeductions, 2),
                    'nettPay' => number_format($nettPay, 2),
                    'employeeContributions' => $employeeContributions->first()
                ])->setOrientation('landscape');
                
            $pdf->setTemporaryFolder(storage_path("temp"));
            // download pdf
            return $pdf->download('payslip.pdf');
            
        } else {
            $msg = 'Payslip is not ready.';
            return redirect($request->server('HTTP_REFERER'))->withErrors([$msg]);
        }
    }
    
    private function storeAdditionDeduction($company, $employee, $payrollMonth, $payrollTrxId)
    {
        $additionDeductionFilter = array();
        $additionDeductionFilter['companyId'] = $company->id;
        $additionDeductionFilter['isConfirmedEmployee'] = PayrollHelper::isConfirmedEmployee($employee, $payrollMonth);
        $additionDeductionFilter['costCentreId'] = $employee->cost_centre_id;
        $additionDeductionFilter['jobGradeId'] = $employee->emp_grade_id;
        $additionList = $this->additionRepository->findByFilter($additionDeductionFilter)->toArray();
        $deductionList = $this->deductionRepository->findByFilter($additionDeductionFilter)->toArray();
        $additionArray = [];
        if (count($additionList)) {
            foreach ($additionList as $addition) {
                $data = [
                    'payroll_trx_id' => $payrollTrxId,
                    'additions_id' => $addition['id'],
                    'amount' => $addition['amount']
                ];
                $additionArray[] = $data;
            }
            $this->payrollTrxAdditionRepository->storeArray($additionArray);
            
        }
        $deductionArray = [];
        if (count($deductionList)) {
            foreach ($deductionList as $deduction) {
                $data = [
                    'payroll_trx_id' => $payrollTrxId,
                    'deductions_id' => $deduction['id'],
                    'amount' => $deduction['amount']
                ];
                $deductionArray[] = $data;
            }
            $this->payrollTrxDeductionRepository->storeArray($deductionArray);
        }
    }
    
    private function calculateUpdateAddition($employee, $payroll, $payrollTrxId, $payrollMonth, $minOtHour, $processedStartDate, $processedEndDate)
    {
        /*
         * Update payroll_trx_addition and payroll_trx_deduction
         */
        $totalEpf = 0;
        $totalEis = 0;
        $totalSocso = 0;
        $totalPcb = 0;
        $totalAddition = 0;
        $data = array();
        
        $payrollTrxAdditionList = PayrollTrxAddition::join('additions', 'payroll_trx_addition.additions_id','=', 'additions.id')
        ->select('additions.*', 'payroll_trx_addition.*')
        ->where('payroll_trx_id',$payrollTrxId)
        ->get();
//         dd($payrollTrxAdditionList);
        foreach($payrollTrxAdditionList as $payrollTrxAddition) {
            /*
             * ALP, OT, PH,  CFLP, RD, OD
             */
            $updateData = [];
            $updateData['payroll_trx_id'] = $payrollTrxAddition['payroll_trx_id'];
            $updateData['additions_id'] = $payrollTrxAddition['additions_id'];
            $updateData['amount'] = $payrollTrxAddition['amount'];
            $updateData['days'] = $payrollTrxAddition['days'];
            $updateData['hours'] = $payrollTrxAddition['hours'];
            
            if($payrollTrxAddition['type'] == 'Custom'){
                if(in_array($payrollTrxAddition['code'], PayrollAdditionDeductionEnum::consts())) {
                    $processedAttendances = PayrollProcessedLeaveAttendance::where([['employee_id',$employee->id]])->get();
                    
                    switch ($payrollTrxAddition['code']) {
                        case "ALP":
                            /* For resigned employee
                             * 1. get payback
                             * 2. number of balance AL
                             */
                            if(PayrollHelper::isResigned($employee, $payrollMonth)){
                                $leaveAllocations = LeaveAllocation::where([
                                    ['leave_type_id', 1],
                                    ['emp_id', $employee->id],
                                    ['valid_until_date', '>=', $processedStartDate],
                                    ['valid_until_date', '<=', DateHelper::getLastDayOfDate($payrollMonth)]
                                ])->get();
                                
                                $processedId = array();
                                foreach($processedAttendances as $p) {
                                    array_push($processedId, $p->leave_request_id);
                                }
                                
                                $totalDays = 0;
                                $totalAmount = 0;
                                $processedData = array();
                                foreach($leaveAllocations as $leave){
                                    if(count($processedAttendances) == 0 || !in_array($leave->id, $processedId)){
                                        $processedData[] = [
                                            'payroll_trx_addition_id' => $payrollTrxAddition['id'],
                                            'leave_request_id' => $leave->id,
                                            'employee_id' => $employee->id
                                        ];
                                        
                                        $totalDays += $leave->allocated_days - $leave->spent_days;
                                    } else {
                                        foreach($processedAttendances as $p) {
                                            if($p->payroll_trx_addition_id == $payrollTrxAddition->id) {
                                                $totalDays += $leave->allocated_days - $leave->spent_days;
                                            }
                                        }
                                    }
                                }
                                
                                if(count($processedData) > 0) {
                                    $updateData['days'] = $totalDays; //PayrollHelper::getALBalance($employee, $payrollMonth);
                                    $updateData['amount'] = PayrollHelper::getALPayback($employee, $payrollMonth, $totalDays);
                                }
                            }
                            break;
                            
                        case "OT":
                            /* formula: Basic / 26 / 8 * 1.5 * (how many hours they did their OT)
                             * 1. get OT date from employee attendance (check 3 months back)
                             * 2. get employee work day and hour
                             * 3. calculate OT
                             */
                            
                            $attendances = PayrollHelper::getAttendance(AttendanceEnum::PRESENT, $employee, $processedStartDate, $processedEndDate);
                            $endWorkTime = EmployeeWorkingDay::where('emp_id',$employee->id)->select('end_work_time')->first();
                            
//                             $processedAttendances = PayrollProcessedLeaveAttendance::where([
//                                 ['payroll_trx_addition_id', $payrollTrxAddition['id']]
//                             ])
//                             ->select('employee_attendance_id')
//                             ->get();

                            $processedId = array();
                            foreach($processedAttendances as $p) {
                                array_push($processedId, $p->employee_attendance_id);
                            }
                            
                            $processedData = array();
                            $totalHours = 0;
                            $totalAmount = 0;
                            foreach($attendances as $a){
                                $employeeClockInOut = EmployeeClockInOutRecord::where('emp_id',$employee->id)
                                ->whereDate('clock_in_time', $a->date)->first();
                                
                                if($endWorkTime == null){
                                    $endWorkDate = null;
                                } else {
                                    $endWorkDate = DateHelper::dateWithFormat($a->date, "Y-m-d")." ".$endWorkTime->end_work_time;
                                }
                                
                                $diffHour = 0;
                                if($endWorkDate != null && $employeeClockInOut != null){
                                    $diffHour = date_diff(date_create($endWorkDate), date_create($employeeClockInOut->clock_out_time));
                                }
                                
                                if(count($processedAttendances) == 0 || !in_array($a->id, $processedId)){
                                    $processedData[] = [
                                        'payroll_trx_addition_id' => $payrollTrxAddition['id'],
                                        'employee_attendance_id' => $a->id,
                                        'employee_id' => $employee->id
                                    ];
                                    
                                    if($diffHour->format('%h') >=  $minOtHour){
                                        $totalHours += $diffHour->format('%h');
                                        $basicSalary = PayrollHelper::getBasicSalaryByMonth($employee, $endWorkDate);
                                        $totalAmount += $basicSalary / 26 / 8 * 1.5 * $diffHour->format('%h');
                                    }
                                } else {
                                    foreach($processedAttendances as $p) {
                                        if($p->payroll_trx_addition_id == $payrollTrxAddition->id) {
                                            if($diffHour->format('%h') >=  $minOtHour){
                                                $totalHours += $diffHour->format('%h');
                                                $basicSalary = PayrollHelper::getBasicSalaryByMonth($employee, $endWorkDate);
                                                $totalAmount += $basicSalary / 26 / 8 * 1.5 * $diffHour->format('%h');
                                            }
                                        }
                                    }
                                }
                            }
                            
                            if(count($processedData) > 0) {
                                PayrollProcessedLeaveAttendance::insert($processedData);
                                $updateData['hours'] = $totalHours;
                                $updateData['amount'] = $totalAmount;
                            }
                            
                            break;
                            
                        case "PH":
                        case "RD":
                            $attendance = AttendanceEnum::OT_PUBLIC_HOLIDAY;
                            if($payrollTrxAddition['code'] == 'RD'){
                                $attendance = AttendanceEnum::OT_REST_DAY;
                            }
                            
                            $attendances = PayrollHelper::getAttendance($attendance, $employee, $processedStartDate, $processedEndDate);
//                             $processedAttendances = PayrollProcessedLeaveAttendance::where([
//                                 ['payroll_trx_addition_id', $payrollTrxAddition['id']]
//                             ])
//                             ->select('employee_attendance_id')
//                             ->get();
                            $processedId = array();
                            foreach($processedAttendances as $p) {
                                array_push($processedId, $p->employee_attendance_id);
                            }
                            
                            $processedData = array();
                            $totalDays = 0;
                            $totalAmount = 0;
                            foreach($attendances as $a){
                                if(count($processedAttendances) == 0 || !in_array($a->id, $processedId)){
                                    $processedData[] = [
                                        'payroll_trx_addition_id' => $payrollTrxAddition['id'],
                                        'employee_attendance_id' => $a->id,
                                        'employee_id' => $employee->id
                                    ];
                                    
                                    $totalDays++;
                                    $basicSalary = PayrollHelper::getBasicSalaryByMonth($employee, $a->date);
                                    $totalAmount += $basicSalary / 26 * 2;
                                } else {
                                    foreach($processedAttendances as $p) {
                                        if($p->payroll_trx_addition_id == $payrollTrxAddition->id) {
                                            $totalDays++;
                                            $basicSalary = PayrollHelper::getBasicSalaryByMonth($employee, $a->date);
                                            $totalAmount += $basicSalary / 26 * 2;
                                        }
                                    }
                                }
                            }
                            
                            if(count($processedData) > 0) {
                                PayrollProcessedLeaveAttendance::insert($processedData);
                                $updateData['days'] = $totalDays;
                                $updateData['amount'] = $totalAmount;
                            }
                            
                            break;
                            
                        case "OD":
                            $attendances = PayrollHelper::getAttendance(AttendanceEnum::OT, $employee, $processedStartDate, $processedEndDate);
//                             $processedAttendances = PayrollProcessedLeaveAttendance::where([
//                                 ['payroll_trx_addition_id', $payrollTrxAddition['id']]
//                             ])
//                             ->select('employee_attendance_id')
//                             ->get();
                            $processedId = array();
                            foreach($processedAttendances as $p) {
                                array_push($processedId, $p->employee_attendance_id);
                            }
                            
                            $processedData = array();
                            $totalDays = 0;
                            $totalAmount = 0;
                            foreach($attendances as $a){
                                if(count($processedAttendances) == 0 || !in_array($a->id, $processedId)){
                                    $processedData[] = [
                                        'payroll_trx_addition_id' => $payrollTrxAddition['id'],
                                        'employee_attendance_id' => $a->id,
                                        'employee_id' => $employee->id
                                    ];
                                    
                                    $totalDays++;
                                    $basicSalary = PayrollHelper::getBasicSalaryByMonth($employee, $a->date);
                                    $totalAmount += $basicSalary / 26;
                                } else {
                                    foreach($processedAttendances as $p) {
                                        if($p->payroll_trx_addition_id == $payrollTrxAddition->id) {
                                            $totalDays++;
                                            $basicSalary = PayrollHelper::getBasicSalaryByMonth($employee, $a->date);
                                            $totalAmount += $basicSalary / 26 * 2;
                                        }
                                    }
                                }
                            }
                            
                            if(count($processedData) > 0) {
                                PayrollProcessedLeaveAttendance::insert($processedData);
                                $updateData['days'] = $totalDays;
                                $updateData['amount'] = $totalAmount;
                            }
                            
                            break;
                            
                        case "CFLP":
                            $leaveAllocations = LeaveAllocation::where([
                            ['leave_type_id', 1],
                            ['emp_id', $employee->id],
                            ['is_carry_forward', 1],
                            ['valid_until_date', '>=', $processedStartDate],
                            ['valid_until_date', '<=', DateHelper::getLastDayOfDate($payrollMonth)]
                            ])->get();
                            
//                             $processedAttendances = PayrollProcessedLeaveAttendance::where([
//                                 ['payroll_trx_addition_id', $payrollTrxAddition['id']]
//                             ])
//                             ->select('leave_request_id')
//                             ->get();

                            $totalDays = 0;
                            $totalAmount = 0;
                            $processedId = array();
                            foreach($processedAttendances as $p) {
                                array_push($processedId, $p->leave_request_id);
                            }
                            
                            $processedData = array();
                            foreach($leaveAllocations as $leave){
                                if(count($processedAttendances) == 0 || !in_array($leave->id, $processedId)){
                                    $processedData[] = [
                                        'payroll_trx_addition_id' => $payrollTrxAddition['id'],
                                        'leave_request_id' => $leave->id,
                                        'employee_id' => $employee->id
                                    ];
                                    $totalDays += $leave->allocated_days - $leave->spent_days;
                                } else {
                                    foreach($processedAttendances as $p) {
                                        if($p->payroll_trx_addition_id == $payrollTrxAddition->id) {
                                            $totalDays += $leave->allocated_days - $leave->spent_days;
                                        }
                                    }
                                }
                            }
                            
                            if(count($processedData) > 0) {
//                                 $totalAllocated = 0;
//                                 $totalSpent = 0;
//                                 foreach ($leaveAllocations as $leave) {
//                                     $totalAllocated += $leave->allocated_days;
//                                     $totalSpent += $leave->spent_days;
//                                 }
                                
//                                 $noOfLeave = $totalAllocated - $totalSpent;
                                
                                if($employee->basic_salary >= 2000){
                                    $days = DateHelper::getNumberDaysInMonth($payrollMonth);
                                    $totalAmount = $employee->basic_salary / $days * $totalDays;
                                } else {
                                    $totalAmount = $employee->basic_salary / 26 * $totalDays;
                                }

                                $updateData['days'] = $totalDays;
                                $updateData['amount'] = $totalAmount;
                            }
                            
                            break;
                    }
                }
            }
            
            PayrollTrxAddition::where('id', $payrollTrxAddition['id'])->update($updateData);
            
            if (strpos($payrollTrxAddition['statutory'], 'EPF') !== false) {
                $totalEpf += $updateData['amount'];
            }
            
            if (strpos($payrollTrxAddition['statutory'], 'EIS') !== false) {
                $totalEis += $updateData['amount'];
            }
            
            if (strpos($payrollTrxAddition['statutory'], 'SOCSO') !== false) {
                $totalSocso += $updateData['amount'];
            }
            
            if (strpos($payrollTrxAddition['statutory'], 'PCB') !== false) {
                $totalPcb += $updateData['amount'];
            }
            
            $totalAddition += $updateData['amount'];
        }
        
        $data['epf'] = $totalEpf;
        $data['eis'] = $totalEis;
        $data['socso'] = $totalSocso;
        $data['pcb'] = $totalPcb;
        $data['addition'] = $totalAddition;
        
        return $data;
    }
    
    private function calculateUpdateDeduction($payrollTrxId, $employee, $processedStartDate, $processedEndDate, $payrollMonth)
    {
        $totalDeduction = 0;
        $payrollTrxDeductionList = PayrollTrxDeduction::join('deductions', 'payroll_trx_deduction.deductions_id','=', 'deductions.id')
        ->select('deductions.*', 'payroll_trx_deduction.*')
        ->where('payroll_trx_id',$payrollTrxId)
        ->get();
        
        foreach($payrollTrxDeductionList as $payrollTrxDeduction) {
            /*
             * UL
             */
            $updateData = [];
            $updateData['payroll_trx_id'] = $payrollTrxDeduction['payroll_trx_id'];
            $updateData['deductions_id'] = $payrollTrxDeduction['deductions_id'];
            $updateData['amount'] = $payrollTrxDeduction['amount'];
            $updateData['days'] = $payrollTrxDeduction['days'];
            $updateData['hours'] = $payrollTrxDeduction['hours'];
            
            if($payrollTrxDeduction['type'] == 'Custom'){
                $processedAttendances = PayrollProcessedLeaveAttendance::where([['employee_id',$employee->id]])->get();
                
                if($payrollTrxDeduction['code'] == 'UL') {
                    $attendances = PayrollHelper::getAttendance(AttendanceEnum::ABSENT, $employee, $processedStartDate, $processedEndDate);
                    
                    $unpaidLeaves = LeaveRequest::where([
                        ['leave_type_id', 5],
                        ['emp_id', $employee->id],
                        ['status', 'approved'],
                        ['start_date', '>=', $processedStartDate],
                        ['start_date', '<=', DateHelper::getLastDayOfDate($payrollMonth)]
                    ])->get();
                    
//                     $processedAttendances = PayrollProcessedLeaveAttendance::where([
//                         ['payroll_trx_deduction_id', $payrollTrxDeduction['id']]
//                     ])
//                     ->select('employee_attendance_id')
//                     ->get();
                    
//                     $processedLeaves = PayrollProcessedLeaveAttendance::where([
//                         ['payroll_trx_deduction_id', $payrollTrxDeduction['id']]
//                     ])
//                     ->select('leave_request_id')
//                     ->get();
                    
                    $processedAttendanceId = array();
                    foreach($processedAttendances as $p) {
                        array_push($processedAttendanceId, $p->employee_attendance_id);
                    }
                    
                    $processedLeavesId = array();
                    foreach($processedAttendances as $p) {
                        array_push($processedLeavesId, $p->leave_request_id);
                    }
                    
                    $processedData = array();
                    $totalDays = 0;
                    $totalAmount = 0;
                    foreach($attendances as $a) {
                        if(count($processedAttendances) == 0 || !in_array($a->id, $processedAttendanceId)){
                            $processedData[] = [
                                'payroll_trx_deduction_id' => $payrollTrxDeduction['id'],
                                'employee_attendance_id' => $a->id,
                                'employee_id' => $employee->id
                            ];
                            
                            $totalDays++;
                            $days = DateHelper::getNumberDaysInMonth($a->date);
                            $basicSalary = PayrollHelper::getBasicSalaryByMonth($employee, $a->date);
                            //Basic salary / calendar days on that month * number of unpaid leave
                            $totalAmount += $basicSalary / $days;
                        } else {
                            foreach($processedAttendances as $p) {
                                if($p->payroll_trx_deduction_id == $payrollTrxDeduction->id) {
                                    $totalDays++;
                                    $days = DateHelper::getNumberDaysInMonth($a->date);
                                    $basicSalary = PayrollHelper::getBasicSalaryByMonth($employee, $a->date);
                                    //Basic salary / calendar days on that month * number of unpaid leave
                                    $totalAmount += $basicSalary / $days;
                                }
                            }
                        }
                    }
                    
                    foreach($unpaidLeaves as $leave){
                        if(count($processedLeavesId) == 0 || !in_array($leave->id, $processedLeavesId)){
                            $processedData[] = [
                                'payroll_trx_deduction_id' => $payrollTrxDeduction['id'],
                                'leave_request_id' => $leave->id,
                                'employee_id' => $employee->id
                            ];
                            
                            $totalDays += $leave->applied_days;
                            $days = DateHelper::getNumberDaysInMonth($leave->start_date);
                            $basicSalary = PayrollHelper::getBasicSalaryByMonth($employee, $leave->start_date);
                            //Basic salary / calendar days on that month * number of unpaid leave
                            $totalAmount += $basicSalary / $days * $leave->applied_days;
                        } else {
                            foreach($processedAttendances as $p) {
                                if($p->payroll_trx_deduction_id == $payrollTrxDeduction->id) {
                                    $totalDays += $leave->applied_days;
                                    $days = DateHelper::getNumberDaysInMonth($leave->start_date);
                                    $basicSalary = PayrollHelper::getBasicSalaryByMonth($employee, $leave->start_date);
                                    //Basic salary / calendar days on that month * number of unpaid leave
                                    $totalAmount += $basicSalary / $days * $leave->applied_days;
                                }
                            }
                        }
                    }
                    
                    if(count($processedData) > 0) {
                        PayrollProcessedLeaveAttendance::insert($processedData);
                        $updateData['days'] = $totalDays;
                        $updateData['amount'] = $totalAmount;
                    }
                }
            }
            
            PayrollTrxDeduction::where('id', $payrollTrxDeduction['id'])->update($updateData);
            $totalDeduction += $updateData['amount'];
        }
        
        return $totalDeduction;
    }
    
}
