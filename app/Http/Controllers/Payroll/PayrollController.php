<?php
namespace App\Http\Controllers\Payroll;

use App\Company;
use App\CostCentre;
use App\Employee;
use App\Epf;
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
use App\Eis;
use App\Socso;
use App\Pcb;
use App\Http\Controllers\Popo\payrollreport\PayrollReport;
use PDF;
use App\Repositories\Payroll\ReportRepository;
use App\EmployeeJob;
use App\Addition;
use App\Deduction;
use App\LeaveRequestApproval;
use App\EmployeeAttendance;
use App\Helpers\AccessControllHelper;
use App\PayrollTrxAddition;
use App\EmployeeWorkingDay;

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
        //check if user has admin or hr-exec role
        AccessControllHelper::hasAnyRoles('admin|hr-exec');
        
        //get company information based on user login
        $company = GenerateReportsHelper::getUserLogonCompanyInfomation();
        $payroll = [];
        if($company != null){
            $payroll = PayrollMaster::leftJoin('companies', 'companies.id', '=', 'payroll_master.company_id')
            ->where('company_id', $company->id)
            ->select('payroll_master.*','companies.name')->get();
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
            $msg = 'Payroll '.PayrollPeriodEnum::getDescription($validated['period']).' '.DateHelper::dateWithFormat($validated['year_month'], 'M-Y'). ' has already been created.';
            return redirect($request->server('HTTP_REFERER'))->withErrors([$msg]);
        }

        // Process
        DB::beginTransaction();
        
        // Step 1. get company
        $company = GenerateReportsHelper::getUserLogonCompanyInfomation();
        
        // Step 2. Create payroll.
        $payroll = new PayrollMaster();
        $payroll->company_id = $company->id;
        $payroll->year_month = $validated['year_month'] . '-01';
        $payroll->period = $validated['period'];
        $payroll->created_by = $currentUser; 
        $payroll->updated_by = $currentUser; 
        $payroll->start_date = $this->payrollService->getPayrollStartDate($data);
        $payroll->end_date = date('Y-m-d', strtotime('-1 days'));
        $payroll->save();

        // Step 3. Find all employees under this company, generate all employees' payroll trx.
        $payrollId = $payroll->id;
        $firstDayOfMonth = date('Y-m-d', strtotime($validated['year_month'] . '-01'));
            
        $employeeList = Employee::leftJoin('employee_jobs', 'employee_jobs.emp_id', '=', 'employees.id')->where([
            ['company_id', $company->id]
        ])
        ->where(function ($query) use ($firstDayOfMonth) {
            // Either default or month/year greater or same
            $query->where('employee_jobs.id', DB::raw('(SELECT id FROM employee_jobs WHERE emp_id = employees.id AND start_date <= "' . $firstDayOfMonth . '" ORDER BY start_date DESC LIMIT 1)'));
        })
        ->get();
