<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddClass;
use App\Models\ClassTimetable;
use App\Models\Day;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimeTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher = Teacher::where('status', '1')->get();
        $class = AddClass::where('status', '1')->get();
        $week_days = Day::all();
        return view('admin.timetable.index', compact('class', 'teacher', 'week_days'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teacher = Teacher::where('status', '1')->get();
        $class = AddClass::where('status', '1')->get();
        return view('admin.timetable.create', compact('teacher', 'class'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ClassTimetable::where('class_id',$request->class_id)->where('subject_id',$request->subject_id)->delete();

        foreach ($request->timetable as $timetable) {
            ClassTimetable::create([
                'user_id' => Auth::user()->id,
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id,
                'day_id' =>  $timetable['day_id'],
                'start_time' => $timetable['start_time'],
                'end_time' => $timetable['end_time']
            ]);
        }
        return redirect()->back()->with('success','Class Timetable Saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function fetchSubjects($classId)
    {

        $class = AddClass::find($classId);
        $subjects = $class->subjects;

        $subjectArray = [];
        foreach ($subjects as $subject) {
            $subjectArray[$subject->id] = $subject->subjects->name;
        }
        return response()->json($subjectArray);
    }
}
