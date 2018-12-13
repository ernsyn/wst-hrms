<?php
namespace App\Enums;

use Konekt\Enum\Enum;

class StatusEnum extends Enum
{
    const INACTIVE = 0;
    const ACTIVE = 1;
    
    protected static $labels = [
        self::INACTIVE => 'Inactive',
        self::ACTIVE => 'Active'
    ];
    
    public static function getDescription($value)
    {
        $desc = 'Inactive';
        switch ($value) {
            case 0:
                $desc = 'Inactive';
                break;
            case 1:
                $desc = 'Active';
                break;
        }
        
        return $desc;
    }
    
}

