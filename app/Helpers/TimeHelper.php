<?php

namespace App\Helpers;

class TimeHelper
{
    public static function countDurationTime($period)
    {
        $time_from_ts = strtotime('1970-01-01 ' . $period->time_from . ':00');
        $time_to_ts = strtotime('1970-01-01 ' . $period->time_to . ':00');

        return ($time_to_ts - $time_from_ts) / 60;      
    }
}
