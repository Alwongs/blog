<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManageDay;
use App\Models\Color;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ManageDay\StoreRequest;
use App\Helpers\TimeHelper;
use App\Enum\Status;

class ManageDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $manage_days = ManageDay::orderBy('position', 'ASC')->get();

        return view('pages/site/manage_days/manage', compact('manage_days'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        $colors = Color::all();
        return view('pages/site/manage_days/update', compact('user_id', 'colors'));
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

            $manage_day = $request->all();

            if ($manage_day['user_id'] != Auth::user()->id) {
                return redirect()->back()->with('status', 'not validated!'); 
            }

            ManageDay::create($manage_day);
            
            return redirect()->route('manage-days.index')->with('info', 'Task has been added!'); 
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
    public function show(ManageDay $manage_day)
    {

        $sum = 0;
        foreach ($manage_day->manageTimes as $manage_time) {

            $time = TimeHelper::countDurationTime($manage_time);
            $manage_time->duration_time = $time;
            if ($manage_time->status == Status::ACTIVE) {
                $sum = $sum + $time;
            }
        }

        $general_time = $sum;

        return view('pages/site/manage_times/manage', compact('manage_day', 'general_time'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageDay $manage_day)
    {
        $colors = Color::all();
        return view('pages/site/manage_days/update', compact('manage_day', 'colors')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageDay $manage_day)
    {
        $manage_day->color_id = $request->color_id;
        $manage_day->position = $request->position;
        $manage_day->title = $request->title;
        $manage_day->user_id = $request->user_id;
        $manage_day->update();

        return redirect()->route('manage-days.index')->with('info', 'Product list has been updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageDay $manage_day)
    {
        $manage_day->delete();

        return redirect()->back()->with('info', 'Запись успешно удалена'); 
    }
}
