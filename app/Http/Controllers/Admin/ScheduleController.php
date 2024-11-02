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
        $weeksArray = [];
        foreach ($schedules as $schedule) {
            $weeksArray[] = ScheduleHelper::formatMonth($schedule)['weeks'];
        }

        return view('pages/admin/schedules/manage', compact('schedules', 'weeksArray'));
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
        $weeks = ScheduleHelper::formatMonth($schedule)['weeks'];
        $additional_data = ScheduleHelper::formatMonth($schedule)['additional_data'];

        return view('pages/admin/schedules/detail', compact('schedule', 'weeks', 'additional_data'));
    }   
    
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index')->with('info', 'Запись успешно удалена'); 
    }    
}
