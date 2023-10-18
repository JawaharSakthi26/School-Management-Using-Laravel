@extends('layouts.auth')
@section('title', 'PreSkool | Add/Edit Class')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add/Edit Department</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('add-class.index') }}">Department</a></li>
                            <li class="breadcrumb-item active">Add/Edit Department</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ isset($item) ? route('add-class.update', $item->id) : route('add-class.store') }}" id="class-form">
                                @csrf
                                @if (isset($item))
                                    @method('PUT')
                                @endif
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Department Details</span></h5>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group local-forms">
                                            <label for="className">Class Name <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" id="className" name="name" value="{{ old('name', isset($item) ? $item->name : '') }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Status <span class="login-danger">*</span></label>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="activeCheckbox"
                                                    name="status" value="1" {{ (isset($item) && $item->status == 1) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="activeCheckbox">Active</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="inactiveCheckbox"
                                                    name="status" value="0" {{ (isset($item) && $item->status == 0) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="inactiveCheckbox">Inactive</label>
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
                                            <button type="submit" class="btn btn-primary">{{ isset($item) ? 'Update' : 'Submit' }}</button>
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
                name: {
                    required: true,
                },
                status: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Please enter a class name",
                },
                status: {
                    required: "Please select a status"
                },
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "name") {
                    error.insertAfter(element.closest(".form-group.local-forms")).addClass('error-message');
                } else if (element.attr("name") == "status") {
                    error.appendTo(element.closest(".form-group")).addClass('error-message');
                }
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