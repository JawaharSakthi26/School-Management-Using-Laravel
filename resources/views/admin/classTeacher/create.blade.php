@extends('layouts.auth')
@section('title', 'PreSkool | Assign Class Teacher')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ isset($item) ? 'Edit Class' : 'Add Class' }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('add-class.index') }}">Class</a></li>
                            <li class="breadcrumb-item active">{{ isset($item) ? 'Edit Class' : 'Add Class' }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST"
                                action="{{ isset($item) ? route('add-classTeacher.update', $item->id) : route('add-classTeacher.store') }}"
                                id="class-form">
                                @csrf
                                @if (isset($item))
                                    @method('PUT')
                                @endif
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Class Details</span></h5>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group local-forms">
                                            <label for="className">Class Name <span class="login-danger">*</span></label>
                                            <select class="form-control select" id="className" name="class_id">
                                                <option value="">Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ isset($item) && $item->class_id == $class->id ? 'selected' : '' }}>
                                                        {{ $class->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group local-forms">
                                            <label for="classSubjects">Select Teacher <span
                                                    class="login-danger">*</span></label>
                                            <select class="form-control select" id="classSubjects" name="teacher_id">
                                                <option value="">-- Select --</option>
                                                @foreach ($teachers as $teacher)
                                                    <option value="{{ $teacher->user->id }}"
                                                        {{ isset($item) && $item->teacher->id == $teacher->user->id ? 'selected' : '' }}>
                                                        {{ $teacher->user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if (isset($item))
                                        <input type="hidden" name="user_id" value="{{ $item->user_id }}">
                                    @else
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    @endif
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit"
                                                class="btn btn-primary">{{ isset($item) ? 'Update' : 'Submit' }}</button>
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
        $("#class-form").validate({
            rules: {
                class_id: {
                    required: true,
                },
                teacher_id: {
                    required: true,
                },
            },
            messages: {
                class_id: {
                    required: "Please select a class",
                },
                teacher_id: {
                    required: "Please select a class teacher",
                },
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.closest(".local-forms")).addClass('error-message');
            },
            highlight: function(element) {
                $(element).closest(".local-forms").addClass("error-input");
            },
            unhighlight: function(element) {
                $(element).closest(".local-forms").removeClass("error-input");
            },
        });
    </script>
    
@endsection
