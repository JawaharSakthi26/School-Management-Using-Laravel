<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Exceptions\IncompletePayment;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $student = Student::where('user_id', $user_id)->first();
        if ($student) {
            $class_id = $student->class_id;
            $plans = Plan::where('class_id', $class_id)->get();
        }
        return view('student.fees.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $user->createOrGetStripeCustomer();

        $paymentMethod = $request->payment_method;
        $paymentMethod = $user->addPaymentMethod($paymentMethod);
        $plan = $request->plan_id;

        $subscription = $user->newSubscription('default', $plan);

        try {
            $subscription->create($request->payment_method);
        } catch (IncompletePayment $ex) {
            return back()->with('error', $ex->getMessage());
        }
        return redirect()->route('pay-fees.index')->with('message', 'Subscription Created Successfully');
    }
   

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plans = Plan::where('plan_id', $id)->first();

        if (!$plans) {
            return back()->with('error', 'Selected plan is not found');
        }

        return view('student.fees.checkout', [
            'intent' => Auth::user()->createSetupIntent(),
            'plans' => $plans
        ]);
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
