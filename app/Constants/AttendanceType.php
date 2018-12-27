<?php

namespace App\Constants;

use Illuminate\Database\Eloquent\Model;

class AttendanceType
{
    const PRESENT = 'present';
    const ABSENT = 'absent';
    const LATE = 'late';
    const OT_HOLIDAY =  'ot-holiday';
    const OT_REST =  'ot-rest';
    const OT_OFF =  'ot-off';
}


