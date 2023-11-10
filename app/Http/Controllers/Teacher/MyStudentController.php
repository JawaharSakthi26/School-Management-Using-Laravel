<?php

namespace App\Http\Controllers\Teacher;

use App\DataTables\MyStudentsDataTable;
use App\Exports\Teacher\MyStudentsExport;
use App\Http\Controllers\Controller;
use App\Http\Traits\RestControllerTrait;
use App\Models\Student;

class MyStudentController extends Controller
{
    use RestControllerTrait;

    public $modelClass = Student::class;
    public $export = MyStudentsExport::class;
    public $folderPath = 'teacher';
    public $viewPath = 'myStudents';
    public $message = 'MyStudents';
    public $dataTable = MyStudentsDataTable::class;

}