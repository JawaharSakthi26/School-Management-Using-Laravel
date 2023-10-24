<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('myprofile.index');
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
        //
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
        $user = User::findOrFail($id);
        if ($request->has('password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->with('error', 'The old password is incorrect.');
            }

            if ($request->filled('new_password')) {
                // Update the password if a new password is provided
                $user->update(['password' => Hash::make($request->new_password)]);
            }
        } else {
            // Update user details
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        return redirect()->route('my-profile.index')->with('message', 'Profile updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
