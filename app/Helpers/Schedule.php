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
        $week_number = 1;
        $currentTS = time();

        $work_days_qty = 0;
        $work_nights_qty = 0;
        $days_off_qty = 0;

        foreach ($serialized_schedule as $key => $day) {
            foreach ([1,2,3,4,5,6,7] as $week_day) {
                if (!isset($weeks[$week_number][$week_day])) {
                    $weeks[$week_number][$week_day] = [
                        "is_gone" => false,
                        "day" => "",
                        "work_shift" => "",
                        "week_day" => $week_day
                    ];
                }
            }
            $keyTS = strtotime($key . '-' . $month . '-' . $year);

            // timezone shifts
            if ($day["work_shift"] == self::DAY) {

                $is_gone = ($keyTS + 60*60*24 < $currentTS - 8 * 3600) ? true : false;
                $work_days_qty = $work_days_qty + 1;

            } else if ($day["work_shift"] == self::NIGHT) {

                $is_gone = ($keyTS + 60*60*24 < $currentTS + 4 * 3600) ? true : false;
                $work_nights_qty = $work_nights_qty + 1;

            } else if ($day["work_shift"] == self::DAY_OFF) {

                $is_gone = ($keyTS + 60*60*24 < $currentTS - 4 * 3600) ? true : false;
                $days_off_qty = $days_off_qty + 1;

            }

            $weeks[$week_number][$day['week_day']] = [
                "is_gone" => $is_gone,
                "day" => $key,
                "work_shift" => $day["work_shift"],
                "week_day" => $day["week_day"],
            ];
            if ($day['week_day'] == 7) {
                $week_number = $week_number + 1;
            }
        }
        return [
            'weeks' => $weeks,
            'additional_data' => [
                "work_days_qty" => $work_days_qty,
                "work_nights_qty" => $work_nights_qty,
                "days_off_qty" => $days_off_qty,
            ]
        ];        
    }
}
