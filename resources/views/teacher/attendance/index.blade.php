@extends('layouts.auth')
@section('title', 'PreSkool | Student Attendance')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="students.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Attendance</li>
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
                                        <h3 class="page-title">Attendance</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="{{ route('attendance.create') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 table-striped" id="datatable">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>Class</th>
                                            <th>Attendance Date</th>
                                            <th>Present</th>
                                            <th>Absentees</th>
                                            <th>Late Entries</th>
                                            <th>Permission</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendanceDates as $index => $value)
                                            <tr>
                                                <td>{{ $value->class->name }}</td>
                                                <td>{{ date('M d, Y', strtotime($value->attendance_date)) }}</td>
                                                <td>{{ $value->statuses->where('status', '1')->count() }}</td>
                                                <td>{{ $value->statuses->where('status', '2')->count() }}</td>
                                                <td>{{ $value->statuses->where('status', '3')->count() }}</td>
                                                <td>{{ $value->statuses->where('status', '4')->count() }}</td>
                                                <td class="text-end">
                                                    <div class="actions ">
                                                        <a href="{{ route('attendance.edit', $value->id) }}"
                                                            class="btn btn-sm bg-success-light me-2 ">
                                                            <i class="feather-edit"></i>
                                                        </a>
                                                        <form action="{{ route('attendance.destroy', $value->id) }}"
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
                            </div> --}}

                            <div class="card-body">
                                {!! $dataTable->table(['class' => 'table table-striped table-responsive dt-bootstrap4 no-footer', 'id' => 'datatable-buttons']) !!}
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
