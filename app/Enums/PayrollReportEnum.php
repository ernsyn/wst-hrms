<?php
namespace App\Enums;

use Konekt\Enum\Enum;

class PayrollReportEnum extends Enum
{
    const DOC_1 = 1;
    const DOC_2 = 2;
    const DOC_3 = 3;
    const DOC_4 = 4;
    const DOC_5 = 5;
    const DOC_6 = 6;
    const DOC_7 = 7;
    
    protected static $labels = [
        self::DOC_1 => 'Payroll Summary - By Department',
        self::DOC_2 => 'Payroll Summary - By Department, Cost Centre',
        self::DOC_3 => 'Supplier Payment Form',
        self::DOC_4 => 'Cash Transfer Document',
        self::DOC_5 => 'Bank Crediting Report',
        self::DOC_6 => 'Bank Crediting Report',
        self::DOC_7 => 'Payroll Summary'
    ];
}