//      dd($employeeList);
        foreach ($employeeList as $employee) {
            // Step 4. Find employee's payroll's required info.
            $employeeJob = EmployeeJob::find($employee->id);
            $basicSalary = PayrollHelper::calculateSalary($employeeJob, $validated['year_month']);
            $costCentre = CostCentre::where('id', $employeeJob->cost_centre_id)->get();
            $seniorityPay = PayrollHelper::calculateSeniorityPay($employee, $validated['year_month'], $costCentre);

            $epfFilter = array();
            $epfFilter['age'] = PayrollHelper::getAge($employee->dob);
            $epfFilter['nationality'] = $employee->nationality;
            $epfFilter['salary'] = $basicSalary;
            $epf = new Epf();
            $epf = $this->epfRepository->findByFilter($epfFilter);
            $eis = new Eis();
            $eis = $this->eisRepository->findBySalary($basicSalary);
            $socso = new Socso();
            $socso = $this->socsoRepository->findBySalary($basicSalary);
            $pcbFilter = array();
            $pcbFilter['salary'] = $basicSalary;
            $pcbFilter['pcbGroup'] = $employee->pcb_group;
            $pcbFilter['noOfChildren'] = $employee->total_child;
            $pcb = new Pcb();
            $pcb = $this->pcbRepository->findByFilter($pcbFilter);
            
            // Step 5. Create payroll trx.
            $payrollTrxData = array();
            $payrollTrxData['payroll_master_id'] = $payrollId;
            $payrollTrxData['employee_id'] = $employee->emp_id;
            $payrollTrxData['employee_epf'] = isset($epf->employee) ? $epf->employee : 0;
            $payrollTrxData['employee_eis'] = isset($eis->employee) ? $eis->employee : 0;
            $payrollTrxData['employee_socso'] = isset($socso->first_category_employee) ? $socso->first_category_employee : 0;
            $payrollTrxData['employee_pcb'] = isset($pcb->amount) ? $pcb->amount : 0;
            $payrollTrxData['employer_epf'] = isset($epf->employer) ? $epf->employer : 0;
            $payrollTrxData['employer_eis'] = isset($eis->employer) ? $eis->employer : 0;
            $payrollTrxData['employer_socso'] = isset($socso->first_category_employer) ? $socso->first_category_employer : 0;
            $payrollTrxData['seniority_pay'] = $seniorityPay;
            $payrollTrxData['basic_salary'] = $basicSalary;
            $payrollTrxData['take_home_pay'] = 0;
            $payrollTrxData['created_by'] = $currentUser;
            $payrollTrxData['updated_by'] = $currentUser;
//                 dd($payrollTrxData);
            $payrollTrxId = $this->payrollTrxRepository->create($payrollTrxData)->id;
// dd($employee);
            // Step 6. Insert addition & deduction.
            $additionDeductionFilter = array();
            $additionDeductionFilter['companyId'] = $company->id;
            $additionDeductionFilter['isConfirmedEmployee'] = PayrollHelper::isConfirmedEmployee($employee, $validated['year_month']);
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
        
        /*
         * Update payroll_trx_addition and payroll_trx_deduction
         */
        $processedStartDate = DateHelper::getPastNMonthDate($payroll->end_date, getenv('PAYROLL_BACK_DATED_PERIOD')) ." 00:00:00";
        $processedEndDate = $payroll->end_date." 23:59:59";
        
        $payrollTrxAdditionList = PayrollTrxAddition::join('additions', 'payroll_trx_addition.additions_id','=', 'additions.id')
            ->select('additions.*', 'payroll_trx_addition.*')
            ->where('payroll_trx_id',$payrollTrxId)
            ->get();
        
        foreach($payrollTrxAdditionList as $payrollTrxAddition) {
            /*
             * ALP, OT, PH,  CFLP, RD
             */
            $updateData = [];
            $updateData['payroll_trx_id'] = $payrollTrxAddition['payroll_trx_id'];
            $updateData['additions_id'] = $payrollTrxAddition['additions_id'];
            $updateData['amount'] = $payrollTrxAddition['amount'];
            $updateData['days'] = $payrollTrxAddition['days'];
            $updateData['hours'] = $payrollTrxAddition['hours'];
            
            if($payrollTrxAddition['type'] == 'Custom'){
                if(in_array($payrollTrxAddition['code'], PayrollAdditionDeductionEnum::values())) {
                    switch ($payrollTrxAddition['code']) {
                        case "ALP":
                            /* For resigned employee
                             * 1. get payback
                             * 2. number of balance AL
                             */
                            if(PayrollHelper::isResigned($employee, $validated['year_month'])){
                                $updateData['days'] = PayrollHelper::getALBalance($employee, $validated['year_month']);
                                $updateData['amount'] = PayrollHelper::getALPayback($employee, $validated['year_month']);
                            }
                            break;
                            
                        case "OT":
                            /* formula: Basic / 26 / 8 * 1.5 * (how many hours they did their OT)
                             * 1. get OT date from employee attendance (check 3 months back)
                             * 2. get employee work day and hour
                             * 3. calculate OT
                             */
                            $attendances = PayrollHelper::getAttendance('ot', $employee, $processedStartDate, $processedEndDate);
                            
                            $processedAttendances = PayrollProcessedLeaveAttendance::where([
                                ['payroll_trx_addition_id', $payrollTrxAddition['id']]
                            ])
                            ->select('employee_attendance_id')
                            ->get();

                            $processedData = array();
                            $totalHours = 0;
                            foreach($attendances as $a){
                                if(count($processedAttendances) == 0 || !in_array($a->id, $processedAttendances)){
                                    $processedData[] = [
                                        'payroll_trx_addition_id' => $payrollTrxAddition['id'],
                                        'employee_attendance_id' => $a->id
                                    ];
                                    
                                    $minOtHour = getenv('MIN_OT_HOUR');
                                    $endWorkTime = EmployeeWorkingDay::where('emp_id',$employee->id)->select('end_work_time')->get();
                                    $endWorkDate = DateHelper::dateWithFormat($a->clock_in_time, "Y-m-d")." ".$endWorkTime;
                                    $diffHour = date_diff(date_create($endWorkDate), date_create($a->clock_out_time));
                                    if($diffHour->format('%h') >=  $minOtHour){
                                        $totalHours += $diffHour->format('%h');
                                    }
                                } 
                            }
                            
                            if(count($processedData) > 0) {
                                PayrollProcessedLeaveAttendance::insert($processedData);
                            }
                            
                            $updateData['hours'] = $totalHours;
                            $updateData['amount'] = $employee->basic_salary / 26 / 8 * 1.5 * $totalHours; 
                            break;
                            
                        case "PH":
                        case "RD":
                            $clockInStatus = 'ph';
                            if($payrollTrxAddition['code'] == 'RD'){
                                $clockInStatus = 'rest';
                            } 
                            
                            $attendances = PayrollHelper::getAttendance($clockInStatus, $employee, $processedStartDate, $processedEndDate);
                            $processedAttendances = PayrollProcessedLeaveAttendance::where([
                                ['payroll_trx_addition_id', $payrollTrxAddition['id']]
                            ])
                            ->select('employee_attendance_id')
                            ->get();
                            
                            $totalDays = 0;
                            foreach($attendances as $a){
                                if(count($processedAttendances) == 0 || !in_array($a->id, $processedAttendances)){
                                    $processedData[] = [
                                        'payroll_trx_addition_id' => $payrollTrxAddition['id'],
                                        'employee_attendance_id' => $a->id
                                    ];
                                    
                                    $diff = date_diff(date_create($a->clock_in_time), date_create($a->clock_out_time));
                                    $totalDays += $diff->format('%d');
                                }
                            }
                            
                            if(count($processedData) > 0) {
                                PayrollProcessedLeaveAttendance::insert($processedData);
                            }
                            
                            $updateData['days'] = $totalDays;
                            $updateData['amount'] = $employee->basic_salary / 26 * 2 * $totalDays;
                            break;
                            
                        case "CFLP":
                            //TODO: get carry forward leave
                            $leaveAllocations = LeaveAllocation::where([
                                ['leave_type_id', 1],
                                ['emp_id', $employee->id],
                                ['is_carry_forward', 1],
                                ['valid_from_date', '>=', $validated['year_month']],
                                ['valid_until_date', '<=', DateHelper::getLastDayOfDate($validated['year_month'])]
                            ])->get();
                            
                            $totalAllocated = 0;
                            $totalSpent = 0;
                            foreach ($leaveAllocations as $leave) {
                                $totalAllocated += $leave->allocated_days;
                                $totalSpent += $leave->spent_days;
                            }
                            
                            $noOfLeave = $totalAllocated - $totalSpent;
                            
                            if($basicSalary >= 2000){
                                $days = DateHelper::getNumberDaysInMonth($validated['year_month']);
                                $amount = $employee->basic_salary / $days * $noOfLeave;
                            } else {
                                $amount = $employee->basic_salary / 26 * $noOfLeave;
                            }
                            
                            $updateData['days'] = $totalDays;
                            $updateData['amount'] = $amount;
                            break;
                    }
                }
            }
            
            PayrollTrxAddition::where('id', $payrollTrxAddition['id'])->update($updateData);
        }
        
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
            $updateData['additions_id'] = $payrollTrxDeduction['deductions_id'];
            $updateData['amount'] = $payrollTrxDeduction['amount'];
            $updateData['days'] = $payrollTrxDeduction['days'];
            $updateData['hours'] = $payrollTrxDeduction['hours'];
            
            if($payrollTrxDeduction['type'] == 'Custom'){
                if($payrollTrxDeduction['code'] == 'UL') {
                    //TODO: get UL
                    $days = DateHelper::getNumberDaysInMonth($validated['year_month']);
                    $updateData['days'] = $totalDays;
                    $updateData['amount'] = $employee->basic_salary / $days * $noOfUL;
                            
                }
            }
            
            PayrollTrxDeduction::where('id', $payrollTrxDeduction['id'])->update($updateData);
        }
        
        DB::commit();
        
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

        $isHrAdmin = AccessControllHelper::hasHrAdminRole(); 
        $isHrExec = AccessControllHelper::hasHrExecRole();
        $currentUser = Auth::id();
        $securityGroupAccess = AccessControllHelper::getSecurityGroupAccess();
