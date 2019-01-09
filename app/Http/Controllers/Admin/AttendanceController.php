<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Auth;
use Carbon\Carbon;
use App\Media;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|admin']);
    }

    public function getCurrentDayAttendance()
    {
        // get current day attendance data
        $attendances = DB::table('users')
        ->join('employees', 'users.id', '=', 'employees.user_id')
        ->join('employee_clock_in_out_records', 'employees.id', '=', 'employee_clock_in_out_records.emp_id')
        ->select('users.name','employees.code','employee_clock_in_out_records.*')
        ->whereDate('employee_clock_in_out_records.clock_in_time', Carbon::today())
        ->get();

        $result_array = array();

        foreach ($attendances as $row) {
            $result_array[$row->id]['code'] = $row->code;
            $result_array[$row->id]['name'] = $row->name;
            $result_array[$row->id]['clock_in_time'] = Carbon::parse($row->clock_in_time)->format('g:m:s a');
            $result_array[$row->id]['clock_in_lat'] = $row->clock_in_lat;
            $result_array[$row->id]['clock_in_long'] = $row->clock_in_long;
            $result_array[$row->id]['clock_in_address'] = $row->clock_in_address;
            $result_array[$row->id]['clock_in_status'] = $row->clock_in_status;
            $result_array[$row->id]['clock_in_reason'] = $row->clock_in_reason;
            $result_array[$row->id]['clock_out_time'] = $row->clock_out_time ? Carbon::parse($row->clock_out_time)->format('g:m:s a') : '';
            $result_array[$row->id]['clock_out_lat'] = $row->clock_out_lat;
            $result_array[$row->id]['clock_out_long'] = $row->clock_out_long;
            $result_array[$row->id]['clock_out_address'] = $row->clock_out_address;
            $result_array[$row->id]['clock_out_status'] = $row->clock_out_status;
            $result_array[$row->id]['clock_out_reason'] = $row->clock_out_reason;

            $media_in = Media::where('id', $row->clock_in_image_media_id)->first();
            $media_out = Media::where('id', $row->clock_out_image_media_id)->first();

            $media_in_img = '';
            $media_out_img = '';
            $media_na_img = 'http://placehold.jp/24/cccccc/ffffff/300x300.png?text=NA';

            if($media_in) {
                $media_in_img = 'data:'.$media_in->mimetype.';base64,'.$media_in->data;
            }
            else {
                $media_in_img = $media_na_img;
            }

            if($media_out) {
                $media_out_img = 'data:'.$media_out->mimetype.';base64,'.$media_out->data;
            }
            else {
                $media_out_img = $media_na_img;
            }

            $result_array[$row->id]['clock_in_media'] = $media_in_img;
            $result_array[$row->id]['clock_out_media'] = $media_out_img;
        }

        return view('pages.admin.attendance.current-day', ['attendances' => $result_array]);
    }
    
    public function getAttendanceReport($date = null)
    {
        if (!$date) {
            $date = Carbon::now()->format('Y-m-d');
        }

        // get attendance data
        $attendances = DB::table('users')
        ->join('employees', 'users.id', '=', 'employees.user_id')
        ->join('employee_attendances', 'employees.id', '=', 'employee_attendances.emp_id')
        ->select('users.name','employees.*','employee_attendances.*')
        ->where('employee_attendances.date', $date)
        ->get();

        // dd($attendances);

        return view('pages.admin.attendance.report', ['attendances' => $attendances, 'selected_date' => $date]);
    }
}
