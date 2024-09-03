<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\Task\StoreRequest;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('rate', 'DESC')->get();

        return view('pages/site/tasks/manage', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::user()->id;
        return view('pages/site/tasks/update', compact('user_id'));
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

            $task = $request->all();

            if ($task['user_id'] != Auth::user()->id) {
                return redirect()->back()->with('status', 'not validated!'); 
            }

            Task::create($task);
            
            return redirect()->route('tasks.index')->with('info', 'Task has been added!'); 
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
    public function show(Task $task)
    {
        return view('pages/site/tasks/detail', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $user_id = Auth::user()->id;
        return view('pages/site/tasks/update', compact('user_id', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        // dd($task);



        if ($request->user_id != $task->user_id) {
            return redirect()->back()->with('status', 'not validated!'); 
        }

        $task->user_id = $request->user_id;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->rate = $request->rate;
        $task->update();

        return redirect()->route('tasks.index')->with('info', 'Task has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('info', 'Запись успешно удалена'); 
    }
}
