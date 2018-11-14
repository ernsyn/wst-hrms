<?php
namespace App\Enums;


use Konekt\Enum\Enum;

class PayrollPeriodEnum extends Enum
{
    const ADD_MONTH = 1;
    const MID_MONTH = 2;
    const END_MONTH = 3;
    
    protected static $labels = [
        self::ADD_MONTH => 'Add Month',
        self::MID_MONTH => 'Mid Month',
        self::END_MONTH => 'End Month'
    ];
    
    public static function list()
    {
        return [
            'period' => [
                self::ADD_MONTH => 'Add Month',
                self::MID_MONTH => 'Mid Month',
                self::END_MONTH => 'End Month'
            ],
            
        ];
    }
    
    public static function getDescription($value)
    {
        $desc = '';
        switch ($value) {
            case 1:
                $desc = 'Add Month';
                break;
            case 2:
                $desc = 'Mid Month';
                break;
            case 3:
                $desc = 'End Month';
                break;
        }
        
        return $desc;
    }
}

