<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\RestControllerTrait;
use App\Models\AddClass;
use App\Models\Fee_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class FeeController extends Controller
{
    use RestControllerTrait;

    public $modelClass = Fee_detail::class;
    public $folderPath = 'admin';
    public $viewPath = 'fees';
    public $routeName = 'add-fees';
    // public $export = MyStudentsExport::class;
    public $message = 'Fees';
    // public $dataTable = StudentDataTable::class;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = AddClass::where('status', '1')->get();
        return view('admin.fees.index', compact('classes'));
    }

    public function fetchFees(Request $request) 
    {
        $classId = $request->input('class_id');

        $feeData = Fee_detail::with(['class', 'user'])
            ->where('class_id', $classId)
            ->get();

        $dataTableData = [];

        foreach ($feeData as $fee) {
            $dataTableData[] = [
                'id' => $fee->id,
                'term' => config('custom.school_terms')[$fee->term],
                'amount' => $fee->amount,
                'due_date' => $fee->due_date,
                'user_name' => $fee->user->name,
            ];
        }
        return response()->json(['data' => $dataTableData]);
    }

    protected function _selectLookups($id = null): array
    {
        $classes = AddClass::where('status', '1')->get();
        $fees = null;

        if ($id) {
            $fees = Fee_detail::findOrFail($id); //need to modify according to create page requirement
        }

        return [
            'classes' => $classes,
            'fees' => $fees,
        ];
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $existingRecord = Fee_detail::where('class_id', $data['class_id'])
            ->where('term', $data['term'])
            ->first();

        if ($existingRecord) {
            return redirect()->route('add-fees.create')->with('error', 'This term fee is already assigned for the class');
        }

        Fee_detail::create($data);

        return redirect()->route('add-fees.index')->with('message', 'Fees created successfully!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
