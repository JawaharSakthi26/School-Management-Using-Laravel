<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait CrudTrait
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->model::all();
        return view("{$this->viewPath}.{$this->folderPath}.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("{$this->viewPath}.{$this->folderPath}.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $this->model::create($data);
        return redirect()->route("{$this->routePrefix}.index");
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
        $item = $this->model::findOrFail($id);
        return view("{$this->viewPath}.{$this->folderPath}.create", compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $updateId = $this->model::findOrFail($id);
        $updateId->update($data);
        return redirect()->route("{$this->routePrefix}.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = $this->model::findOrFail($id);
        $item->delete();
        return redirect()->route("{$this->routePrefix}.index");
    }
}
