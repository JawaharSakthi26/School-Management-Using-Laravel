@extends('layouts.auth')
{{-- @section('title', 'PreSkool | Add Teacher') --}}
@section('title', 'PreSkool | ' . (isset($teacher) ? 'Edit Teacher' : 'Add Teacher'))
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ isset($teacher) ? 'Edit Teacher' : 'Add Teacher' }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('add-teacher.index') }}">Teachers</a></li>
                            <li class="breadcrumb-item active">{{ isset($teacher) ? 'Edit Teacher' : 'Add Teacher' }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            @php
                $genderOptions = [
                    '' => 'Select Gender',
                    '1' => 'Male',
                    '2' => 'Female',
                    '3' => 'Others',
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
                            <form id="teacher-form" method="POST"
                                action="{{ isset($teacher) ? route('add-teacher.update', $teacher->id) : route('add-teacher.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @if (isset($teacher))
                                    @method('PUT')
                                @endif
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Basic Details</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Name <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Enter Name"
                                                value="{{ isset($teacher) ? $teacher->user->name : old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Gender <span class="login-danger">*</span></label>
                                            <select class="form-control" name="gender">
                                                @foreach ($genderOptions as $value => $label)
                                                    <option value="{{ $value }}"
                                                        {{ isset($teacher) && $teacher->gender == $value ? 'selected' : '' }}>
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
                                                value="{{ isset($teacher) ? $teacher->dob : old('dob') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Mobile <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="phone"
                                                placeholder="Enter Phone" maxlength="10"
                                                value="{{ isset($teacher) ? $teacher->phone : old('phone') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Blood Group <span class="login-danger">*</span></label>
                                            <input class="form-control" type="text" name="blood_group"
                                                placeholder="Enter Blood Group"
                                                value="{{ isset($teacher) ? $teacher->blood_group : old('blood_group') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Joining Date <span class="login-danger">*</span></label>
                                            <input class="form-control datetimepicker" type="text" name="joining_date"
                                                placeholder="DD-MM-YYYY"
                                                value="{{ isset($teacher) ? $teacher->joining_date : old('dob') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4 local-forms">
                                        <div class="form-group">
                                            <label>Qualification <span class="login-danger">*</span></label>
                                            <input class="form-control" type="text" name="qualification"
                                                placeholder="Enter Your Qualification"
                                                value="{{ isset($teacher) ? $teacher->qualification : old('qualification') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-8">
                                        <div class="form-group local-forms">
                                            <div class="uplod">
                                                <label>Upload Image <span class="login-danger">*</span></label>
                                                <input class="form-control pt-3" type="file" name="photo">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Login Details</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Email <span class="login-danger">*</span></label>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="Enter Email ID"
                                                value="{{ isset($teacher) ? $teacher->user->email : old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Create Password <span class="login-danger">*</span></label>
                                            <input class="form-control" id="password" type="password" name="password"
                                                placeholder="Create Password" {{ isset($teacher) ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Confirm Password <span class="login-danger">*</span></label>
                                            <input class="form-control" type="password" id="confirm_password"
                                                name="password_confirmation" placeholder="Confirm Password"
                                                {{ isset($teacher) ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Address</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Address 1st Line </label>
                                            <input class="form-control" type="text" name="address"
                                                placeholder="Enter Address 1st Line"
                                                value="{{ isset($teacher) ? $teacher->address : old('address') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>City </label>
                                            <input class="form-control" type="text" name="city"
                                                placeholder="Enter City"
                                                value="{{ isset($teacher) ? $teacher->city : old('city') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>State </label>
                                            <input class="form-control" type="text" name="state"
                                                placeholder="Enter State"
                                                value="{{ isset($teacher) ? $teacher->state : old('state') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Zip Code </label>
                                            <input class="form-control" type="text" name="zip_code"
                                                placeholder="Enter Zip Code"
                                                value="{{ isset($teacher) ? $teacher->zip_code : old('zip_code') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Country </label>
                                            <input class="form-control" type="text" name="country"
                                                placeholder="Enter Country"
                                                value="{{ isset($teacher) ? $teacher->country : old('country') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group">
                                            <label>Status <span class="login-danger">*</span></label>
                                            @foreach ($statusOptions as $value => $label)
                                                <div class="form-check">
                                                    <input type="radio" id="{{ $value }}"
                                                        class="form-check-input" name="status"
                                                        value="{{ $value }}"
                                                        {{ isset($teacher) && $teacher->status == $value ? 'checked' : '' }}>
                                                    <label for="{{ $value }}"
                                                        class="form-check-label">{{ $label }}</label>
                                                </div>
                                            @endforeach
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
        $('#teacher-form').validate({
            rules: {
                name: {
                    required: true
                },
                gender: {
                    required: true
                },
                dob: {
                    required: true,
                },
                phone: {
                    required: true,
                    digits: true
                },
                joining_date: {
                    required: true,
                },
                qualification: {
                    required: true,
                },
                blood_group: {
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
                confirm_password: {
                    required: true,
                    equalTo: '#password'
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
                status: {
                    required: true
                },
                @if (!isset($teacher))
                    required: true
                }
            @endif
        },
        messages: {
            name: {
                required: "Please enter the teacher's name"
            },
            gender: {
                required: "Please select the teacher's gender"
            },
            dob: {
                required: "Please enter the teacher's date of birth"
            },
            phone: {
                required: "Please enter the teacher's phone number",
                digits: "Please enter digits only"
            },
            joining_date: {
                required: "Please enter teacher's dashboard",
            },
            qualification: {
                required: "Please enter teacher's qualification",
            },
            blood_group: {
                required: "Please enter the teacher's blood group"
            },
            email: {
                required: "Please enter the teacher's email address",
                email: "Please enter a valid email address"
            },
            password: {
                required: "Please create a password for the teacher",
                minlength: "Password must be at least 6 characters long"
            },
            confirm_password: {
                required: "Please confirm the password",
                equalTo: "Passwords do not match"
            },
            address: {
                required: "Please enter the teacher's address"
            },
            city: {
                required: "Please enter the teacher's city"
            },
            state: {
                required: "Please enter the teacher's state"
            },
            zip_code: {
                required: "Please enter the teacher's zip code"
            },
            country: {
                required: "Please enter the teacher's country"
            },
            status: {
                required: "Please select a status"
            },
            @if (!isset($teacher))
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
