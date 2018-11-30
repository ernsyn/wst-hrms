<?php
namespace App\Enums;

use Konekt\Enum\Enum;

class PayrollStatus extends Enum
{
    const UNLOCK = 0;
    const LOCKED = 1;
    
    protected static $labels = [
        self::UNLOCK => 'Unlock',
        self::LOCKED => 'Locked'
    ];
    
    public static function list()
    {
        return [
            'payrollStatus' => [
                self::UNLOCK => 'Unlock',
                self::LOCKED => 'Locked'
            ],
            
        ];
    }
}

