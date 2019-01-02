<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use Carbon\Carbon;

use App\Http\Services\LeaveService;
use App\Constants\LeaveTypeRule;

use App\Employee;
use App\EmployeeJob;
use App\LeaveType;
use App\LeaveAllocation;
use App\TaskStatus;

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
        $year = (int) $this->argument('year');
        $now = Carbon::now();

        $this->info("Leave Allocation: Generate (Year: {$year})");
        if($year != $now->year) {
            $this->error("Leave can only be generated for the current year ({$now->year})!");
            return;
        }

        $taskStatus = TaskStatus::where('task', $this->task_name)->first();
        if(!empty($taskStatus)) {
            $status = json_decode($taskStatus->status);
            
            $latestYearProcessed = (int) $status->latest_processed_year;
             if($latestYearProcessed >= $year) {
                $this->error("Leave already processed for this year! ");
                return;
            } else if($year - $latestYearProcessed > 1) {
                $this->error("There are years where leave has not been generated in between the last generation ({$latestYearProcessed}) and year selected to generate ({$year})! ");
                return;
            }
        }

        DB::transaction(function() use ($year, $now) {
            // Get all employees (id) who have existing jobs
            $employee_ids = Employee::whereHas('employee_jobs', function($query) {
                $query->whereNull('end_date');
            })->pluck('id');

            $leave_types_can_carry_forward = LeaveType::with('applied_rules')->whereHas('applied_rules', function($query) {
                $query->where('rule', LeaveTypeRule::CAN_CARRY_FORWARD);
            })->get();

            $endOfPreviousYear = Carbon::create($year-1, 12, 31);

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

                            LeaveAllocation::create([
                                'leave_type_id' => $lt->id,
                                'emp_id' => $id,
                                'allocated_days' => $carryForwardDays,
                                'is_carry_forward' => true,
                                'valid_from_date' => $carryForwardValidFromDate,
                                'valid_until_date' => $carryForwardValidUntilDate
                            ]);
                        }
                    }
                    
                }
            }

            // GENERATE: Entitled Leave
            $leaveTypes = LeaveType::with('applied_rules', 'lt_conditional_entitlements', 'lt_entitlements_grade_groups.lt_conditional_entitlements', 'lt_entitlements_grade_groups.grades')->where('active', true)->get();
            $validFromDate = Carbon::create($year, 1, 1);
            $validUntilDate = Carbon::create($year, 12, 31);
            foreach($employee_ids as $emp_id) {
                // $this->info("Employee ({$emp_id})");

                $currentJob = EmployeeJob::where('emp_id', $emp_id)
                    ->whereNull('end_date')->first();

                // In order to calculate the leave allocations - we need to know how many years he has been working
                $yearsOfService = self::calculateEmployeeWorkingYears($emp_id, $validFromDate);
                foreach($leaveTypes as $leaveType) {
                    $allocatedDays = LeaveService::calculateEntitledDays($leaveType, $yearsOfService, $currentJob->emp_grade_id);

                    $leaveAllocation = LeaveAllocation::create([
                        'emp_id' => $emp_id,
                        'leave_type_id' => $leaveType->id,
                        'valid_from_date' => $validFromDate,
                        'valid_until_date' => $validUntilDate,
                        'allocated_days' => $allocatedDays,
                    ]);
                }
            }


            TaskStatus::updateOrCreate(
                ['task' => $this->task_name],
                ['status' => json_encode([
                    'latest_processed_year' => $year
                ])]
            );

            $this->info("Leave Allocation: Generate (Year: {$year}) -> COMPLETED");
        });
    }

    private static function calculateEmployeeWorkingYears($emp_id, $untilDateTime) {
        // Get start_date of first job
        $firstJob = EmployeeJob::where('emp_id', $emp_id)->orderBy('start_date')->first();
        if(empty($firstJob)) {
            return 0;
        } 

        $startDateTime = date_create($firstJob->start_date);
        
        return date_diff($startDateTime, $untilDateTime)->y;
    }
}
