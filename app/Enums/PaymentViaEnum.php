<?php
namespace App\Enums;


use Konekt\Enum\Enum;

class PaymentViaEnum extends Enum
{
    const CASH = 1;
    const BANK = 2;
    const CHEQUE = 3;
    const WITHHELD = 4;
    const CREDIT_NOTE = 5;
    
    protected static $labels = [
        self::CASH => 'Cash',
        self::BANK => 'Bank',
        self::CHEQUE => 'Cheque',
        self::WITHHELD => 'Withheld',
        self::CREDIT_NOTE => 'Credit Note'
    ];
    
    
    public static function list()
    {
        return [
            'paymentviaGroup' => [
               self::CASH => 'Cash',
                self::BANK => 'Bank',
                self::CHEQUE => 'Cheque',
                self::WITHHELD => 'Withheld',
                self::CREDIT_NOTE => 'Credit Note'
            ],
            
        ];
    }
    
    public static function getDescription($value)
    {
        $desc = '';
        switch ($value) {
            case 1:
                $desc = 'Cash';
                break;
            case 2:
                $desc = 'Bank';
                break;
            case 3:
                $desc = 'Cheque';
                break;
            case 4:
                $desc = 'Withheld';
                break;
            case 5:
                $desc = 'Credit Note';
                break;
        }
        
        return $desc;
    }
    
    public static function getValue($description)
    {
        $value = '';
        switch ($description) {
            case 'Cash':
                $value = 1;
                break;
            case 'Bank':
                $value = 2;
                break;
            case 'Cheque':
                $value = 3;
                break;
            case 'Withheld':
                $value = 4;
                break;
            case 'Credit Note':
                $value = 5;
                break;
        }
        return $value;
    }
}

