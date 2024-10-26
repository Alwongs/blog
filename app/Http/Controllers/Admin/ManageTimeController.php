<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ManageTime\StoreRequest;
use App\Models\ManageTime;

class ManageTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manage_day_id = $_REQUEST['manage_day_id'];

        return view('pages/site/manage_times/update', compact('manage_day_id'));
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

            $manage_time = $request->all();

            // $manage_time['time_from'] = $manage_time['time_from']['hours'] . ":" . $manage_time['time_from']['minutes'];
            // $manage_time['time_to'] = $manage_time['time_to']['hours'] . ":" . $manage_time['time_to']['minutes'];

            ManageTime::create($manage_time);
            
            return redirect()->route('manage-days.show', $manage_time['manage_day_id'])->with('info', 'Post has been added!'); 
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
    public function edit(ManageTime $manage_time)
    {
        $manage_day_id = $manage_time->manage_day_id;

        return view('pages/site/manage_times/update', compact('manage_time', 'manage_day_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageTime $manage_time)
    {
        $manage_time->manage_day_id = $request->manage_day_id;
        $manage_time->title = $request->title;
        $manage_time->time_from = $request->time_from;
        $manage_time->time_to = $request->time_to;
        $manage_time->status = $request->status;
        $manage_time->update();

        return redirect()->route('manage-days.show', $request->manage_day_id)->with('info', 'Post has been updated!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageTime $manage_time)
    {
        $manage_time->delete();

        return redirect()->back()->with('info', 'Запись успешно удалена'); 
    }
}
