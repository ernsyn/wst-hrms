<?php
namespace App\Enums;


use Konekt\Enum\Enum;

class HolidayTypeEnum extends Enum
{
    const PAID_PUBLIC_HOLIDAY = 1;
    const REPLACEMENT_LEAVE = 2;
    
    protected static $labels = [
        self::PAID_PUBLIC_HOLIDAY => 'Paid Public Holiday',
        self::REPLACEMENT_LEAVE => 'Replacement Leave'
    ];
    
    public static function list()
    {
        return [
            'period' => [
                self::PAID_PUBLIC_HOLIDAY => 'Paid Public Holiday',
                self::REPLACEMENT_LEAVE => 'Replacement Leave'
            ],
            
        ];
    }
    
    public static function getDescription($value)
    {
        $desc = '';
        switch ($value) {
            case 1:
                $desc = 'Paid Public Holiday';
                break;
            case 2:
                $desc = 'Replacement Leave';
                break;
        }
        
        return $desc;
    }
}

