<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddClass;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AttendanceController extends Controller
{

    public function index()
    {
        $class = AddClass::where('status', '1')->get();
        return view('admin.attendance.index', compact('class'));
    }

    //ajax request
    public function fetchAttendance(Request $request)
    {
        $classId = $request->input('class_id');
        $date = $request->input('date');

        $attendanceData = StudentAttendance::with(['statuses', 'statuses.user'])
            ->where('class_id', $classId)
            ->where('attendance_date', $date)
            ->get();

        $dataTableData = [];

        foreach ($attendanceData as $attendance) {
            foreach ($attendance->statuses as $status) {
                $dataTableData[] = [
                    'student_name' => $status->user->name,
                    'attendance_status' => $status->status,
                ];
            }
        }
        return Response::json($dataTableData);
    }
}
