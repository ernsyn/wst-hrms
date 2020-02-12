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
    
    public static function getValue($description)
    {
        $value = '';
        switch ($description) {
            case 'Daily':
                $value = 1;
                break;
            case 'Weekly':
                $value = 2;
                break;
            case 'Monthly':
                $value = 3;
                break;
        }
        return $value;
    }
}

