<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\StudentDataTable;
use App\Http\Controllers\Controller;
use App\Http\Traits\RestControllerTrait;
use App\Models\AddClass;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    use RestControllerTrait;

    public $modelClass = User::class;
    public $folderPath = 'admin';
    public $viewPath = 'student';
    public $routeName = 'add-student';
    public $message = 'Student';

    
    public function index(StudentDataTable $dataTable)
    {
        return $dataTable->render("admin.student.index");
    }

    protected function _selectLookups($id = null): array
    {
        $classes = AddClass::where('status', '1')->get();
        $student = null;

        if ($id) {
            $student = User::with('student')->findOrFail($id);
        }

        return [
            'classes' => $classes,
            'student' => $student,
        ];
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if (User::where('email', $data['email'])->exists()) {
            return redirect()->back()->with('error', 'Email already exists')->withInput();
        }

        if (Student::where('admission_id', $data['admission_id'])->exists()) {
            return redirect()->back()->with('error', 'Admission ID already exists')->withInput();
        }

        if (Student::where('class_id', $data['class'])
            ->where('roll_number', $data['roll_number'])
            ->exists()
        ) {
            return redirect()->back()->with('error', 'Roll Number already exists for this class')->withInput();
        }

        $filename = '';

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/', $filename);
        }

        $dob = Carbon::createFromFormat('d-m-Y', $data['dob'])->format('Y-m-d');

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'avatar' => $filename,
        ])->assignRole('Student');

        $user->student()->create([
            'class_id' => $data['class'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'dob' => $dob,
            'admission_id' => $data['admission_id'],
            'roll_number' => $data['roll_number'],
            'religion' => $data['religion'],
            'blood_group' => $data['blood_group'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip_code' => $data['zip_code'],
            'country' => $data['country'],
            'status' => $request->input('status') ? '1' : '0',
        ]);
        return redirect()->route('add-student.index')->with('message', 'Student Created Successfully!');
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('add-student.index')->with('error', 'Student not found');
        }

        $filename = $user->avatar;
        $data = $request->all();

        if (User::where('email', $data['email'])->where('id', '!=', $user->id)->exists()) {
            return redirect()->back()->with('error', 'Email already exists')->withInput();
        }

        if (Student::where('admission_id', $data['admission_id'])->where('user_id', '!=', $user->id)->exists()) {
            return redirect()->back()->with('error', 'Admission ID already exists')->withInput();
        }

        if (Student::where('class_id', $data['class'])
            ->where('roll_number', $data['roll_number'])
            ->where('user_id', '!=', $user->id)
            ->exists()
        ) {
            return redirect()->back()->with('error', 'Roll Number already exists for this class')->withInput();
        }

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/', $filename);
        }

        $dob = Carbon::createFromFormat('d-m-Y', $data['dob'])->format('Y-m-d');

        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'avatar' => $filename,
        ];

        if ($request->has('password')) {
            $userData['password'] = Hash::make($request->input('password'));
        }

        $user->update($userData);

        $user->student()->update([
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'dob' => $dob,
            'admission_id' => $data['admission_id'],
            'class_id' => $data['class'],
            'roll_number' => $data['roll_number'],
            'blood_group' => $data['blood_group'],
            'religion' => $data['religion'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip_code' => $data['zip_code'],
            'country' => $data['country'],
            'status' => $request->input('status') ? '1' : '0',
        ]);

        return redirect()->route('add-student.index')->with('message', 'Student updated successfully');
    }


    public function destroy(string $id)
    {
        $item = User::findOrFail($id);
        $item->delete();
        return redirect()->route("add-student.index")->with('message', 'Student Deleted Successfully!');
    }
}
