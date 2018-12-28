<?php
namespace App\Enums;


use Konekt\Enum\Enum;

class PCBGroupEnum extends Enum
{
    const SINGLE_PERSON = 1;
    const SPOUSE_NOT_WORKING = 2;
    const SPOUSE_WORKING = 3;
    
    protected static $labels = [
        self::SINGLE_PERSON => 'Single Person',
        self::SPOUSE_NOT_WORKING => 'Spouse not working',
        self::SPOUSE_WORKING => 'Spouse working'
    ];
    
    public static function list()
    {
        return [
            'pcbGroup' => [
                self::SINGLE_PERSON => 'Single Person',
                self::SPOUSE_NOT_WORKING => 'Spouse not working',
                self::SPOUSE_WORKING => 'Spouse working'
            ],
            
        ];
    }
    
    public static function getDescription($value)
    {
        $desc = '';
        switch ($value) {
            case 1:
                $desc = 'Single Person';
                break;
            case 2:
                $desc = 'Spouse not working';
                break;
            case 3:
                $desc = 'Spouse working';
                break;
        }
        
        return $desc;
    }
}