//         dd($securityGroupAccess);
        $payroll = PayrollMaster::where([
            [
                'id', $id
            ]
        ])->first();
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
            ->where(function($query) use($isHrExec, $currentUser, $securityGroupAccess, $isHrAdmin){
                if($isHrAdmin){
                    $query->where([
                        ['ert.kpi_proposer', 1]
                    ]);
                } else if($isHrExec) {
                    $query->where([
                        ['ert.kpi_proposer', 1]
                    ])->whereIn('e.main_security_group_id', $securityGroupAccess);
                }else {
                    $query->where([ 
                        ['ert.report_to_emp_id', $currentUser],
                        ['ert.kpi_proposer', 1]
                    ]);
                } 
            })
            ->whereNull('ert.deleted_at')
            ->orderby('payroll_trx.id', 'ASC')->get();

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
        if (! @$info)
            return redirect($request->server('HTTP_REFERER'))->with('error', 'Payroll not found.');

        DB::beginTransaction();
        $storeData = [];
        $storeData['status'] = $request['status'];
        $storeData['updated_by'] = auth()->user()->id;
        PayrollMaster::where('id', $id)->update($storeData);
        DB::commit();

        return redirect($request->server('HTTP_REFERER'))->with('success', 'Payroll month '.DateHelper::dateWithFormat($info[0]->year_month, 'Y-m').' is '. strtolower(new PayrollStatus($request['status'])).'.');
    }
    
    public function showPayrollTrx(Request $request, $id)
    {
        /*
         * 1. Basic info
         * 2. Remarks
         * 3. Basic Earnings
         * 4. Bonus
         * 5. Additions
         * 6. Deductions
         * 7. Employee Contribution
         * 8. Employer Contribution
         * 9. Summary
         */
        $info = $this->payrollTrx->find($id)->first();
        $currentUser = auth()->user()->id;
        $company = GenerateReportsHelper::getUserLogonCompanyInfomation();
        $info->isKpiProposer = $this->employeeReportToRepository->isKpiProposer($info->employee_id, $currentUser);
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
        $title = 'Payroll';
        $payrollId = $info->payroll_master_id;
        $addition_days_array = PayrollHelper::payroll_addition_with_days();
        $addition_hours_array = PayrollHelper::payroll_addition_with_hours();
        $deduction_days_array = PayrollHelper::payroll_deduction_with_days();
        $year_month = $info->year_month;
        $total_days = cal_days_in_month(CAL_GREGORIAN, substr($year_month,5,2), substr($year_month,0,4));
        $start_date = $year_month.'-01';
        $joined_date = $info->joined_date;
        
        if(strtotime($joined_date) > strtotime($start_date)) {
            $different_of_dates = date_diff(date_create($start_date), date_create($joined_date));
            $total_days = $total_days - $different_of_dates->format('%a')+1;
        }
        
        //UL, show last 3 month, save update payroll_trx_id
        $unpaidLeaves = LeaveRequestApproval::join('leave_requests as lr', 'lr.id', '=', 'leave_request_approvals.leave_request_id')
        ->where([
//             ['payroll_trx_id', $id],
            ['lr.leave_type_id', 5],
            ['lr.emp_id', $employee->id]
        ])
        ->select('leave_request_approvals.*', 'lr.*')
        ->get();
//         dd($employee);

        // ALP
        $annualLeaves = LeaveRequestApproval::join('leave_requests as lr', 'lr.id', '=', 'leave_request_approvals.leave_request_id')
            ->where([
//                 ['payroll_trx_id', $id],
                ['lr.leave_type_id', 1],
                ['lr.emp_id', $employee->id]
            ])
            ->select('leave_request_approvals.*', 'lr.*')
            ->get();
        
        //CFLP
        $carryForwardLeaves = LeaveRequestApproval::join('leave_requests as lr', 'lr.id', '=', 'leave_request_approvals.leave_request_id')
        ->where([
//             ['payroll_trx_id', $id],
            ['lr.leave_type_id', 6],
            ['lr.emp_id', $employee->id]
        ])
        ->select('leave_request_approvals.*', 'lr.*')
        ->get();
        
        //PH
        $ph = EmployeeAttendance::where([
            ['clock_in_status', 'ph'],
            ['emp_id', $info->employee_id]
        ])
        ->get();
        
        //RD
        $rd = EmployeeAttendance::where([
            ['clock_in_status', 'rest'],
            ['emp_id', $info->employee_id]
        ])
        ->get();
        
        //OT
        $ot = EmployeeAttendance::where([
            ['clock_in_status', 'ot'],
            ['emp_id', $info->employee_id]
        ])
        ->get();
        
        
//         dd($payrollTrxAdditionList);
        return view('pages.payroll.show-payroll-trx', compact('id', 'payrollId', 'title', 'additions', 'deductions', 'payrollTrxAdditionList', 
            'payrollTrxDeductionList', 'info', 'company', 'employee', 'addition_days_array', 'addition_hours_array', 'deduction_days_array', 
            'year_month', 'total_days', 'unpaidLeaves', 'annualLeaves', 'carryForwardLeaves', 'ot', 'ph', 'rd'));
    }
    
    public function updatePayrollTrx(Request $request, $id)
    {
//         dd($request->all());
        $info = $this->payrollTrx->find($id)->first();
        if(!@$info) return redirect($request->server('HTTP_REFERER'))->with('error', 'Payroll not found.');
        
        //update KPI
        DB::beginTransaction();
        if(isset($request['saveKpi'])){
            $storeData = [];
            $storeData['kpi'] = $request['kpi'];
            $storeData['bonus'] = $request['bonus'];
            PayrollTrx::where('id', $id)->update($storeData);
        }else{
            //TODO: calculate here instead get from input
            $this->payrollTrxAdditionRepository->updateMulitpleData($request->input());
            $this->payrollTrxDeductionRepository->updateMulitpleData($request->input());
            $storeData = [];
            $storeData['take_home_pay'] = $request['take_home_pay'];
            $storeData['total_addition'] = $request['total_addition'];
            $storeData['total_deduction'] = $request['total_deduction'];
            PayrollTrx::where('id', $id)->update($storeData);
//             dd($info);
            $next = $this->payrollTrx->findNext($id, $info->payroll_master_id);
            $save_n_next = $request->input('save_n_next');
        }
        DB::commit();
        
//         return redirect($request->server('HTTP_REFERER'))->with('success', 'Successfully updated payroll.');
        
        if(!@$save_n_next) return redirect($request->server('HTTP_REFERER'))->with('success', 'Successfully updated payroll.');
        return (@$next)? redirect()->route('payroll.trx.show', ['id'=>$next->id])->with('success', 'Successfully updated payroll.') : redirect('/payroll/'.$request->input('payroll_id'))->with('success', 'All employees updated.');
        
        
        
//         DB::beginTransaction();
//         $is_in_charge = $this->employeereportto->find_employee_in_charge($info->employee_id, Auth::user()->id);
        
//         // if(!@$is_in_charge && (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Superadmin'))) {
//         if(Auth::user()->id != $info->user_id && ($info->status !== 'Locked') && !@$is_in_charge) {
//             $this->payrolltrx_addition->updateMulitpleData($request->input());
//             $this->payrolltrx_deduction->updateMulitpleData($request->input());
            
//             $calculate_result = $this->calculate($request->input(), $info);
//             $request->request->add(['final_payment'=>$calculate_result['net_pay']]);
//             $this->payrolltrx->update($id, $request->input());
            
//             // 20181011 Lin : Calculate the additions & deductions which affect the contributions
            
            
//             // 20180919 Lin : Find next payroll trx
//             $payroll_id = $request->input('payroll_id');
//             $next = $this->payrolltrx->find_next($id, $request->input('payroll_id'), $request->input('payroll_type'));
//             $save_n_next = $request->input('save_n_next');
//         } else {
//             // Only able to update bonus
//             $this->payrolltrx->update($id, $request->input());
//         }
//         DB::commit();
        
//         if(!@$save_n_next) return redirect($request->server('HTTP_REFERER'))->with('success', 'Successfully updated payroll.');
//         return (@$next)? redirect()->route('payroll.trx.show', ['id'=>$next->id])->with('success', 'Successfully updated payroll.') : redirect('/payroll/'.$request->input('payroll_id'))->with('success', 'All employees updated.');
    }
    
    //Reports
    // Add payroll form
    public function showReport()
    {
//         $period = PayrollPeriodEnum::choices();
//         $payrollReport = PayrollReportEnum::choices();
//         $sliders = array_chunk($payrollReport, 3);
        $arr = PayrollReport::getPayrollReport();
//         $arr = array_chunk($report[0], 3);
//         dd($arr);

        $form = PayrollReport::getPayrollReportForm();
        $costcentres = GenerateReportsHelper::getCostCentre();
        $departments = GenerateReportsHelper::getDepartments();
        $branches = GenerateReportsHelper::getBranches();
        $positions = GenerateReportsHelper::getPosition();
        $period = PayrollPeriodEnum::list();
        
        //get company information based on user login
        $company = GenerateReportsHelper::getUserLogonCompanyInfomation();
        $officers = GenerateReportsHelper::getListOfficerInformation($company->id);
        
        return view('pages.payroll.payroll-report', ['period' => $period, 'sliders' => $arr['slider'],
            'sliders1' => $arr['slider1'],
            'dforms' => $form['form'],
            'dforms1' => $form['form1'],
            'costcentres' => $costcentres,
            'departments' => $departments,
            'branches' => $branches,
            'positions' => $positions,
            'officers' => $officers
        ]);
    }
    
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
        $company = GenerateReportsHelper::getUserLogonCompanyInfomation();
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
        $period = PayrollPeriodEnum::choices();
        return view('pages.payroll.payslip', ['period' => $period]);
    }
    
    public function downloadPayslip(PayrollRequest $request)
    {
//         dd($request);
        $currentUser = auth()->user()->id;
        $employee = Employee::where('user_id', $currentUser)->first();
        $companyId = $employee->company_id;
        $validated = $request->validated();
        $data = array(
            'year_month' => $validated['year_month'].'-01',
            'period' => $validated['period'],
            'companyId' => $companyId
        );
        
        $payroll = $this->payrollService->findByPayrollMonthPeriod($data);
        if (count($payroll) > 0) {
            $payrollMasterId = $payroll->first()->id;
            $info = $this->payrollTrx->findByEmployee($payrollMasterId, $employee->id);
           
            $addition = $this->payrollTrxAdditionRepository->findByPayrollTrxId($info->id);
            $deduction = $this->payrollTrxDeductionRepository->findByPayrollTrxId($info->id);
            
            $info->extra_count = (count($addition) > count($deduction))? count($addition) : count($deduction);
            //addition
            //deduction
        } else {
            $msg = 'Payslip ' . $validated['year_month'] . ' does not exist.';
            return redirect($request->server('HTTP_REFERER'))->withErrors([$msg]);
        }
        
        //TODO: year to date
//         dd($addition,$info);
        $pdf = PDF::loadView('pages/payroll/payslip/payslip',
            [
                'info' => $info,
                'addition' => $addition,
                'deduction' => $deduction
            ])->setOrientation('landscape');
            
            $pdf->setTemporaryFolder(storage_path("temp"));
            // download pdf
            return $pdf->download('payslip.pdf');
            
    }
    
}
