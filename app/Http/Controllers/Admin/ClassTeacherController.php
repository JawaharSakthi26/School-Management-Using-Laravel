<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddClass;
use App\Models\ClassTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ClassTeacher::all();
        return view('admin.classTeacher.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = AddClass::whereNotIn('id', function ($query) {
            $query->select('class_id')
                ->from('class_teachers')
                ->whereNotNull('teacher_id');
        })->where('status','1')->get();

        $teachers = Teacher::whereNotIn('user_id', function ($query) {
            $query->select('teacher_id')
                ->from('class_teachers')
                ->whereNotNull('class_id');
        })->where('status','1')->get();

        return view('admin.classTeacher.create', compact('classes', 'teachers'));
    }

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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = ClassTeacher::findOrFail($id);
        $classes = AddClass::where('status', 1)->get();
        $teachers = Teacher::where('status', 1)->get();

        return view("admin.classTeacher.create", compact('item', 'classes', 'teachers'));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = ClassTeacher::findOrFail($id);
        $item->delete();
        return redirect()->route("add-classTeacher.index")->with('message','Class Teacher Deleted Successfully');
    }
}
