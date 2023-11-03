@extends('layouts.auth')
@section('title', 'PreSkool | Assign Class Teacher')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">
                            @if(isset($selectLookups['item']))
                                Edit Class
                            @else
                                Add Class
                            @endif
                        </h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('add-class.index') }}">Class</a></li>
                            <li class="breadcrumb-item active">
                                @if(isset($selectLookups['item']))
                                    Edit Class
                                @else
                                    Add Class
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST"
                                action="{{ isset($selectLookups['item']) ? route('add-classTeacher.update', $selectLookups['item']->id) : route('add-classTeacher.store') }}"
                                id="class-form">
                                @csrf
                                @if (isset($selectLookups['item']))
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
                                                @foreach ($selectLookups['classes'] as $class)
                                                    <option value="{{ $class->id }}"
                                                        @if(isset($selectLookups['item']) && $selectLookups['item']->class_id == $class->id) selected @endif
                                                    >
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
                                                @foreach ($selectLookups['teachers'] as $teacher)
                                                    <option value="{{ $teacher->user->id }}"
                                                        @if(isset($selectLookups['item']) && $selectLookups['item']->teacher_id == $teacher->user_id) selected @endif
                                                    >
                                                        {{ $teacher->user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="user_id" value="{{ $selectLookups['item'] ? $selectLookups['item']->user_id : Auth::user()->id }}">
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">
                                                @if(isset($selectLookups['item']))
                                                    Update
                                                @else
                                                    Submit
                                                @endif
                                            </button>
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
