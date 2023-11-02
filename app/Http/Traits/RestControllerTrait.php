<?php

namespace App\Http\Traits;

use Illuminate\View\View;

trait RestControllerTrait
{

    public function index()
    {
        $data = $this->modelClass::all();
        return view("{$this->folderPath}.{$this->viewPath}.index", compact('data'));
    }

    // public function index()
    // {
    //     $dt = "\\App\\DataTables\\".class_basename($this->modelClass).'DataTable';
    //     $dataTable = new $dt;
    //     return $dataTable->render("{$this->folderPath}.{$this->viewPath}.index");
    // }

    public function create() :View
    {
        $model = $this->_createResource();
        $selectLookups = $this->_selectLookups();

        return view("{$this->folderPath}.{$this->viewPath}.create", compact('model','selectLookups'));
    }


    public function edit($id) :View
    {
        $model = $this->_getModel($id);
        $selectLookups = $this->_selectLookups($id);

        return view("{$this->folderPath}.{$this->viewPath}.create", compact('model', 'id', 'selectLookups'));
    }

    public function destroy($id)
    {
        $model = $this->_getModel($id);
        $model->delete();
        return redirect()->route("{$this->routeName}.index")->with('message',"{$this->message} Deleted Successfully");
    }


    protected function _createResource()
    {
        return new $this->modelClass;
    }


    protected function _save($request, $model)
    {
        $data = $request->except(['_token']);
        $model->fill($data);
        $model->save();
    }

    protected function _getModel($id)
    {
        return call_user_func_array([$this->modelClass, "findOrFail"], [$id]);
    }

    protected function _selectLookups($id = null) :array
    {
        return [
            //
        ];
    }
}