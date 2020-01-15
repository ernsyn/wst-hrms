<?php
namespace App\Enums;


use Konekt\Enum\Enum;

class AssetStatusEnum extends Enum
{
    const HOLD = 1;
    const RETURN = 2;
    const SOLD = 3;
    
    protected static $labels = [
        self::HOLD => 'Hold',
        self::RETURN => 'Return',
        self::SOLD => 'Sold',
    ];
    
    public static function getDescription($value)
    {
        $desc = '';
        switch ($value) {
            case 1:
                $desc = 'Hold';
                break;
            case 2:
                $desc = 'Return';
                break;
            case 3:
                $desc = 'Sold';
                break;
        }
        
        return $desc;
    }
}

