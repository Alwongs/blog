<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use App\Helpers\DateHelper;
use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', Auth::id())->orderBy('timestamp', 'ASC')->paginate(10);
        return view('pages/admin/events/manage', compact('events'));
    }

    public function create(Request $request)
    {
        $return_url = $request->return_url;
        return view('pages/admin/events/update', compact('return_url'));
    }

    public function store(StoreRequest $request)
    {
        if ($request->validated()) {

            if (!DateHelper::validateDate($request->date)) {
                return redirect()->back()->with('status', 'Not valid date!'); 
            }
    
            $event = $request->all();;
            $event['user_id'] = Auth::user()->id;
            $event['timestamp'] = (new DateHelper())->dateToTimestamp($request->date);
            unset($event['date']);
            
            Event::create($event);
    
            return redirect()->route($request->return_url)->with('info', 'Success!'); 
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Event $event)
    {
        $return_url = 'events.edit';
        return view('pages/admin/events/update', compact('event', 'return_url'));        
    }

    public function update(UpdateRequest $request, Event $event)
    {
        if ($request->validated()) {

            $event->event = $request->event;
            $event->description = $request->description;
            $event->timestamp = (new DateHelper())->dateToTimestamp($request->date);
            $event->type = $request->type;
            unset($event->date);
            $event->update();

            return redirect()->route('events.edit', compact('event'))->with('info', 'Success!'); 
        }
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->back()->with('info', 'Event successfully deleted!'); 
    }
}
