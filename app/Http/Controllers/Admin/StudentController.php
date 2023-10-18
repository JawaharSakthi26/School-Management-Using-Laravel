<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddClass;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(){
        $data = Student::all();
        return view("admin.student.index", compact('data'));
    }

    public function create(){
        $classes = AddClass::where('status','1')->get();
        return view('admin.student.create', compact('classes'));
    }

    public function store(Request $request) {
        $filename = '';
    
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/', $filename);
        }

        $dob = Carbon::createFromFormat('d-m-Y', $request->input('dob'))->format('Y-m-d');
    
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'avatar' => $filename,
        ])->assignRole('Student');

        $user_id = $user->id;
    
        Student::create([
            'user_id' => $user_id,
            'class_id' => $request->input('class'),
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'dob' => $dob,
            'admission_id' => $request->input('admission_id'),
            'roll_number' => $request->input('roll_number'),
            'religion' => $request->input('religion'),
            'blood_group' => $request->input('blood_group'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip_code' => $request->input('zip_code'),
            'country' => $request->input('country'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('add-student.index');
    }

    public function edit($id){
        $classes = AddClass::where('status','1')->get();
        $student = Student::findOrFail($id);
        return view('admin.student.create', compact('classes','student'));
    }

    public function update(Request $request, string $id){

        $student = Student::findOrFail($id);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/', $filename);
        }
        $dob = Carbon::createFromFormat('d-m-Y', $request->input('dob'))->format('Y-m-d');

        $student->user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'avatar' => $filename
        ]);
        
        $student->update([
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'dob' => $dob,
            'admission_id' => $request->input('admission_id'),
            'class_id' => $request->input('class'),
            'roll_number' => $request->input('roll_number'),
            'blood_group' => $request->input('blood_group'),
            'religion' => $request->input('religion'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip_code' => $request->input('zip_code'),
            'country' => $request->input('country'),
            'status' => $request->input('status'),
        ]);
        return redirect()->route('add-student.index')->with('success', 'Student updated successfully');
    }

    public function destroy(string $id)
    {
        $item = User::findOrFail($id);
        $item->delete();
        return redirect()->route("add-student.index");
    }
}
