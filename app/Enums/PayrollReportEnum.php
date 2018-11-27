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
    
    protected static $labels = [
        self::DOC_1 => 'Payroll Report',
        self::DOC_2 => 'Supplier Payment Form',
        self::DOC_3 => 'Department Salary',
        self::DOC_4 => 'Payroll Detail',
        self::DOC_5 => 'Bank Credit Detail',
        self::DOC_6 => 'Payroll Summary'
    ];
}

