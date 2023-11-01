<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ClassTimetable;
use App\Models\Day;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MyTimetableController extends Controller
{
    public function index()
    {
        $teacher = User::find(Auth::user()->id);
        $teacher_id = Auth::user()->id;
        $timetable = ClassTimetable::where('teacher_id',$teacher_id)->get();
        $days = Day::orderBy('id')->get();
        return view('teacher.myTimetable.index', compact('timetable','teacher','days'));
    }
}
