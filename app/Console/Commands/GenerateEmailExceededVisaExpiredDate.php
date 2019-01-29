<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Holiday;
use Carbon\Carbon;
use App\User;
use App\Mail\Visa;

class GenerateEmailExceededVisaExpiredDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employee_visa:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email If Visa Expired Date Less Than 6 Month';

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
        //
        $now = Carbon::now();

        // get holidays for current year
        $visa = EmployeeVisa::where('expiry_date', '>=', Carbon::now()->subDays(180)->toDateTimeString())
        ->orderBy('expiry_date', 'ASC')
        ->get();

        $emailData = array();

        foreach ($visas as $row) {
            $start = new Carbon($row->start_date);
            $end = new Carbon($row->end_date);
            $start_next = $start->addYear();
            $end_next = $end->addYear();

            // check if holiday has already been duplicated
            $check_exist = EmployeeVisa::where('name', $row->name)
            ->where('start_date', $start_next)
            ->where('end_date', $end_next)
            ->count() > 0;

            // duplicate holidays for next year
            if(!$check_exist) {
                array_push($emailData, $holidayData);
            }
        }

        if(!empty($emailData)) {
            $recipients = array();
        
            // get admin users
            $admin_users = User::whereHas("roles", function($q){ 
                $q->where("name", "admin");
            })->get();

            foreach ($admin_users as $row) {
                array_push($recipients, $row->email);
            }

            \Mail::to($recipients)->send(new VisaNotificationMail($emailData));

            $this->line('Email generated and notified Admins.');
        }        
    }
}
