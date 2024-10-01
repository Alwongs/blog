<?php

namespace App\Helpers;

use App\Enum\Calendar;

class Schedule
{
    const DAY = 'D';
    const NIGHT = 'N';
    const DAY_OFF = 'O';

    const FULL_DAY_PERIOD = [
        self::DAY => 'Day',
        self::NIGHT => 'Night',
        self::DAY_OFF => 'Day off'
    ];

    const WORK_SCHEDULE = [
        self::DAY, self::DAY, self::DAY,
        self::DAY_OFF, self::DAY_OFF, self::DAY_OFF,
        self::NIGHT, self::NIGHT, self::NIGHT,
        self::DAY_OFF, self::DAY_OFF, self::DAY_OFF,
    ];  

    public static function createSchedule($days_in_month, $first_day_index, $first_week_day)
    {
        $currentDay = 1;
        $currentIndex = $first_day_index;
        $currentWeekDay = $first_week_day;
        $new_array = [];
        while ($currentDay <= $days_in_month) {
            $new_array[$currentDay]['work_shift'] = self::WORK_SCHEDULE[$currentIndex];
            $new_array[$currentDay]['week_day'] = $currentWeekDay;


            $currentDay = $currentDay + 1;
            $currentIndex = self::getNextIndex($currentIndex);
            $currentWeekDay = self::getNextWeekDay($currentWeekDay);
        }
        return $new_array;
    }

    public static function getNextIndex($currentIndex)
    {
        if ($currentIndex < count(self::WORK_SCHEDULE) - 1) {
            return $currentIndex + 1;
        } else {
            return 0;
        }
    }

    public static function getNextWeekDay($currentWeekDay)
    {
        if ($currentWeekDay < count(Calendar::WEEK_DAYS)) {
            return $currentWeekDay + 1;
        } else {
            return 1;
        }
    }    
}
