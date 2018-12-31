<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use Carbon\Carbon;

use App\TaskStatus;
use App\Employee;
use App\EmployeeJob;
use App\Holiday;
use App\EmployeeClockInOutRecord;
use App\EmployeeWorkingDay;
use App\EmployeeAttendance;
use App\LeaveRequest;

use App\Http\Services\LeaveService;
use App\Constants\AttendanceType;

class ProcessAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process Attendance: Generate employee attendances for each day based on clock-in.';

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
        // $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $currentDateProcessed = null;

        $this->info("Attendance: Processing...");
        $taskStatus = TaskStatus::where('task', $this->signature)->first();
        // $this->info($taskStatus);
        if(!empty($taskStatus)) {
            // $this->info("No task status found. Generating.");
            // TaskStatus::create([
            //     'task' => $this->signature,
            //     'status' => json_encode([
            //         'latest_processed_date' => '12/12/2018'
            //     ])
            // ]);

            // $this->info(gettype($taskStatus->status));
            $status = json_decode($taskStatus->status);
            
            // Check if same day - already run till today, skip
            // $this->info($status->latest_processed_date);
            $latestDateProcessed = Carbon::parse($status->latest_processed_date);
            if($latestDateProcessed->gte($yesterday)) {
                $this->info("Already processed till yesterdays date ({$latestDateProcessed->toDateString()}) -> Stopping task.");
                return;
            }

            $currentDateProcessed = $latestDateProcessed->copy()->addDay();
        } else {
            $currentDateProcessed = $yesterday->copy();
        }

        
        
        while($currentDateProcessed->lte($yesterday)) {
            // Run in a transaction - per day
            // Considerations - off day, holiday, emp has active job on that date, type of OT, leave, working day, clock-in start time date
            DB::transaction(function() use ($currentDateProcessed) {
                $processedDateString = $currentDateProcessed->toDateString();
                $this->info("[PROCESSING] Attendance (Date: {$processedDateString})");

                // Get all the employee (id) for the ones who are currently working in the company for the processed date
                $employee_ids = Employee::whereHas('employee_jobs', function($query) use ($processedDateString) {
                    $query->whereDate('start_date', '<=', $processedDateString)
                        ->where(function($query) use ($processedDateString) {
                            $query->whereNull('end_date')->orWhereDate('end_date', '>=', $processedDateString);
                        });
                })->pluck('id');
                foreach($employee_ids as $id) {

                    // CHECK: Holiday
                    // $this->info("> Employee: {$id}");
                    $jobOnDate = EmployeeJob::where('emp_id', $id)
                        ->whereDate('start_date', '<=', $processedDateString)
                        ->where(function($query) use ($processedDateString) {
                            $query->whereNull('end_date')->orWhereDate('end_date', '>=', $processedDateString);
                        })->first();

                    $isHoliday = false;
                    if(empty($jobOnDate->branch)) {
                        $this->warn("Job({$jobOnDate->id}) does not have a branch!");
                    } else {
                        // Check if there is a holiday for the branch state
                        $isHoliday = Holiday::where('status', 'active')
                        ->where('state', 'like', '%'.$jobOnDate->branch->state.'%')
                        ->whereDate('start_date', '<=', $processedDateString)
                        ->whereDate('end_date', '>=', $processedDateString)
                        ->count() > 0;
                    }

                    // CHECK: Off-Day, Rest-Day, Working-Day
                    if(!$isHoliday) {
                        $workingDay = EmployeeWorkingDay::where('emp_id', $id)->first();
                        if(empty($workingDay)) {
                            $this->warn("Employee ({$id}) does not working days set!");
                            continue; 
                        }
    
                        $workingDayType = $this->getWorkingDayType($workingDay, $currentDateProcessed);
                    }
                    

                    $clockInOutRecord = EmployeeClockInOutRecord::where('emp_id', $id)->whereDate('clock_in_time', $processedDateString)->first();

                    if($isHoliday) {
                        if(!empty($clockInOutRecord)) {
                            // $this->info("OT Holiday!");
                            EmployeeAttendance::create([
                               'emp_id' => $id,
                               'date' => $currentDateProcessed,
                               'attendance' => AttendanceType::OT_HOLIDAY
                            ]);
                        } else {
                            EmployeeAttendance::create([
                                'emp_id' => $id,
                                'date' => $currentDateProcessed,
                                'attendance' => AttendanceType::HOLIDAY
                             ]);
                        }
                    } else {
                        switch($workingDayType) {
                            case "off":
                            if(!empty($clockInOutRecord)) {
                                // $this->info("OT Off!");
                                EmployeeAttendance::create([
                                    'emp_id' => $id,
                                    'date' => $currentDateProcessed,
                                    'attendance' => AttendanceType::OT_OFF
                                ]);
                            } else {
                                EmployeeAttendance::create([
                                    'emp_id' => $id,
                                    'date' => $currentDateProcessed,
                                    'attendance' => AttendanceType::OFF
                                ]);
                            }
                            break;
                            case "rest":
                            if(!empty($clockInOutRecord)) {
                                // $this->info("OT Rest!");
                                EmployeeAttendance::create([
                                    'emp_id' => $id,
                                    'date' => $currentDateProcessed,
                                    'attendance' => AttendanceType::OT_REST
                                ]);
                            } else {
                                EmployeeAttendance::create([
                                    'emp_id' => $id,
                                    'date' => $currentDateProcessed ,
                                    'attendance' => AttendanceType::REST
                                ]);
                            }
                            break;
                            case "half":
                            case "full":
                            if(
                                // On Leave
                                LeaveRequest::where('emp_id', $id)
                                ->whereDay('start_date', '>=', $currentDateProcessed)
                                ->whereDay('end_date', '<=', $currentDateProcessed)
                                ->count() > 0
                            ) {
                                EmployeeAttendance::create([
                                    'emp_id' => $id,
                                    'date' => $currentDateProcessed ,
                                    'attendance' => AttendanceType::LEAVE
                                ]);
                            } else {
                                if(!empty($clockInOutRecord)) {
                                    // $this->info("Work!");
                                    $attendance = AttendanceType::PRESENT;
                                    if($clockInOutRecord->clock_in_status == 'late') {
                                        $attendance = AttendanceType::LATE;
                                    }
    
                                    EmployeeAttendance::create([
                                        'emp_id' => $id,
                                        'date' => $currentDateProcessed,
                                        'attendance' => $attendance
                                    ]);
                                } else {
                                    // $this->info("Absent!");
                                    EmployeeAttendance::create([
                                        'emp_id' => $id,
                                        'date' => $currentDateProcessed,
                                        'attendance' => AttendanceType::ABSENT
                                    ]);
                                }
                            }

                            break;
                        }
                    }
                }


                TaskStatus::updateOrCreate(
                    ['task' => $this->signature],
                    ['status' => json_encode([
                        'latest_processed_date' => $currentDateProcessed->toDateString()
                    ])]
                );
            });
            
            $currentDateProcessed->addDay();
        }
    }

    private static function getWorkingDayType($workingDays, $time) {
        switch($time->dayOfWeek) {
            case Carbon::MONDAY;
                return $workingDays->monday;
                break;
            case Carbon::TUESDAY;
                return $workingDays->tuesday;
                break;
            case Carbon::WEDNESDAY;
                return $workingDays->wednesday;
                break;
            case Carbon::THURSDAY;
                return $workingDays->thursday;
                break;
            case Carbon::FRIDAY;
                return $workingDays->friday;
                break;
            case Carbon::SATURDAY;
                return $workingDays->saturday;
                break;
            case Carbon::SUNDAY;
                return $workingDays->sunday;
                break;
        }
    }
}
