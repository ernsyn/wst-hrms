<?php
namespace App\Enums;


use Konekt\Enum\Enum;

class PaymentRateEnum extends Enum
{
    const DAILY = 1;
    const WEEKLY = 2;
    const MONTHLY = 3;
    
    protected static $labels = [
        self::DAILY => 'Daily',
        self::WEEKLY => 'Weekly',
        self::MONTHLY => 'Monthly'
    ];
    
    
    public static function list()
    {
        return [
            'paymentrateGroup' => [
                self::DAILY => 'Daily',
                self::WEEKLY => 'Weekly',
                self::MONTHLY => 'Monthly'
            ],
            
        ];
    }
    
    public static function getDescription($value)
    {
        $desc = '';
        switch ($value) {
            case 1:
                $desc = 'Daily';
                break;
            case 2:
                $desc = 'Weekly';
                break;
            case 3:
                $desc = 'Monthly';
                break;
        }
        
        return $desc;
    }
}

