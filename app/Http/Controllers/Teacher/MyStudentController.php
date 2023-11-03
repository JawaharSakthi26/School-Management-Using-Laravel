<?php

namespace App\Http\Controllers\Teacher;

use App\DataTables\MyStudentsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Traits\RestControllerTrait;

class MyStudentController extends Controller
{

    use RestControllerTrait;

    public $folderPath = 'teacher';
    public $viewPath = 'myStudents';
    public $dataTable = MyStudentsDataTable::class;
    
}
