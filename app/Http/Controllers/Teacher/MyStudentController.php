<?php

namespace App\Http\Controllers\Teacher;

use App\DataTables\MyStudentsDataTable;
use App\Http\Controllers\Controller;

class MyStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MyStudentsDataTable $dataTable)
    {
        return $dataTable->render("teacher.myStudents.index");
    }

}
