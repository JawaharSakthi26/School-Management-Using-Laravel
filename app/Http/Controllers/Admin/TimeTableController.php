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
        ClassTimetable::where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->delete();

        $data = $request->all();

        foreach ($request->timetable as $timetable) {
            $dayId = $timetable['day_id'];
            $startTime = $timetable['start_time'];
            $endTime = $timetable['end_time'];

            $existingTimetable = ClassTimetable::where('class_id', $data['class_id'])
                ->where('day_id', $dayId)
                ->where('start_time', $startTime)
                ->where('end_time', $endTime)
                ->first();

            $existingTeacherTimetable = ClassTimetable::where('teacher_id', $data['teacher_id'])
                ->where('day_id', $dayId)
                ->where('start_time', $startTime)
                ->where('end_time', $endTime)
                ->first();

            if (!$existingTimetable && !$existingTeacherTimetable) {
                ClassTimetable::create([
                    'user_id' => Auth::user()->id,
                    'class_id' => $data['class_id'],
                    'subject_id' => $data['subject_id'],
                    'teacher_id' => $data['teacher_id'],
                    'day_id' => $dayId,
                    'start_time' => $startTime,
                    'end_time' => $endTime,
                ]);
            } else {
                return redirect()->back()->with('error', 'Class already exist for the class/teacher')->withInput();
            }
        }

        return redirect()->route('add-timetable.index')->with('message', 'Class Timetable Saved!');
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

    public function fetchTimetable(Request $request)
    {
        $classId = $request->input('class_id');
        $subjectId = $request->input('subject_id');
        $timetableData = [];

        if ($classId && $subjectId) {
            $timetableData = DB::table('class_timetables')
                ->where('class_id', $classId)
                ->where('subject_id', $subjectId)
                ->get();
        }

        return response()->json($timetableData);
    }
}
