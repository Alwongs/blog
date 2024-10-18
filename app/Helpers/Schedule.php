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

    private static function getNextIndex($currentIndex)
    {
        if ($currentIndex < count(self::WORK_SCHEDULE) - 1) {
            return $currentIndex + 1;
        } else {
            return 0;
        }
    }

    private static function getNextWeekDay($currentWeekDay)
    {
        if ($currentWeekDay < count(Calendar::WEEK_DAYS)) {
            return $currentWeekDay + 1;
        } else {
            return 1;
        }
    }   
    
    public static function formatMonth($schedule)
    {
        $serialized_schedule = unserialize($schedule->schedule);
        $year = $schedule->year;
        $month = $schedule->month;
        $weeks = [];
        $week_N = 1;
        $currentTS = time();
        foreach ($serialized_schedule as $key => $day) {
            foreach ([1,2,3,4,5,6,7] as $week_day) {
                if (!isset($weeks[$week_N][$week_day])) {
                    $weeks[$week_N][$week_day] = [
                        "is_gone" => false,
                        "day" => "",
                        "work_shift" => "",
                        "week_day" => $week_day
                    ];
                }
            }
            $keyTS = strtotime($key . '-' . $month . '-' . $year);
            $is_gone = ($keyTS + 60*60*24 < $currentTS) ? true : false;
            $weeks[$week_N][$day['week_day']] = [
                "is_gone" => $is_gone,
                "day" => $key,
                "work_shift" => $day["work_shift"],
                "week_day" => $day["week_day"],
            ];
            if ($day['week_day'] == 7) {
                $week_N = $week_N + 1;
            }
        }
        return $weeks;        
    }
}
