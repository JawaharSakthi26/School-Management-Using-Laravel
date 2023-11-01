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
        $data = $request->all();

        $user = User::findOrFail($id);
        if ($request->has('password')) {
            if (!Hash::check($data['old_password'], $user->password)) {
                return redirect()->back()->with('error', 'The old password is incorrect.');
            }

            if ($request->filled('password')) {
                $user->update(['password' => Hash::make($data['password'])]);
            }

        } else {
            if ($user->hasRole('Admin')) {
                $user->update([
                    'name' => $data['name'],
                    'email' => $data['email']
                ]);
            } elseif ($user->hasRole('Teacher')) {
                $user->update([
                    'name' => $data['name'],
                    'email' => $data['email']
                ]);

                $dob = Carbon::createFromFormat('d-m-Y', $data['dob'])->format('Y-m-d');
                $joining_date = Carbon::createFromFormat('d-m-Y', $data['joining_date'])->format('Y-m-d');

                $user->teacher->update([
                    'phone' => $data['phone'],
                    'gender' => $data['gender'],
                    'dob' => $dob,
                    'joining_date' => $joining_date,
                    'qualification' => $data['qualification'],
                    'blood_group' => $data['blood_group'],
                    'address' => $data['address'],
                    'city' => $data['city'],
                    'state' => $data['state'],
                    'zip_code' => $data['zip_code'],
                    'country' => $data['country'],
                ]);
            } elseif ($user->hasRole('Student')) {
                $user->update([
                    'name' => $data['name'],
                    'email' => $data['email']
                ]);

                $dob = Carbon::createFromFormat('d-m-Y', $data['dob'])->format('Y-m-d');

                $user->student->update([
                    'phone' => $data['phone'],
                    'gender' => $data['gender'],
                    'dob' => $dob,
                    'religion' => $data['religion'],
                    'blood_group' => $data['blood_group'],
                    'address' => $data['address'],
                    'city' => $data['city'],
                    'state' => $data['state'],
                    'zip_code' => $data['zip_code'],
                    'country' => $data['country'],
                ]);
            }
        }
        return redirect()->route('my-profile.index')->with('message', 'Profile updated successfully.');
    }
}