<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Schedule as WorkSchedule;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Schedule\StoreRequest;
use App\Helpers\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = WorkSchedule::orderBy('month', 'ASC')->get();

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

            $schedule = Schedule::createSchedule($schedule_data['days_in_month'], $schedule_data['first_day_index'], $schedule_data['first_week_day']);

            // dd($schedule);

            WorkSchedule::create([
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
    
    public function show(WorkSchedule $schedule)
    {
        $serialized_schedule = unserialize($schedule->schedule);
        $weeks = [];
        $week_N = 1;

        foreach ($serialized_schedule as $key => $day) {

            foreach ([1,2,3,4,5,6,7] as $week_day) {
                if (!isset($weeks[$week_N][$week_day])) {
                    $weeks[$week_N][$week_day] = [
                        "day" => "",
                        "work_shift" => "",
                        "week_day" => $week_day
                    ];
                }
            }

            $weeks[$week_N][$day['week_day']] = [
                "day" => $key,
                "work_shift" => $day["work_shift"],
                "week_day" => $day["week_day"],
            ];

            if ($day['week_day'] == 7) {
                $week_N = $week_N + 1;
            }
        }
// dd($weeks);
        return view('pages/admin/schedules/detail', compact('schedule', 'weeks'));
    }   
    
    public function destroy(WorkSchedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index')->with('info', 'Запись успешно удалена'); 
    }    
}
