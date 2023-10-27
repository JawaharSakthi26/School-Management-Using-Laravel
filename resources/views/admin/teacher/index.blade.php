@extends('layouts.auth')
@section('title', 'PreSkool | List Student')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="students.html">Student</a></li>
                                <li class="breadcrumb-item active">All Students</li>
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
                                    <div class="col">
                                        <h3 class="page-title">Teachers</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="{{ route('add-teacher.create') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>DOB</th>
                                            <th>Mobile Number</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $index => $value)
                                            <tr>
                                                <td>{{ $index+1 }}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="#" class="avatar avatar-sm me-2"><img
                                                                class="avatar-img rounded-circle"
                                                                src="{{ asset('uploads/' . $value->user->avatar) }}"
                                                                alt="User Image"></a>
                                                        <a href="#">{{ $value->user->name }}</a>
                                                    </h2>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($value->dob)->format('M d, Y') }}</td>
                                                <td>{{ $value->phone }}</td>
                                                <td>{{ $value->address }}, {{ $value->city }}</td>
                                                <td>
                                                    @if ($value->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @elseif($value->status == 0)
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <div class="actions ">
                                                        <a href="{{ route('add-teacher.edit', $value->user_id) }}"
                                                            class="btn btn-sm bg-success-light me-2 ">
                                                            <i class="feather-edit"></i>
                                                        </a>
                                                        <form action="{{ route('add-teacher.destroy', $value->user_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm bg-danger-light"><i
                                                                    class="feather-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
