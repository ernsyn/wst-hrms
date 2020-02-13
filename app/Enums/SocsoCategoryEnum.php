<?php
namespace App\Enums;

use Konekt\Enum\Enum;

class SocsoCategoryEnum extends Enum
{
    const FIRST_CATEGORY = 1;
    const SECOND_CATEGORY = 2;
    
    protected static $labels = [
        self::FIRST_CATEGORY => 'First Category',
        self::SECOND_CATEGORY => 'Second Category',
    ];
    
    public static function getDescription($value)
    {
        $desc = '';
        switch ($value) {
            case 1:
                $desc = 'First Category';
                break;
            case 2:
                $desc = 'Second Category';
                break;
        }
        
        return $desc;
    }
    
    public static function getValue($description)
    {
        $value = '';
        switch ($description) {
            case 'First Category':
                $value = 1;
                break;
            case 'Second Category':
                $value = 2;
                break;
        }
        
        return $value;
    }
}
