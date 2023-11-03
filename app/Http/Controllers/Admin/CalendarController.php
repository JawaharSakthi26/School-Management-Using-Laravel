<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\RestControllerTrait;
use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    use RestControllerTrait;

    public $modelClass = Event::class;
    public $folderPath = 'admin';
    public $viewPath = 'event';
    public $routeName = 'calendar';
    public $message = 'Calendar';

    public function store(Request $request)
    {
        $data = $request->all();
        Event::create($data);

        return redirect()->route('calendar')->with('message', 'Event created successfully!');
    }

    //ajax request
    public function getEvent()
    {
        if (request()->ajax()) {
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
            $events = Event::whereDate('start', '>=', $start)->whereDate('end', '<=', $end)->get(['id', 'title', 'category', 'start', 'end']);
            return response()->json($events);
        }
        return view('admin.event.index');
    }

    //ajax request
    public function destroy(Request $request)
    {
        $event = Event::find($request->id);
        return $event->delete();
    }
}
