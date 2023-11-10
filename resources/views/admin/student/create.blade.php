@extends('layouts.auth')
@section('title', 'PreSkool | ' . (isset($selectLookups['student']) ? 'Edit Student' : 'Add Student'))
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">{{ isset($selectLookups['student']) ? 'Edit Student' : 'Add Student' }}
                            </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('add-student.index') }}">Student</a></li>
                                <li class="breadcrumb-item active">
                                    {{ isset($selectLookups['student']) ? 'Edit Student' : 'Add Student' }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ isset($selectLookups['student']) ? route('add-student.update', $selectLookups['student']->user->id) : route('add-student.store') }}"
                                method="POST" enctype="multipart/form-data" id="student-form">
                                @csrf
                                @if (isset($selectLookups['student']))
                                    @method('PUT')
                                @endif

                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">Student Information <span><a
                                                    href="javascript:;"><i class="feather-more-vertical"></i></a></span>
                                        </h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Name <span class="login-danger">*</span></label>
                                            <input class="form-control" type="text" name="name"
                                                placeholder="Enter First Name"
                                                value="{{ isset($selectLookups['student']) ? $selectLookups['student']->user->name : old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>E-Mail <span class="login-danger">*</span></label>
                                            <input class="form-control" type="email" name="email"
                                                placeholder="Enter Email Address"
                                                value="{{ isset($selectLookups['student']) ? $selectLookups['student']->user->email : old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Phone </label>
                                            <input class="form-control" type="text" name="phone" id="phone"
                                                placeholder="Enter Phone Number"
                                                value="{{ isset($selectLookups['student']) ? $selectLookups['student']->phone : old('phone') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Create Password <span class="login-danger">*</span></label>
                                            <input class="form-control" id="password" type="password" name="password"
                                                placeholder="Create Password"
                                                {{ isset($selectLookups['student']) ? 'disabled' : '' }}
                                                value="{{ old('password') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Confirm Password <span class="login-danger">*</span></label>
                                            <input class="form-control" type="password" id="confirm_password"
                                                name="password_confirmation" placeholder="Confirm Password"
                                                {{ isset($selectLookups['student']) ? 'disabled' : '' }}
                                                value="{{ old('password_confirmation') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Gender <span class="login-danger">*</span></label>
                                            <select class="form-control select" name="gender">
                                                @foreach (config('custom.genderOptions') as $value => $label)
                                                    <option value="{{ $value }}"
                                                        {{ (isset($selectLookups['student']) && $selectLookups['student']->gender == $value) || old('gender') == $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Date Of Birth <span class="login-danger">*</span></label>
                                            <input class="form-control datetimepicker" type="text" name="dob"
                                                placeholder="DD-MM-YYYY"
                                                value="{{ isset($selectLookups['student']) ? $selectLookups['student']->dob : old('dob') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Admission ID </label>
                                            <input class="form-control" type="text" name="admission_id"
                                                placeholder="Enter Admission ID"
                                                value="{{ isset($selectLookups['student']) ? $selectLookups['student']->admission_id : old('admission_id') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Class <span class="login-danger">*</span></label>
                                            <select class="form-control select" name="class">
                                                <option value="">Please Select Class</option>
                                                @foreach ($selectLookups['classes'] as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ (isset($selectLookups['student']) && $selectLookups['student']->class_id == $class->id) || old('class') == $class->id ? 'selected' : '' }}>
                                                        {{ $class->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Roll Number </label>
                                            <input class="form-control" type="text" name="roll_number"
                                                placeholder="Enter Roll Number"
                                                value="{{ isset($selectLookups['student']) ? $selectLookups['student']->roll_number : old('roll_number') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Blood Group <span class="login-danger">*</span></label>
                                            <input class="form-control" type="text" name="blood_group"
                                                placeholder="Enter Blood Group"
                                                value="{{ isset($selectLookups['student']) ? $selectLookups['student']->blood_group : old('blood_group') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Religion <span class="login-danger">*</span></label>
                                            <select class="form-control select" name="religion">
                                                @foreach (config('custom.religionOptions') as $value => $label)
                                                    <option value="{{ $value }}"
                                                        {{ (isset($selectLookups['student']) && $selectLookups['student']->religion == $value) || old('religion') == $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Address 1st Line </label>
                                            <input class="form-control" type="text" name="address"
                                                placeholder="Enter Address 1st Line"
                                                value="{{ isset($selectLookups['student']) ? $selectLookups['student']->address : old('address') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>City </label>
                                            <input class="form-control" type="text" name="city"
                                                placeholder="Enter City"
                                                value="{{ isset($selectLookups['student']) ? $selectLookups['student']->city : old('city') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>State </label>
                                            <input class="form-control" type="text" name="state"
                                                placeholder="Enter State"
                                                value="{{ isset($selectLookups['student']) ? $selectLookups['student']->state : old('state') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Zip Code </label>
                                            <input class="form-control" type="text" name="zip_code"
                                                placeholder="Enter Zip Code" maxlength="6"
                                                value="{{ isset($selectLookups['student']) ? $selectLookups['student']->zip_code : old('zip_code') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Country </label>
                                            <input class="form-control" type="text" name="country"
                                                placeholder="Enter Country"
                                                value="{{ isset($selectLookups['student']) ? $selectLookups['student']->country : old('country') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <div class="uplod">
                                                <label>Upload Image</label>
                                                <input class="form-control pt-3" type="file" name="photo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label>Status <span class="login-danger">*</span></label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input custom-switch" type="checkbox"
                                                    id="statusSwitch" name="status" value="1"
                                                    {{ isset($selectLookups['student']) && $selectLookups['student']->status == '1' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="statusSwitch"></label>
                                            </div>
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
        $('#student-form').validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    equalTo: '#password'
                },
                phone: {
                    required: true,
                },
                gender: {
                    required: true
                },
                dob: {
                    required: true,
                },
                admission_id: {
                    required: true
                },
                class: {
                    required: true
                },
                roll_number: {
                    required: true
                },
                blood_group: {
                    required: true
                },
                religion: {
                    required: true
                },
                address: {
                    required: true
                },
                city: {
                    required: true
                },
                state: {
                    required: true
                },
                zip_code: {
                    required: true
                },
                country: {
                    required: true
                },
                @if (!isset($selectLookups['student'])) // Add this condition to validate "photo" only for new records
                    photo: {
                        required: true
                    }
                @endif
            },
            messages: {
                name: {
                    required: "Please enter student's name"
                },
                email: {
                    required: "Please enter student's email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please create a password for student",
                    minlength: "Password must be at least 6 characters long"
                },
                password_confirmation: {
                    required: "Please confirm your password",
                    equalTo: "Passwords do not match"
                },
                phone: {
                    required: "Please enter student's phone number",
                },
                gender: {
                    required: "Please select the gender of the student"
                },
                date_of_birth: {
                    required: "Please enter the date of birth of the student",
                },
                admission_id: {
                    required: "Please enter the student's admission ID"
                },
                class: {
                    required: "Please select the student's class"
                },
                roll_number: {
                    required: "Please select the student's roll number"
                },
                blood_group: {
                    required: "Please enter the student's blood group"
                },
                religion: {
                    required: "Please select the student's religion"
                },
                address: {
                    required: "Please enter student's address"
                },
                city: {
                    required: "Please enter student's city"
                },
                state: {
                    required: "Please enter student's state"
                },
                zip_code: {
                    required: "Please enter student's zip code"
                },
                country: {
                    required: "Please enter student's country"
                },
                @if (!isset($selectLookups['student'])) // Add this condition to specify the message for "photo" only for new records
                    photo: {
                        required: "Please upload a photo"
                    }
                @endif
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
