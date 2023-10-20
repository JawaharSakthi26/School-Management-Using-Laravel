<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Teacher::all();
        return view('admin.teacher.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $filename = '';

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/', $filename);
        }

        $dob = Carbon::createFromFormat('d-m-Y', $request->input('dob'))->format('Y-m-d');
        $joining_date = Carbon::createFromFormat('d-m-Y', $request->input('joining_date'))->format('Y-m-d');

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'avatar' => $filename,
        ])->assignRole('Teacher');

        $user_id = $user->id;

        Teacher::create([
            'user_id' => $user_id,
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'dob' => $dob,
            'joining_date' => $joining_date,
            'qualification' => $request->input('qualification'),
            'blood_group' => $request->input('blood_group'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip_code' => $request->input('zip_code'),
            'country' => $request->input('country'),
            'status' => $request->input('status') ? '1' : '0',
        ]);

        return redirect()->route('add-teacher.index');
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
        $teacher = Teacher::findOrFail($id);
        return view('admin.teacher.create', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        if (!$teacher) {
            return redirect()->route('add-teacher.index')->with('error', 'Teacher not found');
        }
    
        $user = $teacher->user;
    
        $filename = $teacher->user->avatar;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/', $filename);
        }
    
        $dob = Carbon::createFromFormat('d-m-Y', $request->input('dob'))->format('Y-m-d');
        $joining_date = Carbon::createFromFormat('d-m-Y', $request->input('joining_date'))->format('Y-m-d');
    
        $userData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'avatar' => $filename,
        ];
    
        if ($request->has('password')) {
            $userData['password'] = Hash::make($request->input('password'));
        } else {
            $userData['password'] = $user->password;
        }
    
        $user->update($userData);
    
        $teacher->update([
            'phone' => $request->input('phone'),
            'gender' => $request->input('gender'),
            'dob' => $dob,
            'joining_date' => $joining_date,
            'qualification' => $request->input('qualification'),
            'blood_group' => $request->input('blood_group'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zip_code' => $request->input('zip_code'),
            'country' => $request->input('country'),
            'status' => $request->input('status') ? '1' : '0',
        ]);
    
        return redirect()->route('add-teacher.index')->with('success', 'Teacher updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = User::findOrFail($id);
        $item->delete();
        return redirect()->route("add-teacher.index");
    }
}
