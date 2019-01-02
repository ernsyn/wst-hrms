<?php

namespace App\Constants;

use Illuminate\Database\Eloquent\Model;

class AttendanceType
{
    const PRESENT = 'present';
    const ABSENT = 'absent';
    const LATE = 'late';
    const HOLIDAY =  'holiday';
    const OT_HOLIDAY =  'ot-holiday';
    const REST =  'rest';
    const OT_REST =  'ot-rest';
    const OFF =  'off';
    const OT_OFF =  'ot-off';
    const LEAVE =  'leave';
}


