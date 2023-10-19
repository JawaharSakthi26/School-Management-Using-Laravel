@extends('layouts.auth')
@section('title', 'PreSkool | ' . (isset($item) ? 'Edit Subject' : 'Add Subject'))
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{isset($item) ? 'Edit Subject' : 'Add Subject' }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="subjects.html">Subject</a></li>
                            <li class="breadcrumb-item active">{{isset($item) ? 'Edit Subject' : 'Add Subject' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            @php
                $subjectTypeOptions = [
                    '' => 'Select Type',
                    '1' => 'Theory',
                    '2' => 'Practical',
                    '3' => 'Theory & Practical',
                    '4' => 'Extra Curricular'
                ];

                $statusOptions = [
                    '1' => 'Active',
                    '0' => 'Inactive',
                ];
            @endphp
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ isset($item) ? route('add-subject.update', $item->id) : route('add-subject.store') }}" method="POST" id="subject-form">
                                @csrf
                                @if (isset($item))
                                    @method('PUT')
                                @endif
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Subject Information</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Subject Name <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" value="{{ isset($item) ? $item->name : old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Subject Type <span class="login-danger">*</span></label>
                                            <select class="form-control" name="type">
                                                @foreach ($subjectTypeOptions as $value => $label)
                                                    <option value="{{ $value }}"
                                                        {{ isset($item) && $item->type == $value ? 'selected' : '' }}>
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
                                                <input class="form-check-input custom-switch" type="checkbox" id="statusSwitch" name="status" value="1"
                                                    {{ (isset($item) && $item->status == '1') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="statusSwitch"></label>
                                            </div>
                                        </div>
                                    </div>
                                    @if (isset($item))
                                        <input type="hidden" name="user_id" value="{{ $item->user_id }}">
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
                status: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter a subject name"
                },
                type: {
                    required: "Please select the subject type"
                },
                status: {
                    required: "Please select a status"
                }
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
