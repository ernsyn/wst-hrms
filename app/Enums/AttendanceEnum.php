<?php
namespace App\Enums;

use Konekt\Enum\Enum;

class AttendanceEnum extends Enum
{
    const PRESENT = 'present';
    const ABSENT = 'absent';
    const LATE = 'late';
    const OT_PUBLIC_HOLIDAY = 'ot-public-holiday';
    const OT_REST_DAY = 'ot-rest-day';
    const OT = 'ot-off-day';
}

