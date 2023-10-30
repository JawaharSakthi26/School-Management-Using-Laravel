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
        $data = $request->all();

        Subject::create([
            'user_id' => $data['user_id'],
            'name' => $data['name'],
            'type' => $data['type'],
            'status' => $request->status ? '1' : '0',
        ]);
        return redirect()->route("add-subject.index")->with('message','Subject Created Successfully!');
    }

    public function update(Request $request, string $id)
    {
        $updateId = Subject::findOrFail($id);
        $data = $request->all();

        $updateId->update([
            'user_id' => $data['user_id'],
            'name' => $data['name'],
            'type' => $data['type'],
            'status' => $request->status ? '1' : '0',
        ]);

        return redirect()->route("add-subject.index")->with('message','Class Created Successfully!');
    }
}
