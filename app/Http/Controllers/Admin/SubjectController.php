<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\RestControllerTrait;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    use RestControllerTrait;

    public $modelClass = Subject::class;
    public $folderPath = 'admin';
    public $viewPath = 'subject';
    public $routeName = 'add-subject';
    public $message = 'Subject'; 

    public function _selectLookups($id = null): array
    {
        $item = null;

        if($id){
            $item = Subject::findOrFail($id);
        }

        return[
            'item' => $item
        ];
    }

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

        return redirect()->route("add-subject.index")->with('message','Subject Updated Successfully!');
    }
}