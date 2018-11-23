<?php
namespace App\Http\Controllers\Payroll;

use App\Company;
use App\CostCentre;
use App\Employee;
use App\Epf;
use App\PayrollMaster;
use App\PayrollTrx;
use App\Enums\PayrollPeriodEnum;
use App\Enums\PayrollStatus;
use App\Helpers\DateHelper;
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

    public function __construct(PayrollMaster $payrollMaster, PayrollService $payrollService, EpfRepository $epfRepository, EisRepository $eisRepository, 
        SocsoRepository $socsoRepository, PcbRepository $pcbRepository, PayrollTrxRepository $payrollTrxRepository, AdditionRepository $additionRepository,
        DeductionRepository $deductionRepository, PayrollTrxRepository $payrollTrx, Company $company,
        EmployeeReportToRepository $employeeReportToRepository, EmployeeRepository $employeeRepository, PayrollTrxAdditionRepository $payrollTrxAdditionRepository,
        PayrollTrxDeductionRepository $payrollTrxDeductionRepository)
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
    }

    // Payroll listing
    public function index()
    {
        $payroll = PayrollMaster::leftJoin('companies', 'companies.id', '=', 'payroll_master.company_id')
            ->select('payroll_master.*','companies.name')->get();

        $period = PayrollPeriodEnum::choices();
        return view('pages.payroll.index', compact('payroll', 'period'));
    }

    // Add payroll form
    public function create()
    {
        $period = PayrollPeriodEnum::choices();
        return view('pages.payroll.create', ['period' => $period]);
    }

    // Add payroll
    public function store(PayrollRequest $request)
    {
        $currentUser = auth()->user()->id;
        // validate and store
        $validated = $request->validated();
        // check if payroll period exists
        // $payrollPeriodExists = PayrollMaster::where([
        // ['year_month', $validated['year_month'].'-01'],
        // ['period', $validated['period']]
        // ])->exists();
        // TODO: refactor to service
        $data = array(
            'year_month' => $validated['year_month'].'-01', 
            'period' => $validated['period'] 
        );

        $payrollPeriodExists = $this->payrollService->isPayrollExists($data);
        if ($payrollPeriodExists) {
            $msg = 'Payroll month ' . $validated['year_month'] . ' has already been created.';
            return redirect($request->server('HTTP_REFERER'))->withErrors([$msg]);
        }
        // dd($payrollPeriodExists);

        // Process
        DB::beginTransaction();
        // Step 1. Find all companies, generate all companies' payroll.
        $companyList = Company::where('status', 'Active')->get();
        // dd($companyList);
        // Step 2. Create payroll.
        foreach ($companyList as $company) {
            $payroll = new PayrollMaster();
            $payroll->company_id = $company->id;
            $payroll->year_month = $validated['year_month'] . '-01';
            $payroll->period = $validated['period'];
            $payroll->created_by = $currentUser; 
            $payroll->updated_by = $currentUser; 
            $payroll->start_date = $this->payrollService->getPayrollStartDate($data);
            $payroll->end_date = date('Y-m-d', strtotime('-1 days'));
            $payroll->save();

            $payrollId = $payroll->id;
            $firstDayOfMonth = date('Y-m-d', strtotime($validated['year_month'] . '-01'));
            
            // Step 3. Find all employees under this company, generate all employees' payroll trx.
            $employeeList = Employee::leftJoin('employee_jobs', 'employee_jobs.emp_id', '=', 'employees.id')->where([
                ['company_id', $company->id]
            ])
            ->where(function ($query) use ($firstDayOfMonth) {
                // Either default or month/year greater or same
                $query->where('employee_jobs.id', DB::raw('(SELECT id FROM employee_jobs WHERE emp_id = employees.id AND start_date <= "' . $firstDayOfMonth . '" ORDER BY start_date DESC LIMIT 1)'));
            })
                ->get();
//             dd($employeeList);
            foreach ($employeeList as $employee) {

                // Step 4. Find employee's payroll's required info.
                $employeeJob = $employee->employee_jobs->sortByDesc('start_date', SORT_REGULAR)->first();
                // dd($employeeJob);
                $basicSalary = PayrollHelper::calculateSalary($employeeJob, $validated['year_month']);
                // dd($basicSalary);
                $costCentre = CostCentre::where('id', $employeeJob->cost_centre_id)->get();
                $seniorityPay = PayrollHelper::calculateSeniorityPay($employee, $validated['year_month'], $costCentre);
                // dd($seniorityPay);
                $payback = PayrollHelper::getPayback($employee, $validated['year_month']);

                $epfFilter = array();
                $epfFilter['age'] = PayrollHelper::getAge($employee->dob);
                $epfFilter['nationality'] = $employee->nationality;
                $epfFilter['salary'] = $basicSalary;
                $epf = new Epf();
                $epf = $this->epfRepository->findByFilter($epfFilter);
//                 dd($epf);
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

                // Step 6. Insert addition & deduction.
                $additionDeductionFilter = array();
                $additionDeductionFilter['companyId'] = $company->id;
                $additionDeductionFilter['status'] = $employee->status;
                $additionDeductionFilter['idJobMasterCategory'] = $employee->id_JobMaster_category;
                $additionDeductionFilter['idJobMasterGrade'] = $employee->id_JobMaster_grade;
                $additionList = $this->additionRepository->findByFilter($additionDeductionFilter)->toArray();
                $deductionList = $this->deductionRepository->findByFilter($additionDeductionFilter)->toArray();
                $additionArray = [];
                if (count($additionList)) {
                    foreach ($additionList as $addition) {
                        if ($addition['code'] == 'TAC' && $employee->payroll_type != 'HQ with travel allowance')
                            continue;
                        $data = [
                            'id_PayrollTrx' => $payrollTrxId,
                            'id_AdditionMaster' => $addition['id'],
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
                            'id_PayrollTrx' => $payrollTrxId,
                            'id_DeductionMaster' => $deduction['id'],
                            'amount' => $deduction['amount']
                        ];
                        $deductionArray[] = $data;
                    }
                    $this->payrollTrxDeductionRepository->storeArray($deductionArray);
                }
            }
        }
        DB::commit();
        return redirect('/payroll')->with('success', 'Payroll month has been added');

    }

    // Show payroll month
    public function show($id)
    {
        // TODO: show by security group and KPI proposer
        /*
         * HR Admin - show all
         * HR Exec by security group
         * KPI Proposer 
         */
//         $request[];
//         $request->request->add([
//             'payroll_id' => $id
//         ]);
        
        $forms = [
            'employee_id',
            'name',
            'position',
            'joined_date',
            'cb',
            'bs',
            'is',
            'total_addition',
            'total_deduction',
            'thp',
            'remark'
        ];

        // $list = $this->payrolltrx->all(true, $request->input());
        $isAdmin = Auth::user()->hasRole('admin'); 
        $payrollId = @$request['payroll_id'];
        $groupArray = @$request['group_array'];
        $viewerEmployeeId = @$request['viewer_employee_id'];
        $companyId = @$request['company_id'];
        $isHrAdminOrHrExec = Auth::user()->hasAnyRole('admin|hr-exec'); 
        $currentUser = auth()->user()->id;

        $list = PayrollTrx::join('payroll_master as pm', 'pm.id', '=', 'payroll_trx.payroll_master_id')
            ->join('employees as e', 'e.id', '=', 'payroll_trx.employee_id')
            ->join('users as u', 'u.id', '=', 'e.user_id') 
        /* ->join('countries as C', 'C.id', '=', 'EM.citizenship')  */
            ->join('employee_jobs as ej', function ($join) {
                $join->on('ej.emp_id', '=', 'e.id');
            })
            ->join('employee_positions as ep', 'ep.id', '=', 'ej.emp_mainposition_id')
            ->leftjoin('employee_report_to as ert', 'ert.emp_id', '=', 'e.id')
        /* ->join('job_master as JM2', 'JM2.id', '=', 'EJ.id_category')  */
        // ->leftjoin('EmployeeGroup as EG', 'EG.id_EmployeeMaster', '=', 'EM.id')
        /* ->leftjoin('employee_bank as EB', function($join){
            $join->on('EB.emp_id', '=', 'EM.emp_id')
            ->on('EB.acc_status', '=', DB::raw('"Active"'));
        }) */
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
        ->where(function($query) use($isHrAdminOrHrExec, $currentUser){
            if(!$isHrAdminOrHrExec) {
                $query->where('ert.report_to_emp_id', $currentUser);
            }
        })
        ->orderby('payroll_trx.id', 'ASC')->get();

        // Condition
        // if(!count($list)) return redirect('/payroll')->with('error', 'Payroll not found.');

        $payroll = PayrollMaster::where([
            [
                'id', $id
            ]
        ])->first();
        $title = 'Payroll Month (' . DateHelper::dateWithFormat(@$payroll->year_month, 'Y-m') . ')';
        return view('pages.payroll.show', compact('id', 'title', 'payroll', 'forms', 'list'));
    }

    public function updatePayrollStatus(Request $request, $id)
    {
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
//         dd($info);
//         $company = $this->company->find($info->company_id);
        //TODO: get report to 
        $currentUser = auth()->user()->id;
        $isKpiProposer = $this->employeeReportToRepository->isKpiProposer($info->employee_id, $currentUser); //$this->employeereportto->find_employee_in_charge($info->employee_id, Auth::user()->id);
        $info->is_in_charge = $isKpiProposer;
//         dd($isKpiProposer);
        $employee = $this->employeeRepository->find($info->employee_id)->first();
        $payrolltrx_additionForm = $this->payrollTrxAdditionRepository->findByPayrollTrxId($id);
        $payrolltrx_deductionForm = $this->payrollTrxDeductionRepository->findByPayrollTrxId($id);
//         dd($payrolltrx_additionForm);
        $employee_forms = ['employee_id', 'full_name', 'joined_date', 'resignation_date', 'confirmation_date', 'increment_date'];
        $salary_form;// = $this->payrolltrx->salary_form(@$info);
        $bonus_form;// = $this->payrolltrx->bonus_form(@$info);
//         $payrolltrx_additionForm = $this->payrollTrx->addition_form($payrolltrx_additionList);
//         $payrolltrx_deductionForm;// = $this->payrolltrx->deduction_form($payrolltrx_deductionList);
        $employeeContribution_form;// = $this->payrolltrx->employeeContribution_form(@$info);
        $employerContribution_form;// = $this->payrolltrx->employerContribution_form(@$info);
        
        $title = 'Payroll';
        $payroll_id = $info->id_PayrollMaster;
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
//         dd($info->is_in_charge);
        return view('pages.payroll.show-payroll-trx', compact('id', 'payroll_id', 'title', 'employee_forms', 'salary_form', 'bonus_form', 'payrolltrx_additionForm', 'payrolltrx_deductionForm', 'employeeContribution_form', 'employerContribution_form', 'info', 'company', 'employee', 'addition_days_array', 'addition_hours_array', 'deduction_days_array', 'year_month', 'total_days', 'is_in_charge'));
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
}
