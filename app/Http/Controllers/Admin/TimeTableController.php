<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddClass;
use App\Models\ClassTimetable;
use App\Models\Day;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimeTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $teacher = Teacher::where('status', '1')->get();
        $class = AddClass::where('status', '1')->get();
        $week_days = Day::orderBy('id')->get();
        $teachers = Teacher::all();

        $classId = $request->input('class_id');
        $subjectId = $request->input('subject_id');
    
        $timetableData = [];
    
        if ($classId && $subjectId) {
            $timetableData = DB::table('class_timetables')
                ->where('class_id', $classId)
                ->where('subject_id', $subjectId)
                ->get();
        }   
    
        return view('admin.timetable.index', compact('class', 'teacher', 'week_days', 'timetableData', 'teachers'));
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
                'teacher_id' => $request->teacher_id,
                'day_id' =>  $timetable['day_id'],
                'start_time' => $timetable['start_time'],
                'end_time' => $timetable['end_time']
            ]);
        }
        return redirect()->back()->with('message','Class Timetable Saved!');
    }

    public function fetchSubjects($classId)
    {
        $class = AddClass::find($classId);
        $subjects = $class->subjects;

        $subjectArray = [];
        foreach ($subjects as $subject) {
            $subjectArray[$subject->subjects->id] = $subject->subjects->name;
        }
        return response()->json($subjectArray);
    }
}
