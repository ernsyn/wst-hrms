<?php
namespace App\Helpers;

class DateHelper
{
    public static function getLastDayOfDate($date)
    {
        return date("Y-m-t", strtotime($date));
    }
    
    public static function dateWithFormat($date, $format)
    {
        return date($format, strtotime($date));
    }
}

