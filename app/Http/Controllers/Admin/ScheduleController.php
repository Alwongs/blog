<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Schedule\StoreRequest;
use App\Helpers\Schedule as ScheduleHelper;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::orderBy('month', 'ASC')->get();

        return view('pages/admin/schedules/manage', compact('schedules'));
    }

    public function create()
    {
        $user_id = Auth::user()->id;
        return view('pages/admin/schedules/update', compact('user_id'));
    }   
    
    public function store(StoreRequest $request)
    {
        if ($request->validated()) {

            $schedule_data = $request->all();

            if ($schedule_data['user_id'] != Auth::user()->id) {
                return redirect()->back()->with('status', 'not validated!'); 
            }

            $schedule = ScheduleHelper::createSchedule($schedule_data['days_in_month'], $schedule_data['first_day_index'], $schedule_data['first_week_day']);

            Schedule::create([
                'user_id' => $schedule_data['user_id'],
                'year' => $schedule_data['year'],
                'month' => $schedule_data['month'],
                'schedule' => serialize($schedule)
            ]);
            
            return redirect()->route('schedules.index')->with('info', 'Task has been added!'); 
        } else {
            return redirect()->back()->with('status', 'not validated!'); 
        }
    }   
    
    public function show(Schedule $schedule)
    {
        $serialized_schedule = unserialize($schedule->schedule);
        $weeks = [];
        $week_N = 1;

        $year = $schedule->year;
        $month = $schedule->month;
        $currentTS = time();

        foreach ($serialized_schedule as $key => $day) {

            foreach ([1,2,3,4,5,6,7] as $week_day) {
                if (!isset($weeks[$week_N][$week_day])) {
                    $weeks[$week_N][$week_day] = [
                        // "is_today" => false,
                        "is_gone" => false,
                        "day" => "",
                        "work_shift" => "",
                        "week_day" => $week_day
                    ];
                }
            }

            $keyTS = strtotime($key . '-' . $month . '-' . $year);
            $is_gone = ($keyTS + 60*60*24 < $currentTS) ? true : false;
            // $is_today = ($currentTS > $keyTS && $currentTS < $keyTS + 60*60*24) ? true : false;

            $weeks[$week_N][$day['week_day']] = [
                // "is_today" => $is_today,
                "is_gone" => $is_gone,
                "day" => $key,
                "work_shift" => $day["work_shift"],
                "week_day" => $day["week_day"],
            ];

            if ($day['week_day'] == 7) {
                $week_N = $week_N + 1;
            }
        }

        return view('pages/admin/schedules/detail', compact('schedule', 'weeks'));
    }   
    
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index')->with('info', 'Запись успешно удалена'); 
    }    
}
