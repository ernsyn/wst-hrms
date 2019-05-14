<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use DB;
use Carbon\Carbon;

use App\Http\Services\LeaveService;
use App\Constants\LeaveTypeRule;

use App\Employee;
use App\EmployeeJob;
use App\LeaveType;
use App\LeaveAllocation;
use App\TaskStatus;
use App\Helpers\DateHelper;

class GenerateAnnualLeaveAllocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leave-allocation:generate {year}';
    protected $task_name = 'leave-allocation:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate annual leave allocation';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::debug("Start Generate Leave Allocation");
        $year = (int) $this->argument('year');
        $now = Carbon::now();

        $this->info("Leave Allocation: Generate (Year: {$year})");
        if($year != $now->year) {
            $this->error("Leave can only be generated for the current year ({$now->year})!");
            return;
        }

//         $taskStatus = TaskStatus::where('task', $this->task_name)->first();
//         if(!empty($taskStatus)) {
//             $status = json_decode($taskStatus->status);
            
//             $latestYearProcessed = (int) $status->latest_processed_year;
//              if($latestYearProcessed >= $year) {
//                 $this->error("Leave already processed for this year! ");
//                 return;
//             } else if($year - $latestYearProcessed > 1) {
//                 $this->error("There are years where leave has not been generated in between the last generation ({$latestYearProcessed}) and year selected to generate ({$year})! ");
//                 return;
//             }
//         }

        DB::transaction(function() use ($year, $now) {
            // Get all employees (id) who have existing jobs
            $employee_ids = Employee::whereHas('employee_jobs', function($query) use ($year) {
                $query->where([
                    ['status', '!=', 'Resigned']
                ])
                ->where(function($query) use ($year) {
                    $query->whereYear('end_date', '=', $year)
                    ->orWhereNull('end_date');
                });
            })->pluck('id');
                
            $leave_types_can_carry_forward = LeaveType::with('applied_rules')->whereHas('applied_rules', function($query) {
                $query->where('rule', LeaveTypeRule::CAN_CARRY_FORWARD);
            })->get();

            $endOfPreviousYear = Carbon::create($year-1, 12, 31);

            Log::debug("GENERATE: Carry Forward");
            foreach($leave_types_can_carry_forward as $lt) {
                $maxCarryForwardDays = 0;
                $validTillEndMonth = 1;
                foreach($lt->applied_rules as $rule) {
                    if($rule->rule == LeaveTypeRule::CAN_CARRY_FORWARD) {
                        $configuration = json_decode($rule->configuration);
                        $maxCarryForwardDays = (int) $configuration->max_carry_forward_days;
                        $validTillEndMonth = (int) $configuration->valid_till_end_month;
                    }
                }

                $carryForwardValidFromDate = Carbon::create($year, 1, 1);
                $carryForwardValidUntilDate = Carbon::create($year, $validTillEndMonth, 1)->endOfMonth();

                // $this->info("Leave Type ({$lt->name})");
                // $this->info("> Max Carry Forward Days ({$maxCarryForwardDays})");
                // $this->info("> Valid Till End Month ({$validTillEndMonth})");

                // GENERATE: Carry Forward
                // - Get leave for previous year (expires on last day of year)
                foreach($employee_ids as $id) {
                    // $this->info("Employee ({$id})");
    
                    $leaveAllocationsToCarryForward = LeaveAllocation::where('emp_id', $id)->where('leave_type_id', $lt->id)->where('is_carry_forward', false)->whereDate('valid_until_date', $endOfPreviousYear)->get();
                    foreach($leaveAllocationsToCarryForward as $leaveAllocation) {
                        // $this->info("Leave Allocation ({$leaveAllocation->id})");
                        $remainingDays = $leaveAllocation->allocated_days - $leaveAllocation->spent_days;

                        $carryForwardDays = $remainingDays > $maxCarryForwardDays? $maxCarryForwardDays : $remainingDays;
                        // $this->info("> Carry Forward Days ({$carryForwardDays})");

                        if($carryForwardDays > 0) {
                            $leaveAllocation->carried_forward_days = $carryForwardDays;
                            $leaveAllocation->save();

                            $allocatedLeave = LeaveAllocation::where([
                                ['emp_id', $id],
                                ['leave_type_id', $lt->id],
                                ['is_carry_forward', true],
                                ['valid_from_date', $carryForwardValidFromDate],
                                ['valid_until_date', $carryForwardValidUntilDate],
                            ])->first();
                            
                            if(empty($allocatedLeave)){
                                LeaveAllocation::create([
                                    'leave_type_id' => $lt->id,
                                    'emp_id' => $id,
                                    'allocated_days' => $carryForwardDays,
                                    'is_carry_forward' => true,
                                    'valid_from_date' => $carryForwardValidFromDate,
                                    'valid_until_date' => $carryForwardValidUntilDate
                                ]);
                            }else{
                                LeaveAllocation::find($allocatedLeave->id)->update(array(
                                    'valid_from_date' => $carryForwardValidFromDate,
                                    'valid_until_date' => $carryForwardValidUntilDate,
                                    'allocated_days' => $carryForwardDays,
                                ));
                            }
                        }
                    }
                }
            }
            
            Log::debug("End - GENERATE: Carry Forward");

            Log::debug("GENERATE: Entitled Leave");
            // GENERATE: Entitled Leave
            $leaveTypes = LeaveType::with('applied_rules', 'lt_conditional_entitlements', 'lt_entitlements_grade_groups.lt_conditional_entitlements', 'lt_entitlements_grade_groups.grades')->where('active', true)->get();
//             $validFromDate = Carbon::create($year, 1, 1);
//             $validUntilDate = Carbon::create($year, 12, 31);
            foreach($employee_ids as $emp_id) {
                // $this->info("Employee ({$emp_id})");
                // get employee job by year
                $jobs = EmployeeJob::where('emp_id', '=', $emp_id)
                    ->where('status', '!=', 'Resigned')
                    ->where(function($query) use ($year) {
                        $query->whereYear('end_date', '=', $year)
                        ->orWhereNull('end_date');
                    })
                    ->orderby('start_date')
                    ->get();
                Log::debug("Employee ID: ".$emp_id);
                Log::debug("Employee Jobs Year: ".$year);
                Log::debug("Total jobs: ".count($jobs));
                Log::debug($jobs);
                
                foreach($jobs as $job){
                    $validFromDate = Carbon::create($year, 1, 1);
                    $validUntilDate = Carbon::create($year, 12, 31);
                    if($job->start_date > $validFromDate){
                        $validFromDate = $job->start_date;
                    }
                    
                    if($job->end_date !=null){
                        $validUntilDate = $job->end_date;
                    }
                    if($emp_id == 10){
                    Log::debug("Job start date: ".$job->start_date);
                    Log::debug("Job end date: ".$job->end_date);
                    Log::debug($validFromDate);
                    Log::debug($validUntilDate);
                    }
//                     $currentJob = EmployeeJob::where('emp_id', $emp_id)
//                         ->whereNull('end_date')->first();
                    $validFromDate = Carbon::parse($validFromDate)->copy();
                    $validUntilDate = Carbon::parse($validUntilDate)->copy();
                    // In order to calculate the leave allocations - we need to know how many years he has been working
                    $yearsOfService = self::calculateEmployeeWorkingYears($emp_id, $validFromDate);
                    foreach($leaveTypes as $leaveType) {
                        $appliedRule = self::leaveTypeGetRule($leaveType, LeaveTypeRule::GENDER);
                        if(!empty($appliedRule)) {
                            $configuration = json_decode($appliedRule->configuration);
                            if(Employee::where('id', $emp_id)->where('gender', $configuration->gender)->count() == 0) {
                                continue;
                            }
                        }
    
                        $allocatedDaysInAYear = LeaveService::calculateEntitledDays($leaveType, $yearsOfService, $job->emp_grade_id);
                        $allocatedDays = 0;
                        if(LeaveService::leaveTypeHasRule($leaveType, LeaveTypeRule::NON_PRORATED)) {
                            Log::debug("Non prorated");
                            $allocatedDays = $allocatedDaysInAYear;
                        } else {
                            Log::debug("Prorated");
                            Log::debug("Different in days");
                            Log::debug($validFromDate->diffInDays($validUntilDate));
                            // $allocatedDays = $allocatedDaysInAYear * (12-$validFromDate->month+1) / 12;
                            $numberDaysInYear = 365 ;//+ $startDate->format('L');
                            Log::debug("Number of days in year: ".$numberDaysInYear);
                            $allocatedDays = $allocatedDaysInAYear * ($validFromDate->diffInDays($validUntilDate)) / $numberDaysInYear;
                            Log::debug("Allocated days before round: ".$allocatedDays);
                            $allocatedDays = floor($allocatedDays * 2)/2; // Round to closest .5 low
                            Log::debug("Allocated days after round: ".$allocatedDays);
                        }
                        Log::debug("Allocated days: ".$allocatedDays);
                        
                        if($job->status != 'Resigned'){
                            $validUntilDate = Carbon::create($year, 12, 31);
                        }
    
                        $allocatedLeave = LeaveAllocation::where([
                            ['emp_id', $emp_id],
                            ['leave_type_id', $leaveType->id],
                            ['valid_from_date', DateHelper::dateWithFormat($validFromDate, 'Y-m-d')],
                            ['valid_until_date', DateHelper::dateWithFormat($validUntilDate, 'Y-m-d')],
                        ])->first();
                        Log::debug("Allocated Leave");
                        Log::debug($allocatedLeave);
                        
                        if(empty($allocatedLeave)){
                            $leaveAllocation = LeaveAllocation::create([
                                'emp_id' => $emp_id,
                                'leave_type_id' => $leaveType->id,
                                'valid_from_date' => $validFromDate,
                                'valid_until_date' => $validUntilDate,
                                'allocated_days' => $allocatedDays,
                            ]);
                            
                        }else{
                            LeaveAllocation::find($allocatedLeave->id)->update(array(
                                'valid_from_date' => $validFromDate,
                                'valid_until_date' => $validUntilDate,
                                'allocated_days' => $allocatedDays,
                            ));
                        }
                        
//                         $leaveAllocation = LeaveAllocation::updateOrCreate([
//                             'emp_id' => $emp_id,
//                             'leave_type_id' => $leaveType->id,
//                             'valid_from_date' => $validFromDate,
//                             'valid_until_date' => $validUntilDate,
//                             'allocated_days' => $allocatedDays,
//                         ]);
                        
                        
                    }
                }
            }
            
            Log::debug("End - GENERATE: Entitled Leave");

            TaskStatus::updateOrCreate(
                ['task' => $this->task_name],
                ['status' => json_encode([
                    'latest_processed_year' => $year
                ])]
            );

            $this->info("Leave Allocation: Generate (Year: {$year}) -> COMPLETED");
        });
        
        Log::debug("End Generate Leave Allocation");
    }

    private static function calculateEmployeeWorkingYears($emp_id, $untilDateTime) {
        Log::debug("Calculate Employee Working Years");
        Log::debug("Employee ID: ".$emp_id);
        Log::debug("Until Date Time: ".$untilDateTime);
        
        // Get start_date of first job
        $firstJob = EmployeeJob::where('emp_id', $emp_id)->orderBy('start_date')->first();
        if(empty($firstJob)) {
            return 0;
        } 
        Log::debug($firstJob);
        $startDateTime = date_create($firstJob->start_date);
        Log::debug("Start Date Time: ".$startDateTime->format("Y-m-d H:m:s"));
        return date_diff($startDateTime, date_create($untilDateTime))->y;
    }

    private static function leaveTypeGetRule($leaveType, $rule) {
        foreach($leaveType->applied_rules as $applied_rule) {
            if($applied_rule->rule == $rule) {
                return $applied_rule;
            }
        }
    }
}
