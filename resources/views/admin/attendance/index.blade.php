@extends('layouts.auth')
@section('title', 'PreSkool | List Class')
@section('content')

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Attendance</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Attendance</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <form action="" method="get" id="attendance-form">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group local-forms">
                                <label>Class <span class="login-danger">*</span></label>
                                <select class="form-control select" name="class_id" id="classSelect">
                                    <option value=""> -- Select Class -- </option>
                                    @foreach ($class as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group local-forms">
                                <label>Date <span class="login-danger">*</span></label>
                                <input type="date" class="form-control" name="date" id="dateInput" required>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="search-student-btn">
                                <button type="button" class="btn btn-primary" id="searchButton">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div id="attendanceTableContainer">

            </div>
        </div>
        <div>
            <script>
                $(document).ready(function() {
                    $('#searchButton').click(function() {
                        var classId = $('#classSelect').val();
                        var date = $('#dateInput').val();

                        $.ajax({
                            url: '{{ url('fetch-attendance') }}',
                            method: 'GET',
                            data: {
                                class_id: classId,
                                date: date
                            },
                            success: function(data) {
                                $('#attendanceTableContainer').html(
                                    '<table id="attendanceTable" class="display" style="width:100%"></table>'
                                );

                                $('#attendanceTable').DataTable({
                                    data: data,
                                    columns: [{
                                            data: null,
                                            title: '#',
                                            orderable: false,
                                            render: function(data, type, row, meta) {
                                                return meta.row + 1;
                                            }
                                        },
                                        {
                                            data: 'student_name',
                                            title: 'Student Name'
                                        },
                                        {
                                            data: 'attendance_status',
                                            title: 'Attendance Status',
                                            render: function(data, type, row) {
                                                if (data == 1) {
                                                    return '<span class="badge badge-success">Present</span>';
                                                } else if (data == 2) {
                                                    return '<span class="badge badge-danger">Absent</span>';
                                                } else if (data == 3) {
                                                    return '<span class="badge badge-warning">Late Entry</span>';
                                                } else if (data == 4) {
                                                    return '<span class="badge badge-info">Permission</span>';
                                                } else {
                                                    return 'Unknown';
                                                }
                                            }
                                        },
                                    ],
                                });
                            },
                            error: function(error) {
                                console.error(error);
                            }
                        });
                    });
                });
            </script>

        @endsection
