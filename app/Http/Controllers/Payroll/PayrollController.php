<?php
namespace App\Http\Controllers\Payroll;

use App\Company;
use App\CostCentre;
use App\Employee;
use App\Epf;
use App\PayrollMaster;
use App\PayrollTrx;
use App\Enums\PayrollPeriodEnum;
use App\Helpers\DateHelper;
use App\Helpers\PayrollHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PayrollRequest;
use App\Repositories\Repository;
use App\Repositories\Payroll\AdditionRepository;
use App\Repositories\Payroll\DeductionRepository;
use App\Repositories\Payroll\EisRepository;
use App\Repositories\Payroll\EpfRepository;
use App\Repositories\Payroll\PayrollTrxRepository;
use App\Repositories\Payroll\PcbRepository;
use App\Repositories\Payroll\SocsoRepository;
use App\Services\PayrollService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enums\PayrollStatus;

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

    public function __construct(PayrollMaster $payrollMaster, PayrollService $payrollService, EpfRepository $epfRepository, EisRepository $eisRepository, 
        SocsoRepository $socsoRepository, PcbRepository $pcbRepository, PayrollTrxRepository $payrollTrxRepository, AdditionRepository $additionRepository,
        DeductionRepository $deductionRepository)
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
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: pagination
//         $payroll = $this->payrollMaster->with('Company');
        
        $payroll = PayrollMaster::leftJoin('companies', 'companies.id', '=', 'payroll_master.company_id')
        ->select('payroll_master.*','companies.name')->get();
