<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TeacherDataTable;
use App\Http\Controllers\Controller;
use App\Http\Traits\RestControllerTrait;
use App\Jobs\SendMailJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    use RestControllerTrait;

    public $modelClass = User::class;
    public $folderPath = 'admin';
    public $viewPath = 'teacher';
    public $routeName = 'add-teacher';
    public $message = 'Teacher';
    public $dataTable = TeacherDataTable::class;

    protected function _selectLookups($id = null): array
    {
        $teacher = null;

        if ($id) {
            $teacher = User::with('teacher')->findOrFail($id);
        }

        return [
            'teacher' => $teacher,
        ];
    }

    public function store(Request $request)
    {
        $filename = '';

        $data = $request->all();

        if (User::where('email', $data['email'])->exists()) {
            return redirect()->back()->with('error', 'Email already exists')->withInput();
        }

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/', $filename);
        }

        $dob = Carbon::createFromFormat('d-m-Y', $data['dob'])->format('Y-m-d');
        $joining_date = Carbon::createFromFormat('d-m-Y', $data['joining_date'])->format('Y-m-d');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => $filename,
        ])->assignRole('Teacher');

        $user_id = $user->id;

        $user->teacher()->create([
            'user_id' => $user_id,
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
            'status' => $request->input('status') ? '1' : '0',
        ]);

        $emailTemplate = config('custom.email_templates.teacher_template');

        SendMailJob::dispatch($user, $data['password'], $emailTemplate);

        return redirect()->route('add-teacher.index')->with('message', 'Teacher Created Successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('add-teacher.index')->with('error', 'Teacher not found');
        }

        $filename = $user->avatar;
        $data = $request->all();

        if (User::where('email', $data['email'])->where('id', '!=', $user->id)->exists()) {
            return redirect()->back()->with('error', 'Email already exists')->withInput();
        }

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/', $filename);
        }

        $dob = Carbon::createFromFormat('d-m-Y', $data['dob'])->format('Y-m-d');
        $joining_date = Carbon::createFromFormat('d-m-Y', $data['joining_date'])->format('Y-m-d');

        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'avatar' => $filename,
        ];

        if ($request->has('password')) {
            $userData['password'] = Hash::make($data['password']);
        } else {
            $userData['password'] = $user->password;
        }

        $user->update($userData);

        $user->teacher()->update([
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
            'status' => $request->input('status') ? '1' : '0',
        ]);

        return redirect()->route('add-teacher.index')->with('message', 'Teacher updated successfully');
    }
}
