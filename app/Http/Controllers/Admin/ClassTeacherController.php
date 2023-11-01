<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\RestControllerTrait;
use App\Models\AddClass;
use App\Models\ClassTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassTeacherController extends Controller
{
    use RestControllerTrait;

    public $modelClass = ClassTeacher::class;
    public $folderPath = 'admin';
    public $viewPath = 'classTeacher';
    public $routeName = 'add-classTeacher';
    public $message = 'Class Teacher'; 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        ClassTeacher::create([
            'user_id' => $data['user_id'],
            'class_id' =>$data['class_id'],
            'teacher_id' => $data['teacher_id'],
        ]);
        return redirect()->route('add-classTeacher.index')->with('message', 'Class teacher created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function _selectLookups($id = null): array
    {
        $classes = AddClass::where('status', 1)->get();
        $teachers = Teacher::where('status', 1)->get();
        
        $result = [
            'classes' => $classes,
            'teachers' => $teachers,
            'item' => null
        ];
        
        if ($id) {
            $item = ClassTeacher::findOrFail($id);
            $result['item'] = $item;
        }
    
        return $result;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateId = ClassTeacher::findOrFail($id);

        $data = $request->all();
        
        $updateId->update([
            'user_id' => $data['user_id'],
            'class_id' => $data['class_id'],
            'teacher_id' => $data['teacher_id'],
        ]);

        return redirect()->route('add-classTeacher.index')->with('message', 'Class Teacher Updated Successfully');
    }
}