@extends('layouts.auth')
@section('title', 'PreSkool | TimeTable')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add Time Table</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="time-table.html">Time Table</a></li>
                            <li class="breadcrumb-item active">Add Time Table</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Time Table</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Teacher Name <span class="login-danger">*</span></label>
                                            <select class="form-control" name="teacher_id">
                                                <option value=""> -- Select Teacher -- </option>
                                                @foreach ($teacher as $teacher)
                                                    <option value="{{ $teacher->user->id }}">{{ $teacher->user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Class <span class="login-danger">*</span></label>
                                            <select class="form-control" name="class_id" id="classSelect">
                                                <option value=""> -- Select Class -- </option>
                                                @foreach ($class as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Subject <span class="login-danger">*</span></label>
                                            <select class="form-control" name="subject_id" id="subjectSelect">
                                                <option value=""> -- Select Subject -- </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Date <span class="login-danger">*</span></label>
                                            <input class="form-control datetimepicker" type="text"
                                                placeholder="DD-MM-YYYY">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Day <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Start Time <span class="login-danger">*</span></label>
                                            <input type="time" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>End Time <span class="login-danger">*</span></label>
                                            <input type="time" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#classSelect').change(function () {
                var selectedClass = $(this).val();
                fetchSubjects(selectedClass);
            });

            function fetchSubjects(classId) {
                console.log(classId);
                $.ajax({
                    url: '{{ url('fetch-subjects') }}' + '/' + classId, 
                    type: 'GET',
                    success: function (data) {
                        console.log(data);
                        var subjectSelect = $('#subjectSelect');
                        subjectSelect.empty();
                        subjectSelect.append('<option value=""> -- Select Subject -- </option>');
                        $.each(data, function (key, value) {
                            subjectSelect.append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            }
        });
    </script>
@endsection