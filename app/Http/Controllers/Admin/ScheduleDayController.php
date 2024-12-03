<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ScheduleDay;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ScheduleDay\StoreRequest;
use App\Helpers\ScheduleDay as ScheduleDayHelper;

class ScheduleDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule_days = ScheduleDay::orderBy('timestamp', 'ASC')->get()->groupBy(['year', 'month']);

        // dd($schedule_days);

        return view('pages/admin/schedule_days/manage', compact('schedule_days'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        return view('pages/admin/schedule_days/update', compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        if ($request->validated()) {
            $schedule_data = $request->all();

            ScheduleDayHelper::createMonthSchedule($schedule_data);

            return redirect()->route('schedule-days.index')->with('info', 'Task has been added!'); 
        } else {
            return redirect()->back()->with('status', 'not validated!'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ScheduleDay $scheduleDay)
    {
        return view('pages/admin/schedule_days/update_day', compact('scheduleDay'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleDay $scheduleDay)
    {

        $scheduleDay->shift_type = $request->shift_type;
        $scheduleDay->description = $request->description;
        $scheduleDay->update();

        return redirect()->route('schedule-days.index')->with('info', 'Day has been updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
