@extends('layouts.auth')
@section('title', 'PreSkool | My Timetable')
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
                                        @if ($timetable->isEmpty())
                                            <div class="alert alert-info text-center">
                                                You are <b>not assigned to Any Class!</b>
                                            </div>
                                        @else
                                            <h3 class="page-title">Hello, {{ $teacher->name }}!</h3>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>Days</th>
                                            <th>10.00 AM - 11.00 AM</th>
                                            <th>11.00 AM - 12.00 PM</th>
                                            <th>12.00 PM - 01.00 PM</th>
                                            <th>01.00 PM - 02.00 PM</th>
                                            <th>02.00 PM - 03.00 PM</th>
                                            <th>03.00 PM - 04.00 PM</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($days as $day)
                                            <tr>
                                                <td><b>{{ $day->name }}</b></td>
                                                @if ($day->name === 'Sunday')
                                                    <td colspan="6" class="text-center fs-4 text-capitalize bg-secondary text-dark font-monospace rounded-2">
                                                        <span>Weekend Holiday!</span>
                                                    </td>
                                                @else
                                                    @for ($i = 10; $i <= 16; $i++)
                                                        <td>
                                                            @foreach ($timetable as $entry)
                                                                @if ($entry->day->name == $day->name && $entry->start_time == "$i:00" && $entry->end_time == $i + 1 . ':00')
                                                                    Subject: {{ $entry->subject->name }}<br>
                                                                    Class: {{ $entry->class->name }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    @endfor
                                                @endif
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
