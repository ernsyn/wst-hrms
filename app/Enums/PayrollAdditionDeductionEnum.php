<?php
namespace App\Enums;


use Konekt\Enum\Enum;

class PayrollAdditionDeductionEnum extends Enum
{
    const OT = 'OT';
    const ALP = 'ALP';
    const CFLP = 'CFLP';
    const PH = 'ot-public-holiday';
    const RD = 'ot-rest-day';
    const UL = 'UL';
    const OD = 'ot-off-day';
    
    protected static $labels = [
        self::OT => 'Overtime',
        self::ALP => 'Annual Leave Payback',
        self::CFLP => 'Carry Forward Leave Payback',
        self::PH => 'Public Holiday',
        self::RD => 'Rest Day',
        self::UL => 'Unpaid Leave',
        self::OD => 'Off Day'
    ];
}

