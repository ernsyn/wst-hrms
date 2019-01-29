<?php
namespace App\Enums;

use Konekt\Enum\Enum;

class EisCategoryEnum extends Enum
{
    const FIRST_CATEGORY = 1;
    
    protected static $labels = [
        self::FIRST_CATEGORY => 'First Category',
    ];
    
    public static function getDescription($value)
    {
        $desc = '';
        switch ($value) {
            case 1:
                $desc = 'First Category';
                break;
        }
        
        return $desc;
    }
}
