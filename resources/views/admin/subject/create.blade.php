@extends('layouts.auth')
@section('title', 'PreSkool | ' . (isset($selectLookups['item']) ? 'Edit Subject' : 'Add Subject'))
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ isset($selectLookups['item']) ? 'Edit Subject' : 'Add Subject' }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="subjects.html">Subject</a></li>
                            <li class="breadcrumb-item active">{{ isset($selectLookups['item']) ? 'Edit Subject' : 'Add Subject' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form
                                action="{{ isset($selectLookups['item']) ? route('add-subject.update', $selectLookups['item']->id) : route('add-subject.store') }}"
                                method="POST" id="subject-form">
                                @csrf
                                @if (isset($selectLookups['item']))
                                    @method('PUT')
                                @endif
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Subject Information</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Subject Name <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ isset($selectLookups['item']) ? $selectLookups['item']->name : old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Subject Type <span class="login-danger">*</span></label>
                                            <select class="form-control select" name="type">
                                                @foreach (config('custom.subjectTypeOptions') as $value => $label)
                                                    <option value="{{ $value }}"
                                                        {{ isset($selectLookups['item']) && $selectLookups['item']->type == $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label>Status <span class="login-danger">*</span></label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input custom-switch" type="checkbox" id="statusSwitch" name="status" {{ isset($selectLookups['item']) && $selectLookups['item']->status == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="statusSwitch"></label>
                                            </div>
                                        </div>
                                    </div>
                                    @if (isset($selectLookups['item']))
                                        <input type="hidden" name="user_id" value="{{ $selectLookups['item']->user_id }}">
                                    @else
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    @endif
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
        $('#subject-form').validate({
            rules: {
                name: {
                    required: true
                },
                type: {
                    required: true
                },
            },
            messages: {
                name: {
                    required: "Please enter a subject name"
                },
                type: {
                    required: "Please select the subject type"
                },
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.closest(".form-group.local-forms")).addClass('error-message');
            },
            highlight: function(element) {
                $(element).addClass("error-input");
            },
            unhighlight: function(element) {
                $(element).removeClass("error-input");
            },
        });
    </script>
@endsection
