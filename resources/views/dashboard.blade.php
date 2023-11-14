@extends('layouts.auth')
@section('title')

    PreSkool |

    @if(Auth::user()->hasRole('Admin'))
        Admin Home
    @elseif(Auth::user()->hasRole('Teacher'))
        Teacher Home
    @elseif(Auth::user()->hasRole('Student'))
        Student Home
    @endif

@endsection

@section('content')

    @hasrole('Admin')
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Welcome {{ Auth::user()->name }}!</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="">Home</a></li>
                                    <li class="breadcrumb-item active">Admin</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Students</h6>
                                        <h3>{{ App\Models\Student::count() }}</h3>
                                    </div>
                                    <div class="db-icon">
                                        <img src="assets/img/icons/dash-icon-01.svg" alt="Dashboard Icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Teachers</h6>
                                        <h3>{{ App\Models\Teacher::count() }}</h3>
                                    </div>
                                    <div class="db-icon">
                                        <img src="assets/img/icons/dash-icon-02.svg" alt="Dashboard Icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Classes</h6>
                                        <h3>{{ App\Models\AddClass::count() }}</h3>
                                    </div>
                                    <div class="db-icon">
                                        <img src="assets/img/icons/dash-icon-03.svg" alt="Dashboard Icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Events</h6>
                                        <h3>{{ App\Models\Event::count() }}</h3>
                                    </div>
                                    <div class="db-icon">
                                        <img src="assets/img/icons/dash-icon-04.svg" alt="Dashboard Icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endhasrole

        @hasrole('Teacher')
            <div class="page-wrapper">
                <div class="content container-fluid">

                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-sub-header">
                                    <h3 class="page-title">Welcome {{ Auth::user()->name }}!</h3>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                                        <li class="breadcrumb-item active">Teacher</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-3 col-sm-6 col-12 d-flex">
                            <div class="card bg-comman w-100">
                                <div class="card-body">
                                    <div class="db-widgets d-flex justify-content-between align-items-center">
                                        <div class="db-info">
                                            <h6>Total Classes</h6>
                                            @php
                                                $classCounts = App\Models\ClassTimetable::where('teacher_id', Auth::user()->id)
                                                    ->select('class_id')
                                                    ->groupBy('class_id')
                                                    ->get();
                                                $totalClassesAttended = count($classCounts);
                                            @endphp
                                            <h3>{{ $totalClassesAttended }}
                                            </h3>
                                        </div>
                                        <div class="db-icon">
                                            <img src="assets/img/icons/teacher-icon-01.svg" alt="Dashboard Icon">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 d-flex">
                            <div class="card bg-comman w-100">
                                <div class="card-body">
                                    <div class="db-widgets d-flex justify-content-between align-items-center">
                                        <div class="db-info">
                                            <h6>My Students</h6>
                                            @php
                                                $class = App\Models\ClassTeacher::where('teacher_id', Auth::user()->id)->first();
                                                $students = 'NIL';
                                                try {
                                                    $students = App\Models\Student::where('class_id', $class->class_id)->count();
                                                } catch (\Exception $e) {
                                                }
                                            @endphp
                                            <h3>{{ $students }}</h3>
                                        </div>
                                        <div class="db-icon">
                                            <img src="assets/img/icons/dash-icon-01.svg" alt="Dashboard Icon">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 d-flex">
                            <div class="card bg-comman w-100">
                                <div class="card-body">
                                    <div class="db-widgets d-flex justify-content-between align-items-center">
                                        <div class="db-info">
                                            <h6>Total Events</h6>
                                            <h3>{{ $classCount = App\Models\Event::count() }}</h3>
                                        </div>
                                        <div class="db-icon">
                                            <img src="assets/img/icons/teacher-icon-02.svg" alt="Dashboard Icon">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 d-flex">
                            <div class="card bg-comman w-100">
                                <div class="card-body">
                                    <div class="db-widgets d-flex justify-content-between align-items-center">
                                        <div class="db-info">
                                            <h6>Total Hours</h6>
                                            <h3>{{ $classCount = App\Models\ClassTimetable::where('teacher_id', Auth::user()->id)->count() }}
                                            </h3>
                                        </div>
                                        <div class="db-icon">
                                            <img src="assets/img/icons/teacher-icon-03.svg" alt="Dashboard Icon">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endhasrole

            @hasrole('Student')
                <div class="page-wrapper">
                    <div class="content container-fluid">

                        <div class="page-header">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="page-sub-header">
                                        <h3 class="page-title">Welcome {{ Auth::user()->name }}!</h3>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                                            <li class="breadcrumb-item active">Student</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                                <div class="card bg-comman w-100">
                                    <div class="card-body">
                                        <div class="db-widgets d-flex justify-content-between align-items-center">
                                            <div class="db-info">
                                                <h6>All Courses</h6>
                                                <h3>04/06</h3>
                                            </div>
                                            <div class="db-icon">
                                                <img src="assets/img/icons/teacher-icon-01.svg" alt="Dashboard Icon">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                                <div class="card bg-comman w-100">
                                    <div class="card-body">
                                        <div class="db-widgets d-flex justify-content-between align-items-center">
                                            <div class="db-info">
                                                <h6>All Projects</h6>
                                                <h3>40/60</h3>
                                            </div>
                                            <div class="db-icon">
                                                <img src="assets/img/icons/teacher-icon-02.svg" alt="Dashboard Icon">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                                <div class="card bg-comman w-100">
                                    <div class="card-body">
                                        <div class="db-widgets d-flex justify-content-between align-items-center">
                                            <div class="db-info">
                                                <h6>Test Attended</h6>
                                                <h3>30/50</h3>
                                            </div>
                                            <div class="db-icon">
                                                <img src="assets/img/icons/student-icon-01.svg" alt="Dashboard Icon">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                                <div class="card bg-comman w-100">
                                    <div class="card-body">
                                        <div class="db-widgets d-flex justify-content-between align-items-center">
                                            <div class="db-info">
                                                <h6>Test Passed</h6>
                                                <h3>15/20</h3>
                                            </div>
                                            <div class="db-icon">
                                                <img src="assets/img/icons/student-icon-02.svg" alt="Dashboard Icon">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endhasrole

                <footer>
                    <p>Copyright © 2023 PreSkool.</p>
                </footer>
            </div>
        </div>
    @endsection
