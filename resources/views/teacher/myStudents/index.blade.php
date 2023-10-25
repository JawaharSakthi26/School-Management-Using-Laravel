@extends('layouts.auth')
@section('title', 'PreSkool | My Students')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="students.html">Student</a></li>
                                <li class="breadcrumb-item active">My Students</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        @if ($studentsInClass->isEmpty())
                                            <div class="alert alert-info text-center">
                                                You are not a <b>Class Teacher</b>/No Student is <b>Enrolled in your Class!</b>
                                            </div>
                                        @else
                                            <h3 class="page-title">My Students</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>Admission ID</th>
                                            <th>Name</th>
                                            <th>email</th>
                                            <th>Mobile Number</th>
                                            <th>Class</th>
                                            <th>DOB</th>
                                            <th>Gender</th>
                                            <th>Roll Number</th>
                                            <th>Religion</th>
                                            <th>Blood Group</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($studentsInClass as $index => $value)
                                            <tr>
                                                <td>{{ $value->admission_id }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="#" class="avatar avatar-sm me-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ asset('uploads/' . $value->user->avatar) }}"
                                                                alt="User Image"></a>
                                                        <a href="#">{{ $value->user->name }}</a>
                                                    </h2>
                                                </td>
                                                <td>{{ $value->user->email }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->class->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($value->dob)->format('M d, Y') }}</td>
                                                <td>{{ $value->gender == '1' ? 'Male' : ($value->gender == '2' ? 'Female' : 'Others') }}
                                                </td>
                                                <td>{{ $value->roll_number }}</td>
                                                <td>{{ $value->religion == '1' ? 'Hindu' : ($value->religion == '2' ? 'Christian' : ($value->religion == '3' ? 'Muslim' : 'Others')) }}
                                                </td>
                                                <td>{{ $value->blood_group }}</td>
                                                <td>{{ $value->address }}, {{ $value->city }}</td>
                                                <td>
                                                    @if ($value->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @elseif($value->status == 0)
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                {{-- <td class="text-end">
                                                <div class="actions ">
                                                    <a href="{{route('add-student.edit', $value->id)}}" class="btn btn-sm bg-success-light me-2 ">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <form action="{{ route('add-student.destroy', $value->user_id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm bg-danger-light"><i class="feather-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <p>Copyright © 2023 PreSkool.</p>
        </footer>
    </div>
@endsection
