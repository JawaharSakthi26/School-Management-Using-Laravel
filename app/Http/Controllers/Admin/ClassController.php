<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CrudTrait;
use App\Models\AddClass;
use App\Models\ClassSubject;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    use CrudTrait;

    protected $model = AddClass::class;
    protected $viewPath = 'admin';
    protected $folderPath = 'class';
    protected $routePrefix = 'add-class';

    public function create()
    {
        $subjects = Subject::where('status', '1')->get();
        return view('admin.class.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $class = AddClass::create([
            'user_id' => $request->user_id,
            'name' => $request->input('name'),
            'status' => $request->input('status') ? '1' : '0'
        ]);

        $class_id = $class->id;
        $user_id = $class->user_id;

        foreach ($request->subjects as $subject) {
            ClassSubject::create([
                'user_id' => $user_id,
                'class_id' => $class_id,
                'subject_id' => $subject
            ]);
        }
        return redirect()->route('add-class.index');
    }

    public function update(Request $request, string $id)
    {
        $updateId = AddClass::findOrFail($id);

        $updateId->update([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'status' => $request->status ? '1' : '0',
        ]);
        
        $selectedSubjects = $request->input('subjects', []);
        $existingSubjects = $updateId->subjects->pluck('id')->toArray();
        $subjectsToDetach = array_diff($existingSubjects, $selectedSubjects);

        foreach ($subjectsToDetach as $subjectId) {
            $updateId->subjects()->where('id', $subjectId)->delete();
        }

        foreach ($request->subjects as $subject) {
            ClassSubject::create([
                'user_id' => $updateId->user_id,
                'class_id' => $updateId->id,
                'subject_id' => $subject
            ]);
        }

        return redirect()->route('add-class.index')->with('success', 'Class updated successfully');
    }

    public function edit(string $id)
    {
        $item = AddClass::findOrFail($id);
        $selectedSubjects = $item->subjects->pluck('subject_id')->toArray();
        $subjects = Subject::where('status', '1')->get();
        return view("admin.class.create", compact('item', 'subjects', 'selectedSubjects'));
    }
}
