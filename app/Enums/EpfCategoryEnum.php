<?php
namespace App\Enums;

use Konekt\Enum\Enum;

class EpfCategoryEnum extends Enum
{
    const CATEGORY_A = 1;
    const CATEGORY_B = 2;
    const CATEGORY_C = 3;
    const CATEGORY_D = 4;
    const CATEGORY_E = 5;
    
    protected static $labels = [
        self::CATEGORY_A => 'Category A',
        self::CATEGORY_B => 'Category B',
        self::CATEGORY_C => 'Category C',
        self::CATEGORY_D => 'Category D',
        self::CATEGORY_E => 'Category E',
    ];
    
    public static function getDescription($value)
    {
        $desc = '';
        switch ($value) {
            case 1:
                $desc = 'Category A';
                break;
            case 2:
                $desc = 'Category B';
                break;
            case 3:
                $desc = 'Category C';
                break;
            case 4:
                $desc = 'Category D';
                break;
            case 5:
                $desc = 'Category E';
                break;
        }
        
        return $desc;
    }
}
