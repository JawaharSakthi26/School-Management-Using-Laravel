<?php

namespace App\Http\Controllers\Student;

use App\DataTables\MyAttendanceDataTable;
use App\Http\Controllers\Controller;

class MyAttendanceController extends Controller
{
    public function index(MyAttendanceDataTable $dataTable)
    {
        return $dataTable->render("student.myAttendance.index");
    }
}