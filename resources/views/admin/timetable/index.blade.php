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
                                        <option value="{{ $class->id }}"
                                            {{ Request::get('class_id') == $class->id ? 'selected' : '' }}>
                                            {{ $class->name }}</option>
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
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if (!empty(Request::get('class_id')) && Request::get('subject_id'))
            <form action="{{ route('add-timetable.store') }}" method="POST">
                @csrf
                <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                <input type="hidden" name="subject_id" value="{{ Request::get('subject_id') }}">
                <div class="row mx-3">
                    <div class="col-5">
                        <div class="form-group local-forms">
                            <label>Teacher <span class="login-danger">*</span></label>
                            <select class="form-control select" name="teacher_id">
                                <option value=""> -- Select Teacher -- </option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->user->id }}"
                                        @if ($teacher->user->id == old('teacher_id', $timetableData[0]->teacher_id ?? null)) selected @endif>
                                        {{ $teacher->user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-table">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table
                                        class="table border-0 star-student table-hover table-center mb-0 table-striped mb-3">
                                        <thead class="student-thread">
                                            <tr>
                                                <th>Day</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $index = 1; @endphp
                                            @foreach ($week_days as $days)
                                                @if ($days->name !== 'Sunday')
                                                    <tr>
                                                        <td>{{ $days->name }}</td>
                                                        <td>
                                                            <input type="hidden"
                                                                name="timetable[{{ $index }}][day_id]"
                                                                value="{{ $days->id }}">
                                                            <input type="time" class="form-control"
                                                                name="timetable[{{ $index }}][start_time]"
                                                                value="{{ old('timetable.' . $index . '.start_time', $timetableData[$index - 1]->start_time ?? '') }}">
                                                        </td>
                                                        <td>
                                                            <input type="time" class="form-control"
                                                                name="timetable[{{ $index }}][end_time]"
                                                                value="{{ old('timetable.' . $index . '.end_time', $timetableData[$index - 1]->end_time ?? '') }}">
                                                        </td>
                                                    </tr>
                                                    @php $index++; @endphp
                                                @else
                                                    <tr class="table">
                                                        <td>Sunday</td>
                                                        <td colspan="2"
                                                            class="text-center fs-4 text-capitalize bg-secondary text-dark font-monospace rounded-2">
                                                            Weekend Holiday!</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="col-12 text-center mt-4">
                                        <div class="search-student-btn">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>

    <footer>
        <p>Copyright © 2023 PreSkool.</p>
    </footer>

    </div>

    <script>
        $(document).ready(function() {
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

            function fetchTimetable(classId, subjectId) {
                $.ajax({
                    url: '{{ route('fetch-timetable') }}',
                    type: 'GET',
                    data: {
                        class_id: classId,
                        subject_id: subjectId
                    },
                    success: function(data) {
                        if (data.length > 0) {
                            var timetableTable = $('#timetable-content');
                            timetableTable.empty();
                            data.forEach(function(item, index) {
                                var row = '<tr>' +
                                    '<td>' + item.day + '</td>' +
                                    '<td><input type="hidden" name="timetable[' + index +
                                    '][day_id]" value="' + item.day_id + '">' +
                                    '<input type="time" class="form-control" name="timetable[' +
                                    index + '][start_time]" value="' + item.start_time +
                                    '"></td>' +
                                    '<td><input type="time" class="form-control" name="timetable[' +
                                    index + '][end_time]" value="' + item.end_time + '"></td>' +
                                    '</tr>';
                                timetableTable.append(row);
                            });
                        }
                    }
                });
            }

            $("#timetable-form").validate({
                rules: {
                    class_id: "required",
                    subject_id: "required"
                },
                messages: {
                    class_id: "Please select a class",
                    subject_id: "Please select a subject"
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
        });
    </script>
@endsection
