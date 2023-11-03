<?php

namespace App\Http\Controllers\Student;

use App\DataTables\MyAttendanceDataTable;
use App\Http\Controllers\Controller;
use App\Http\Traits\RestControllerTrait;

class MyAttendanceController extends Controller
{
    use RestControllerTrait;

    public $folderPath = 'student';
    public $viewPath = 'myAttendance';
    public $dataTable = MyAttendanceDataTable::class;

}