<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentAttendanceStatus;
use Illuminate\Support\Facades\Auth;

class MyAttendanceController extends Controller
{
    public function index()
    {
        $student_id = Auth::user()->id;
        $attendanceDates = StudentAttendanceStatus::with('attendance')->where('student_id',$student_id)->get();
        return view('student.myAttendance.index', compact('attendanceDates'));
    }
}