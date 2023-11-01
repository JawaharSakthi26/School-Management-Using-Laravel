<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ClassTeacher;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacherId = Auth::user()->id;
        $classTeacher = ClassTeacher::where('teacher_id', $teacherId)->first();
        $studentsInClass = collect();
        
        if($classTeacher){
            $class_id = $classTeacher->class_id;
            $studentsInClass = Student::where('class_id', $class_id)->get();
        }
        return view('teacher.myStudents.index', compact('studentsInClass'));
    }

}
