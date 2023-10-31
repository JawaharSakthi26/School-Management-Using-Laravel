<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MyProfileController extends Controller
{
    public function index()
    {
        return view('myprofile.index');
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        if ($request->has('password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->with('error', 'The old password is incorrect.');
            }

            if ($request->filled('password')) {
                $user->update(['password' => Hash::make($request->password)]);
            }

        } else {
            if ($user->hasRole('Admin')) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email
                ]);
            } elseif ($user->hasRole('Teacher')) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email
                ]);

                $dob = Carbon::createFromFormat('d-m-Y', $request->input('dob'))->format('Y-m-d');
                $joining_date = Carbon::createFromFormat('d-m-Y', $request->input('joining_date'))->format('Y-m-d');

                $user->teacher->update([
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
                ]);
            } elseif ($user->hasRole('Student')) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email
                ]);

                $dob = Carbon::createFromFormat('d-m-Y', $request->input('dob'))->format('Y-m-d');

                $user->student->update([
                    'phone' => $request->input('phone'),
                    'gender' => $request->input('gender'),
                    'dob' => $dob,
                    'religion' => $request->input('religion'),
                    'blood_group' => $request->input('blood_group'),
                    'address' => $request->input('address'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'zip_code' => $request->input('zip_code'),
                    'country' => $request->input('country'),
                ]);
            }
        }
        return redirect()->route('my-profile.index')->with('message', 'Profile updated successfully.');
    }
}