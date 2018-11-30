<?php

namespace App\Constants;

use Illuminate\Database\Eloquent\Model;

class EmploymentStatusNaming
{
    private static $naming = [
        'transferred' => 'Transferred',
        'probationer' => 'Probationer',
        'confirmed-employment' => 'Confirmed Employment',
        'confirmed-promotion' => 'Confirmed Promotion',
    ];

    public static function get($key) {
        if(array_key_exists($key, self::$naming)) {
            return self::$naming[$key];
        } else {
            return $key;
        }
    }
}
