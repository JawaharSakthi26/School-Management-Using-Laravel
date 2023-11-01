@extends('layouts.auth')
@section('title', 'PreSkool | Teacher Home')
@section('content')
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
        <footer>
            <p>Copyright © 2022 Dreamguys.</p>
        </footer>
    </div>
    </div>
@endsection
