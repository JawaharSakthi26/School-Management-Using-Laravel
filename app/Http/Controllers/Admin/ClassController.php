<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CrudTrait;
use App\Models\AddClass;
use App\Models\Subject;
use Illuminate\Http\Request;

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
        $data = $request->all();

        if(AddClass::where('name',$data['name'])->exists()){
            return redirect()->back()->with('error', 'Class already exists')->withInput(); 
        }

        $class = AddClass::create([
            'user_id' => $data['user_id'],
            'name' => $data['name'],
            'status' => $request->input('status') ? '1' : '0'
        ]);

        $user_id = $class->user_id;

        foreach ($request->subjects as $subject) {
            $class->subjects()->create([
                'user_id' => $user_id,
                'subject_id' => $subject
            ]);
        }
        return redirect()->route('add-class.index')->with('message','Class Created Successfully!');
    }

    public function update(Request $request, string $id)
    {
        $class = AddClass::findOrFail($id);

        $data = $request->all();

        if(AddClass::where('name',$data['name'])->where('id', '!=', $id)->exists()){
            return redirect()->back()->with('error', 'Class already exists')->withInput(); 
        }

        $class->update([
            'user_id' => $data['user_id'],
            'name' => $data['name'],
            'status' => $request->status ? '1' : '0',
        ]);
        
        $selectedSubjects = $request->input('subjects', []);
        $existingSubjects = $class->subjects->pluck('id')->toArray();
        $subjectsToDetach = array_diff($existingSubjects, $selectedSubjects);

        foreach ($subjectsToDetach as $subjectId) {
            $class->subjects()->where('id', $subjectId)->delete();
        }

        foreach ($request->subjects as $subject) {
            $class->subjects()->create([
                'user_id' => $class->user_id,
                'subject_id' => $subject
            ]);
        }
        return redirect()->route('add-class.index')->with('message', 'Class Updated successfully');
    }

    public function edit(string $id)
    {
        $item = AddClass::findOrFail($id);
        $selectedSubjects = $item->subjects->pluck('subject_id')->toArray();
        $subjects = Subject::where('status', '1')->get();
        return view("admin.class.create", compact('item', 'subjects', 'selectedSubjects'));
    }
}
