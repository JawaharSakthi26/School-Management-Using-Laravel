<div class="row mx-3">
    <div class="col-5">
        <div class="form-group local-forms">
            <label>Teacher <span class="login-danger">*</span></label>
            <select class="form-control select local-forms" name="teacher_id">
                <option value=""> -- Select Teacher -- </option>
                @php
                    $teachers = App\Models\Teacher::where('status', '1')->get();
                @endphp
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->user->id }}" @if ($teacher->user->id == old('teacher_id', $timetableData[0]->teacher_id ?? null)) selected @endif>
                        {{ $teacher->user->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div id="timetable-content" class="col-sm-12">
        <div class="card card-table">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table border-0 star-student table-hover table-center mb-0 table-striped mb-3">
                        @if ($timetableData->isNotEmpty())
                            @foreach ($timetableData as $index => $data)
                                <tr>
                                    <td>{{ $data->day->name }}</td>
                                    <td>
                                        <input type="hidden" name="timetable[{{ $index }}][day_id]"
                                            value="{{ $data->day_id }}">
                                        <input type="time" class="form-control"
                                            name="timetable[{{ $index }}][start_time]"
                                            value="{{ $data->start_time }}">
                                    </td>
                                    <td>
                                        <input type="time" class="form-control"
                                            name="timetable[{{ $index }}][end_time]"
                                            value="{{ $data->end_time }}">
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @php
                                $days = App\Models\Day::all();
                            @endphp
                            @foreach ($days as $index => $day)
                                @if ($day->name !== 'Sunday')
                                    <tr>
                                        <td>{{ $day->name }}</td>
                                        <td>
                                            <input type="hidden" name="timetable[{{ $index }}][day_id]"
                                                value="{{ $day->id }}">
                                            <input type="time" class="form-control"
                                                name="timetable[{{ $index }}][start_time]">
                                        </td>
                                        <td>
                                            <input type="time" class="form-control"
                                                name="timetable[{{ $index }}][end_time]">
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </table>
                    <div class="col-12 text-center mt-4" id="submit-button">
                        <div class="search-student-btn">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#time-form").validate({
        rules: {
            teacher_id: "required",
        },
        messages: {
            teacher_id: "Please select a teacher",
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
</script>