//         ->paginate(10); //todo: .env
//         dd($payroll);

        $period = PayrollPeriodEnum::choices();
        return view('pages.payroll.index', compact('payroll', 'period'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $period = PayrollPeriodEnum::choices();
        // dd($period);
        return view('pages.payroll.create', [
            'period' => $period
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PayrollRequest $request)
    {
        // validate and store
        $validated = $request->validated();
        // check if payroll period exists
        // $payrollPeriodExists = PayrollMaster::where([
        // ['year_month', $validated['year_month'].'-01'],
        // ['period', $validated['period']]
        // ])->exists();
        // TODO: refactor to service
        $data = array_add([
            'year_month' => $request->input('year_month') . '-01'
        ], 'period', $request->input('period'));

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
            // $payroll->created_on = Carbon::now();
            $payroll->created_by = 1; // TODO: integrate auth to get current login user
            $payroll->updated_by = 1; // TODO: integrate auth to get current login user
                                      // $payroll->updated_on = Carbon::now();
            $payroll->save();

            $payrollId = $payroll->id;
            // $lastDayOfPayroll = DateHelper::getLastDayOfDate($validated['year_month'].'-01');
            $time = strtotime($validated['year_month'] . '-01');
            $payrollStartDate = date('Y-m-d', $time);
            // dd($payrollStartDate);
            // Step 3. Find all employees under this company, generate all employees' payroll trx.
            $employeeList = Employee::leftJoin('employee_jobs', 'employee_jobs.emp_id', '=', 'employees.id')->where([
                [
                    'company_id',
                    $company->id
                ]
            ])
                ->where(function ($query) use ($payrollStartDate) {
                // Either default or month/year greater or same
                $query->where('employee_jobs.id', DB::raw('(SELECT id FROM employee_jobs WHERE emp_id = employees.id AND start_date <= "' . $payrollStartDate . '" ORDER BY start_date DESC LIMIT 1)'));
            })
                ->get();
            var_dump($employeeList);
            foreach ($employeeList as $employee) {

                // Step 4. Find employee's payroll's required info.
                $employeeJob = $employee->employeeJob->sortByDesc('start_date', SORT_REGULAR)->first();
                // dd($employeeJob);
                $basicSalary = PayrollHelper::calculateSalary($employeeJob, $validated['year_month']);
                // dd($basicSalary);
                $costCentre = CostCentre::where('id', $employeeJob->cost_centre_id)->get();
                $seniorityPay = PayrollHelper::calculateSeniorityPay($employee, $validated['year_month'], $costCentre);
                // dd($seniorityPay);
                $payback = PayrollHelper::getPayback($employee, $validated['year_month']);

                $epfFilter = array();
                $epfFilter['age'] = PayrollHelper::getAge($employee->dob);
                $epfFilter['citizenship'] = $employee->citizenship;
                $epfFilter['salary'] = $basicSalary;
                $epf = new Epf();
                $epf = $this->epfRepository->findByFilter($epfFilter);
                // dd($epf);
                $eis = $this->eisRepository->findBySalary($basicSalary);
                $socso = $this->socsoRepository->findBySalary($basicSalary);
                $pcbFilter = array();
                $pcbFilter['salary'] = $basicSalary;
                $pcbFilter['pcbGroup'] = $employee->pcb_group;
                $pcbFilter['noOfChildren'] = $employee->total_child;
                $pcb = $this->pcbRepository->findByFilter($pcbFilter);
                // Step 5. Create payroll trx.
                $payrollTrxData = array();
                $payrollTrxData['payroll_master_id'] = $payrollId;
                $payrollTrxData['employee_id'] = $employee->emp_id;
                $payrollTrxData['employee_epf'] = $epf->employee;
                $payrollTrxData['employee_eis'] = $eis->employee;
                $payrollTrxData['employee_socso'] = $socso->first_category_employee;
                $payrollTrxData['employee_pcb'] = $pcb->amount;
                $payrollTrxData['employer_epf'] = $epf->employer;
                $payrollTrxData['employer_eis'] = $eis->employer;
                $payrollTrxData['employer_socso'] = $socso->first_category_employer;
                $payrollTrxData['seniority_pay'] = $seniorityPay;
                $payrollTrxData['basic_salary'] = $basicSalary;
                $payrollTrxData['take_home_pay'] = 0;
                $payrollTrxData['created_by'] = 1;
                // $payrollTrxData['created_on'] = Carbon::now();
                $payrollTrxData['updated_by'] = 1;
                // $payrollTrxData['updated_on'] = Carbon::now();
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

    /**
     * Display the specified resource.
     *
     * @param \App\PayrollMaster $payrollMaster
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // TODO: show by security group and report to
//         $request[];
//         $request->request->add([
//             'payroll_id' => $id
//         ]);
        $forms = [
            'employee_id',
            'full_name',
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
        $isAdmin = 1; // (Auth::user()->role->name == 'Admin' || Auth::user()->role->name == 'Superadmin')? 1 : 0;
        $payrollId = @$request['payroll_id'];
        $groupArray = @$request['group_array'];
        $viewerEmployeeId = @$request['viewer_employee_id'];
        $companyId = @$request['company_id'];

        $list = PayrollTrx::join('payroll_master as PM', 'PM.id', '=', 'payroll_trx.payroll_master_id')->join('employees as EM', 'EM.id', '=', 'payroll_trx.employee_id')
            ->join('users as U', 'U.id', '=', 'EM.user_id') 
        /* ->join('countries as C', 'C.id', '=', 'EM.citizenship')  */
        ->join('employee_jobs as EJ', function ($join) {
            $join->on('EJ.emp_id', '=', 'EM.id');
//                 ->on('EJ.default', '=', DB::raw('"1"'));
        })
            ->join('cost_centres as JM', 'JM.id', '=', 'EJ.emp_mainposition_id')
        /* ->join('job_master as JM2', 'JM2.id', '=', 'EJ.id_category')  */
        // ->leftjoin('EmployeeGroup as EG', 'EG.id_EmployeeMaster', '=', 'EM.id')
        /* ->leftjoin('employee_bank as EB', function($join){
            $join->on('EB.emp_id', '=', 'EM.emp_id')
            ->on('EB.acc_status', '=', DB::raw('"Active"'));
        }) */
        ->select('payroll_trx.*', 'PM.company_info_id as company_id', 'PM.year_month', 'PM.period', 'PM.status', 'EM.emp_id as employee_id', 'EM.code as employee_code', 'JM.job_name as position', 'payroll_trx.basic_salary as bs', 'payroll_trx.seniority_pay as is', 'payroll_trx.note as remark', DB::raw('
                (SELECT start_date FROM employee_job WHERE emp_id = EM.emp_id ORDER BY id ASC LIMIT 1) as joined_date,
                (payroll_trx.basic_salary + payroll_trx.seniority_pay) as cb,
                (payroll_trx.basic_salary + payroll_trx.seniority_pay) as contract_base,
                (SELECT SUM(amount) FROM payroll_trx_addition WHERE payroll_trx_id = payroll_trx.id) as total_addition,
                (SELECT SUM(amount) FROM payroll_trx_deduction WHERE payroll_trx_id = payroll_trx.id) as total_deduction,
                payroll_trx.take_home_pay as thp,
                ROUND((payroll_trx.kpi * payroll_trx.bonus),2) as total_bonus,
                YEAR(CURDATE()) - YEAR(EM.dob) as age
            '))
            ->
        // ->leftjoin('EmployeeGroup as EG', 'EG.id_EmployeeMaster', '=', 'EM.id')
        /* ->leftjoin('employee_report_to as ERT', 'ERT.emp_id', '=', 'EM.emp_id') */
        where(function ($query) use ($payrollId) {
            if ($payrollId)
                $query->where('payroll_trx.payroll_master_id', $payrollId);
        })
        /* ->where(function($query) use($groupArray, $isAdmin, $viewerEmployeeId){
            if(($groupArray || !$isAdmin)) {
                $query->whereIn('EM.id_GroupMaster', $groupArray)
                ->orwhereIn('EM.emp_id', $viewerEmployeeId);
            }
            if($viewerEmployeeId) $query->orwhereIn('ERT.report_id_EmployeeMaster', $viewerEmployeeId);
        }) */
        /* ->where(function($query) use($companyId){
            if($companyId) $query->where('PM.company_info_id', $companyId);
        })  */
        ->groupby('payroll_trx.id')
            ->orderby('payroll_trx.id', 'ASC')
            ->paginate(10);

        // Condition
        // if(!count($list)) return redirect('/payroll')->with('error', 'Payroll not found.');

        $payroll = PayrollMaster::where([
            [
                'id',
                $id
            ]
        ])->first();
        $title = 'Payroll Month (' . @$payroll->year_month . ')';
        return view('pages.payroll.show', compact('id', 'title', 'payroll', 'forms', 'list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\PayrollMaster $payrollMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(PayrollMaster $payrollMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\PayrollMaster $payrollMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PayrollMaster $payrollMaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\PayrollMaster $payrollMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayrollMaster $payrollMaster)
    {
        //
    }

    public function updatePayrollStatus(Request $request, $id)
    {
        $info = PayrollMaster::where([
            [
                'id',
                $id
            ]
        ])->get();
//             dd($info);
        if (! @$info)
            return redirect($request->server('HTTP_REFERER'))->with('error', 'Payroll not found.');

        DB::beginTransaction();
        $storeData = [];
        $storeData['status'] = $request['status'];
        $storeData['updated_by'] = 1; // Auth::user()->id;
        PayrollMaster::where('id', $id)->update($storeData);
        DB::commit();

        return redirect($request->server('HTTP_REFERER'))->with('success', 'Payroll month '.DateHelper::dateWithFormat($info[0]->year_month, 'Y-m').' is '. strtolower(new PayrollStatus($request['status'])).'.');
    }
}
