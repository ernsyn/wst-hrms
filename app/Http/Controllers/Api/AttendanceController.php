<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Employee;
use App\EmployeeClockInOutRecord;
use App\Media;

use App\Http\Resources\EmployeeClockInOutRecord as EmployeeClockInOutRecordResource;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:employee']);
    }

    public function getAttendanceList() {
        $attendances = EmployeeClockInOutRecord::where('emp_id', Auth::user()->employee->id)->orderBy('clock_in_time', 'desc')->take(5)->get();
        // dd($attendances);
        return response()->json(EmployeeClockInOutRecordResource::collection($attendances), 200);  
    }

    public function postClockIn(Request $request)
    {
        $clockInData = $request->validate([
            'clock_in_image' => 'required',
            'clock_in_lat' => '',
            'clock_in_long' => '',
            'clock_in_address' => '',
            'clock_in_reason' => '',
        ]);
        
        $imageData = $this->processBase64DataUrl($clockInData['clock_in_image']);

        if(Auth::user()->employee->clock_in_out_records()->where('clock_out_time', null)->count() > 0) {
            return response()->json(['error' => 'Please clock-out your previous attendance first!'], 400);
        }

        $clockInData['clock_in_time'] = date('Y-m-d H:i:s');
        $clockInTime = Carbon::parse($clockInData['clock_in_time']);

        $clockInData['clock_in_status'] = 'normal';

        $workingDays = Auth::user()->employee->working_day;
        if($this->isWorkingDay($workingDays, $clockInTime) && !empty($workingDays->start_work_time)) {
            $startWorkTime = Carbon::parse($workingDays->start_work_time);
            if($clockInTime->greaterThan($startWorkTime)) {
                $clockInData['clock_in_status'] = 'late';
            }
        }
        
        $attendance = Auth::user()->employee->attendances()->create($clockInData);

        $clockInImage = Media::create([
            'category' => 'attendance-image',
            'mimetype' => $imageData['mime_type'],
            'data' => $imageData['data'],
            'size' => $imageData['size'],
            'filename' => 'attendance_'.(Auth::user()->employee->id).'_'.date('Y-m-d_H:i:s').".".$imageData['extension']
        ]);
        $attendance->clock_in_image()->associate($clockInImage);
        $attendance->save();

        return response()->json(new EmployeeClockInOutRecordResource($attendance), 200);    
    }

    public function postClockout(Request $request)
    {
        $clockOutData = $request->validate([
            'clock_out_image' => 'required',
            'clock_out_lat' => '',
            'clock_out_long' => '',
            'clock_out_address' => '',
            'clock_out_reason' => '',
        ]);
        
        $currentAttendance = Auth::user()->employee->attendances()->where('clock_out_time', null)->first();

        if(empty($currentAttendance)) {
            return response()->json(['error' => 'You are not currently clocked in.'], 400);
        }

        $imageData = $this->processBase64DataUrl($clockOutData['clock_out_image']);

        $clockOutData['clock_out_time'] = date('Y-m-d H:i:s');
        $clockOutTime = Carbon::parse($clockOutData['clock_out_time']);

        $clockOutData['clock_out_status'] = 'normal';

        $workingDays = Auth::user()->employee->working_day;
        if($this->isWorkingDay($workingDays, $clockOutTime) && !empty($workingDays->start_work_time)) {
            $endWorkTime = Carbon::parse($workingDays->end_work_time);
            if($clockOutTime->lessThan($endWorkTime)) {
                $clockOutData['clock_out_status'] = 'early';
            }
        }
        
        $currentAttendance->update($clockOutData);

        $clockOutImage = Media::create([
            'category' => 'attendance-image',
            'mimetype' => $imageData['mime_type'],
            'data' => $imageData['data'],
            'size' => $imageData['size'],
            'filename' => 'attendance_'.(Auth::user()->employee->id).'_'.date('Y-m-d_H:i:s').".".$imageData['extension']
        ]);
        $currentAttendance->clock_out_image()->associate($clockOutImage);
        $currentAttendance->save();

        return response()->json(new EmployeeClockInOutRecordResource($currentAttendance), 200);    
    }

    private function isWorkingDay($workingDays, $time) {
        switch($time->dayOfWeek) {
            case Carbon::MONDAY;
                return $workingDays->monday > 0;
                break;
            case Carbon::TUESDAY;
                return $workingDays->tuesday > 0;
                break;
            case Carbon::WEDNESDAY;
                return $workingDays->wednesday > 0;
                break;
            case Carbon::THURSDAY;
                return $workingDays->thursday > 0;
                break;
            case Carbon::FRIDAY;
                return $workingDays->friday > 0;
                break;
            case Carbon::SATURDAY;
                return $workingDays->saturday > 0;
                break;
            case Carbon::SUNDAY;
                return $workingDays->sunday > 0;
                break;
        }
    }

    private function processBase64DataUrl($dataUrl) {
        $parts = explode(',', $dataUrl);

        preg_match('#data:(.*?);base64#', $parts[0], $matches);
        $mimeType = $matches[1];
        $extension = explode('/', $mimeType)[1];

        $data = base64_decode($parts[1]);

        return [
            'data' => $data,
            'mime_type' => $mimeType,
            'size' => mb_strlen($data),
            'extension' => $extension
        ];
    }
}
