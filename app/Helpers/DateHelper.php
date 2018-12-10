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
    
    public static function getPastNMonthDate($date, $month)
    {
        return date("Y-m-d", strtotime( date($date)." -".$month." months") );
    }
    
    public static function getNumberDaysInMonth($date)
    {
        $date = explode('-', $date);
        return cal_days_in_month(CAL_GREGORIAN, $date[1], $date[0]);
    }
}

