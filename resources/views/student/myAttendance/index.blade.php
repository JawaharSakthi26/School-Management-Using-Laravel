@extends('layouts.auth')
@section('title', 'PreSkool | My Attendance')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="students.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">My Attendance</li>
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
                                        <h3 class="page-title">My Attendance</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table border-0 star-student table-hover table-center mb-0 table-striped"
                                    id="datatable">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>#</th>
                                            <th>Attendance Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($attendanceDates as $index => $attendanceDate)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ date('M d, Y', strtotime($attendanceDate->attendance->attendance_date)) }}</td>
                                                @php
                                                    $status = intval($attendanceDate->status);
                                                @endphp
                                                <td>
                                                    @if ($status == 1)
                                                        <span
                                                            class="badge badge-success">{{ config('custom.attendanceStatus.1') }}</span>
                                                    @elseif ($status == 2)
                                                        <span
                                                            class="badge badge-danger">{{ config('custom.attendanceStatus.2') }}</span>
                                                    @elseif ($status == 3)
                                                        <span
                                                            class="badge badge-warning">{{ config('custom.attendanceStatus.3') }}</span>
                                                    @elseif ($status == 4)
                                                        <span
                                                            class="badge badge-info">{{ config('custom.attendanceStatus.4') }}</span>
                                                    @endif
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
