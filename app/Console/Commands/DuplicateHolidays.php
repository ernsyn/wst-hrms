<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Holiday;
use Carbon\Carbon;
use App\User;
use App\Mail\HolidaysNotificationMail;

class DuplicateHolidays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'duplicate:holidays';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Duplicate annually repeatable Holidays from previous year into the new year.';

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
        $holidays = Holiday::where('repeat_annually', 1)
        ->whereYear('start_date', '=', $now->year)
        ->whereYear('end_date', '=', $now->year)
        ->orderBy('start_date', 'ASC')
        ->get();

        $emailData = array();

        foreach ($holidays as $row) {
            $start = new Carbon($row->start_date);
            $end = new Carbon($row->end_date);
            $start_next = $start->addYear();
            $end_next = $end->addYear();

            // check if holiday has already been duplicated
            $check_exist = Holiday::where('name', $row->name)
            ->where('start_date', $start_next)
            ->where('end_date', $end_next)
            ->count() > 0;

            // duplicate holidays for next year
            if(!$check_exist) {
                $holidayData = array();

                $holidayData['name'] = $row->name;
                $holidayData['start_date'] = $start_next;
                $holidayData['end_date'] = $end_next;
                $holidayData['note'] = $row->note;
                $holidayData['status'] = $row->status;
                $holidayData['repeat_annually'] = $row->repeat_annually;
                $holidayData['total_days'] = $row->total_days;
                $holidayData['state'] = $row->state;

                $holiday = new Holiday($holidayData);
                $holiday->save();

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

            \Mail::to($recipients)->send(new HolidaysNotificationMail($emailData));

            $this->line('Holidays generated and notified Admins.');
        }        
    }
}
