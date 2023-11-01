<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Traits\RestControllerTrait;
use App\Models\AddClass;
use App\Models\ClassTeacher;
use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    use RestControllerTrait;

    public $modelClass = StudentAttendance::class;
    public $folderPath = 'teacher';
    public $viewPath = 'attendance';
    public $routeName = 'attendance';
    public $message = 'Attendance';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendanceDates = StudentAttendance::with('statuses')->where('user_id', Auth::user()->id)->orderBy('attendance_date', 'asc')->get();
        return view('teacher.attendance.index', compact('attendanceDates'));
    }

    protected function _selectLookups($id = null): array
    {
        $teacherId = Auth::user()->id;
        $classTeacher = ClassTeacher::where('teacher_id', $teacherId)->first();
        $studentsInClass = collect();
        $class = null;
        $attendance = null;

        if ($classTeacher) {
            $class_id = $classTeacher->class_id;
            $class = AddClass::where('id', $class_id)->first();
            $studentsInClass = Student::where('class_id', $class_id)->get();
        }

        if ($id) {
            $attendance = StudentAttendance::findOrFail($id);
        }
        return compact('studentsInClass', 'class', 'attendance');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $attendance = StudentAttendance::updateOrcreate(
            [
                'user_id' => $data['user_id'],
                'class_id' => $data['class_id'],
                'attendance_date' => $data['attendance_date']
            ],
            []
        );

        foreach ($request->attendance as $userId => $status) {
            $attendance->statuses()->updateOrcreate(
                [
                    'attendance_date_id' => $attendance->id,
                    'student_id' => $userId,
                ],
                ['status' => $status]
            );
        }

        return redirect()->route('attendance.index')->with('message', 'Attendance added successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request);
        $data = $request->all();

        $attendance = StudentAttendance::updateOrcreate(
            [
                'user_id' => $data['user_id'],
                'class_id' => $data['class_id'],
                'attendance_date' => $data['attendance_date']
            ],
            []
        );

        foreach ($request->attendance as $userId => $status) {
            $attendance->statuses()->updateOrcreate(
                [
                    'attendance_date_id' => $attendance->id,
                    'student_id' => $userId,
                ],
                ['status' => $status]
            );
        }

        return redirect()->route('attendance.index')->with('message', 'Attendance updated successfully');
    }
}