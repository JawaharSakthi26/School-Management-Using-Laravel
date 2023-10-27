<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\AddClass;
use App\Models\ClassTeacher;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\StudentAttendanceStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendanceDates = StudentAttendance::with('statuses')->where('user_id', Auth::user()->id)->get();
        return view('teacher.attendance.index', compact('attendanceDates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teacherId = Auth::user()->id;
        $classTeacher = ClassTeacher::where('teacher_id', $teacherId)->first();
        $studentsInClass = collect();

        if ($classTeacher) {
            $class_id = $classTeacher->class_id;
            $class = AddClass::where('id', $class_id)->first();
            $studentsInClass = Student::where('class_id', $class_id)->get();
        }

        return view('teacher.attendance.create', compact('studentsInClass', 'class'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attendance = StudentAttendance::updateOrcreate(
            [
                'user_id' => $request->user_id,
                'class_id' => $request->class_id,
                'attendance_date' => $request->attendance_date
            ],
            []
        );

        foreach ($request->attendance as $userId => $status) {
            StudentAttendanceStatus::updateOrcreate(
                [
                    'attendance_date_id' => $attendance->id,
                    'student_id' => $userId,
                ],
                ['status' => $status]
            );
        }

        return redirect()->route('attendance.index')->with('message', 'Attendance recorded successfully');
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
        $teacherId = Auth::user()->id;
        $classTeacher = ClassTeacher::where('teacher_id', $teacherId)->first();
        $studentsInClass = collect();

        if ($classTeacher) {
            $class_id = $classTeacher->class_id;
            $class = AddClass::where('id', $class_id)->first();
            $studentsInClass = Student::where('class_id', $class_id)->get();
        }

        $attendance = StudentAttendance::findOrFail($id);

        return view('teacher.attendance.create', compact('attendance','class','studentsInClass'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request);
        {
            $attendance = StudentAttendance::updateOrcreate(
                [
                    'user_id' => $request->user_id,
                    'class_id' => $request->class_id,
                    'attendance_date' => $request->attendance_date
                ],
                []
            );
    
            foreach ($request->attendance as $userId => $status) {
                StudentAttendanceStatus::updateOrcreate(
                    [
                        'attendance_date_id' => $attendance->id,
                        'student_id' => $userId,
                    ],
                    ['status' => $status]
                );
            }
    
            return redirect()->route('attendance.index')->with('message', 'Attendance recorded successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = StudentAttendance::findOrFail($id);
        $item->delete();
        return redirect()->route("attendance.index")->with('message','Attendance Record Deleted Successfully!');
    }
}
