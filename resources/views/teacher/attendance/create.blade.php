@extends('layouts.auth')
@section('title', 'PreSkool | Add/Edit Student Attendance')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ isset($attendance) ? 'Edit Attendance' : 'Add Attendance' }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('attendance.index') }}">Attendance</a></li>
                            <li class="breadcrumb-item active">{{ isset($attendance) ? 'Edit Attendance' : 'Add Attendance' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST"
                                action="{{ isset($attendance) ? route('attendance.update', $attendance->id) : route('attendance.store') }}"
                                id="attendance-form">
                                @csrf
                                @if (isset($attendance))
                                    @method('PUT')
                                @endif
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Attendance</span></h5>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group local-forms">
                                            <label for="class_name">Class Name <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" id="class_name" name="class_name"
                                                value="{{ $class->name }}"
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group local-forms">
                                            <label for="class_name">Attendance Date <span class="login-danger">*</span></label>
                                            <input type="date" class="form-control" 
                                                name="attendance_date" value="{{ isset($attendance) ? $attendance->attendance_date : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table
                                        class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                        <thead class="student-thread">
                                            <tr>
                                                <th>Student Name</th>
                                                <th>Roll Number</th>
                                                <th>Present</th>
                                                <th>Absent</th>
                                                <th>Late Entry</th>
                                                <th>Permission</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($studentsInClass as $index => $value)
                                                <tr>
                                                    <td>{{ $value->user->name }}</td>
                                                    <td>{{ $value->roll_number }}</td>
                                                    <td>
                                                        <input type="radio" name="attendance[{{ $value->user_id }}]"
                                                            value="1" {{ isset($attendance) && $attendance->statuses->where('student_id', $value->user_id)->first()->status == 1 ? 'checked' : '' }}>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="attendance[{{ $value->user_id }}]"
                                                            value="2" {{ isset($attendance) && $attendance->statuses->where('student_id', $value->user_id)->first()->status == 2 ? 'checked' : '' }}>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="attendance[{{ $value->user_id }}]"
                                                            value="3" {{ isset($attendance) && $attendance->statuses->where('student_id', $value->user_id)->first()->status == 3 ? 'checked' : '' }}>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="attendance[{{ $value->user_id }}]"
                                                            value="4" {{ isset($attendance) && $attendance->statuses->where('student_id', $value->user_id)->first()->status == 4 ? 'checked' : '' }}>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="class_id" value="{{ $class->id }}">
                                    @if (isset($attendance))
                                        <input type="hidden" name="user_id" value="{{ $attendance->user_id }}">
                                    @else
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    @endif
                                    <div class="col-12">
                                        <div class="student-submit mt-3">
                                            <button type="submit" class="btn btn-primary">{{(isset($attendance)) ? 'Update' : 'Submit'}}</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
