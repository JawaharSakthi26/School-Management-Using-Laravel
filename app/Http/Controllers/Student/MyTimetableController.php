<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassTimetable;
use App\Models\Day;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MyTimetableController extends Controller
{
    public function index()
    {
        $student = User::with('student')->find(Auth::user()->id);
        $class_id = $student->student->class_id;
        $timetable = ClassTimetable::where('class_id',$class_id)->get();
        $days = Day::orderBy('id')->get();
        
        return view('student.myTimetable.index',compact('timetable','days','student'));
    }
}
