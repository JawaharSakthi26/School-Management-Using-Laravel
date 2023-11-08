<?php

namespace App\DataTables;

class ViewAttendanceDataTable extends BaseDataTable
{
    public function dataTable($attendanceData)
    {
        return datatables($attendanceData)
            ->addColumn('index', function () {
                return $this->row + 1;
            })
            ->addColumn('student_name', function ($model) {
                $studentNames = $model->statuses->pluck('user.name');
                return $studentNames;
            })
            ->addColumn('attendance_status', function ($model) {
                $attendanceStatuses = $model->statuses->pluck('status');
                dd($attendanceStatuses);
                return $attendanceStatuses;
            })
            ->rawColumns(['index', 'student_name', 'attendance_status']);
    }
}
