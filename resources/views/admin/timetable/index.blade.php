@extends('layouts.auth')
@section('title', 'PreSkool | TimeTable')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Time Table</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Time Table</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <form action="" method="get" id="timetable-form">
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
                                <label>Subject <span class="login-danger">*</span></label>
                                <select class="form-control select" name="subject_id" id="subjectSelect">
                                    <option value=""> -- Select Subject -- </option>
                                </select>
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
        </div>
        <div>
            <form action="{{ route('add-timetable.store') }}" method="POST" id="time-form">
                @csrf
                <input type="hidden" name="class_id" value="" id="class_id">
                <input type="hidden" name="subject_id" value="" id="subject_id">
                <div id="timetable-content">

                </div>

            </form>
        </div>
    </div>

    <footer>
        <p>Copyright © 2023 PreSkool.</p>
    </footer>

    </div>

    <script>
        $(document).ready(function() {
            $("#timetable-form").validate({
                rules: {
                    class_id: "required",
                    subject_id: "required",
                },
                messages: {
                    class_id: "Please select a class",
                    subject_id: "Please select a subject",
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element.closest(".form-group.local-forms")).addClass(
                        'error-message');
                },
                highlight: function(element) {
                    $(element).addClass("error-input");
                },
                unhighlight: function(element) {
                    $(element).removeClass("error-input");
                },
            });


            $('#classSelect').change(function() {
                var selectedClass = $(this).val();
                fetchSubjects(selectedClass);
            });

            function fetchSubjects(classId) {
                $.ajax({
                    url: '{{ url('fetch-subjects') }}' + '/' + classId,
                    type: 'GET',
                    success: function(data) {
                        var subjectSelect = $('#subjectSelect');
                        subjectSelect.empty();
                        subjectSelect.append('<option value=""> -- Select Subject -- </option>');
                        $.each(data, function(key, value) {
                            subjectSelect.append('<option value="' + key + '">' + value +
                                '</option>');
                        });
                    }
                });
            }

            $('#searchButton').click(function() {
                var classId = $('#classSelect').val();
                var subjectId = $('#subjectSelect').val();

                if (classId && subjectId) {

                    $('#class_id').val(classId);
                    $('#subject_id').val(subjectId);

                    fetchTimetable(classId, subjectId);
                }
            });

            function fetchTimetable(classId, subjectId) {
                $.ajax({
                    url: '{{ route('fetch-timetable') }}',
                    type: 'GET',
                    data: {
                        class_id: classId,
                        subject_id: subjectId
                    },
                    success: function(data) {
                        $('#timetable-content').html(data.viewContent);
                    }
                });
            }
        });
    </script>
@endsection
