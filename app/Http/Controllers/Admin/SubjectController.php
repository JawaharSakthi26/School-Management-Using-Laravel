<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\CrudTrait;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    use CrudTrait;

    protected $model = Subject::class;
    protected $viewPath = 'admin';
    protected $folderPath = 'subject';
    protected $routePrefix = 'add-subject';

    public function store(Request $request)
    {
        Subject::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'type' => $request->type,
            'status' => $request->status ? '1' : '0',
        ]);
        return redirect()->route("add-subject.index")->with('message','Subject Created Successfully!');
    }

    public function update(Request $request, string $id)
    {
        $updateId = Subject::findOrFail($id);

        $updateId->update([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'type' => $request->type,
            'status' => $request->status ? '1' : '0',
        ]);

        return redirect()->route("add-subject.index")->with('message','Class Created Successfully!');
    }
}
