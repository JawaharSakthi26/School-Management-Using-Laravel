<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\RestControllerTrait;
use App\Models\AddClass;
use App\Models\Plan;
use Exception;
use Illuminate\Http\Request;
use Stripe\Plan as StripePlan;

class FeeController extends Controller
{
    use RestControllerTrait;

    public $modelClass = Plan::class;
    public $folderPath = 'admin';
    public $viewPath = 'fees';
    public $routeName = 'add-fees';
    public $message = 'Fees';


    public function index()
    {
        $classes = AddClass::where('status', '1')->get();
        return view('admin.fees.index', compact('classes'));
    }

    public function fetchFees(Request $request)
    {
        $classId = $request->input('class_id');

        $planData = Plan::with(['class', 'user'])
            ->where('class_id', $classId)
            ->get();

        $dataTableData = [];

        foreach ($planData as $plan) {
            $dataTableData[] = [
                'id' => $plan->id,
                'name' => config('custom.plan_name')[$plan->name],
                'amount' => $plan->amount,
                'plan_period' => $plan->interval_count .' '. $plan->billing_method,
                'currency' => $plan->currency,
                'user_name' => $plan->user->name,
            ];
        }
        return response()->json(['data' => $dataTableData]);
    }

    protected function _selectLookups($id = null): array
    {
        $classes = AddClass::where('status', '1')->get();
        $fees = null;

        if ($id) {
            $fees = Plan::findOrFail($id);
        }

        return [
            'classes' => $classes,
            'fees' => $fees,
        ];
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $existingRecord = Plan::where('class_id', $data['class_id'])
            ->where('name', $data['name'])
            ->first();

        if ($existingRecord) {
            return redirect()->route('add-fees.create')->with('error', 'This plan is already assigned for the class');
        }
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        $amount = $data['amount'] * 100;
        try {
            $plan = StripePlan::create([
                'amount' => $amount,
                'currency' => $data['currency'],
                'interval' => $data['name'] == '1' ? 'month' : 'year',
                'interval_count' => $data['name'] == '1' ? '6' : '1',
                'product' => [
                    'name' => config('custom.plan_name')[$data['name']],
                ],
            ]);

            Plan::create([
                'user_id' => $data['user_id'],
                'class_id' => $data['class_id'],
                'plan_id' => $plan->id,
                'name' => $data['name'],
                'amount' => $data['amount'],
                'billing_method' => $plan->interval,
                'interval_count' => $plan->interval_count,
                'currency' => $plan->currency
            ]);
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }

        return redirect()->route('add-fees.index')->with('message', 'Fees created successfully!');
    }

    // public function update(Request $request, string $id)
    // {
    //     $fees = Fee_detail::findOrFail($id);

    //     $data = $request->all();

    //     $existingRecord = Fee_detail::where('class_id', $data['class_id'])
    //     ->where('term', $data['term'])
    //     ->whereNotIn('id', [$id]) 
    //     ->first();

    //     if ($existingRecord) {
    //         return redirect()->route('add-fees.index')->with('error', 'This term fee is already assigned for the class');
    //     }

    //     $fees->update([
    //         'class_id' => $data['class_id'],
    //         'term' => $data['term'],
    //         'amount' => $data['amount'],
    //         'due_date' => $data['due_date'],
    //         'user_id' => $data['user_id'],
    //     ]);

    //     return redirect()->route('add-fees.index')->with('message', 'Fees updated successfully');
    // }
}
