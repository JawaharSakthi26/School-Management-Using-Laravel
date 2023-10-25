@extends('layouts.auth')
@section('title', 'PreSkool | My Profile')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:history.back();">Dashboard</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            @php
                $user = Auth::user();
            @endphp
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-header">
                        <div class="row align-items-center">
                            <div class="col-auto profile-image">
                                <a href="#">
                                    <img class="rounded-circle" alt="User Image"
                                        src="{{ asset('uploads/' . $user->avatar) }}">
                                </a>
                            </div>
                            <div class="col ms-md-n2 profile-user-info">
                                <h4 class="user-name mb-0">{{ $user->name }}</h4>
                                @php
                                    $role = $user->getRoleNames()->first();
                                @endphp
                                <h6 class="text-muted">{{ $role }}</h6>

                                @if ($user->hasRole('Teacher|Student'))
                                    <div class="user-Location"><i class="fas fa-map-marker-alt"></i>
                                        {{ $user->hasRole('Teacher') ? $user->teacher->city : $user->student->city }},
                                        {{ $user->hasRole('Teacher') ? $user->teacher->state : $user->student->state }},
                                        {{ $user->hasRole('Teacher') ? $user->teacher->country : $user->student->country }}
                                    </div>
                                    <div class="about-text">{{ $user->address }}</div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#password_tab">Password</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content profile-tab-cont">

                        <div class="tab-pane fade show active" id="per_details_tab">

                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title d-flex justify-content-between">
                                                <span>Personal Details</span>
                                                <a class="edit-link" data-bs-toggle="modal"
                                                    data-bs-target="#edit_personal_details">
                                                    <i class="far fa-edit me-1"></i>Edit
                                                </a>
                                            </h5>
                                            <div class="row">
                                                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Name</p>
                                                <p class="col-sm-9">{{ $user->name }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email ID</p>
                                                <p class="col-sm-9"><a href="#">{{ $user->email }}
                                                    </a>
                                                </p>
                                            </div>

                                            @hasrole('Teacher|Student')
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Mobile</p>
                                                    <p class="col-sm-9">
                                                        {{ $user->hasRole('Teacher') ? $user->teacher->phone : $user->student->phone }}
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0">Address</p>
                                                    <p class="col-sm-9 mb-0">
                                                        {{ $user->hasRole('Teacher') ? $user->teacher->address : $user->student->address }},<br>
                                                        {{ $user->hasRole('Teacher') ? $user->teacher->city : $user->student->city }},
                                                        {{ $user->hasRole('Teacher') ? $user->teacher->state : $user->student->state }}
                                                        -
                                                        {{ $user->hasRole('Teacher') ? $user->teacher->zip_code : $user->student->zip_code }},<br>
                                                        {{ $user->hasRole('Teacher') ? $user->teacher->country : $user->student->country }}
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Gender</p>
                                                    <p class="col-sm-9">
                                                        {{ $user->hasRole('Teacher')
                                                            ? ($user->teacher->gender == '1'
                                                                ? 'Male'
                                                                : ($user->teacher->gender == '2'
                                                                    ? 'Female'
                                                                    : 'Others'))
                                                            : ($user->student->gender == '1'
                                                                ? 'Male'
                                                                : ($user->student->gender == '2'
                                                                    ? 'Female'
                                                                    : 'Others')) }}
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Date of Birth</p>
                                                    <p class="col-sm-9">
                                                        {{ $user->hasRole('Teacher') ? \Carbon\Carbon::parse($user->teacher->dob)->format('F j, Y') : \Carbon\Carbon::parse($user->student->dob)->format('F j, Y') }}
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Blood Group</p>
                                                    <p class="col-sm-9">
                                                        {{ $user->hasRole('Teacher') ? $user->teacher->blood_group : $user->student->blood_group }}
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Joining Date</p>
                                                    <p class="col-sm-9">
                                                        {{ $user->hasRole('Teacher') ? \Carbon\Carbon::parse($user->teacher->joining_date)->format('F j, Y') : '' }}
                                                    </p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Qualification</p>
                                                    <p class="col-sm-9">
                                                        {{ $user->hasRole('Teacher') ? $user->teacher->qualification : '' }}
                                                    </p>
                                                </div>
                                            @endhasrole
                                        </div>
                                    </div>
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

                            $religionOptions = [
                                '' => 'Select Religion',
                                '1' => 'Hindu',
                                '2' => 'Christian',
                                '3' => 'Muslim',
                                '4' => 'Others',
                            ];

                            $statusOptions = [
                                '1' => 'Active',
                                '0' => 'Inactive',
                            ];
                        @endphp
                        <div class="modal fade" id="edit_personal_details" tabindex="-1"
                            aria-labelledby="edit_personal_details_label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edit_personal_details_label">Change Basic Information
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('my-profile.update', $user->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ $user->name }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ $user->email }}">
                                            </div>
                                            @if ($user->hasRole('Teacher|Student'))
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" id="phone"
                                                        name="phone"
                                                        value="{{ $user->hasRole('Teacher') ? $user->teacher->phone : $user->student->phone }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="gender" class="form-label">Gender</label>
                                                    <select class="form-control" name="gender">
                                                        @if ($user->hasRole('Teacher'))
                                                            @foreach ($genderOptions as $value => $label)
                                                                <option value="{{ $value }}"
                                                                    {{ $user->teacher->gender == $value ? 'selected' : '' }}>
                                                                    {{ $label }}
                                                                </option>
                                                            @endforeach
                                                        @elseif ($user->hasRole('Student'))
                                                            @foreach ($genderOptions as $value => $label)
                                                                <option value="{{ $value }}"
                                                                    {{ $user->student->gender == $value ? 'selected' : '' }}>
                                                                    {{ $label }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label>Date Of Birth <span class="login-danger">*</span></label>
                                                    <input class="form-control datetimepicker" type="text"
                                                        name="dob" placeholder="DD-MM-YYYY"
                                                        value="{{ $user->hasRole('Teacher') ? $user->teacher->dob : $user->student->dob }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Blood Group <span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" name="blood_group"
                                                        placeholder="Enter Blood Group"
                                                        value="{{ $user->hasRole('Teacher') ? $user->teacher->blood_group : $user->student->blood_group }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Joining Date <span class="login-danger">*</span></label>
                                                    <input class="form-control datetimepicker" type="text"
                                                        name="joining_date" 
                                                        value="{{ $user->hasRole('Teacher') ? $user->teacher->joining_date : '' }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Qualification <span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" name="qualification"
                                                        placeholder="Qualification"
                                                        value="{{ $user->hasRole('Teacher') ? $user->teacher->qualification : ''}}">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Address <span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" name="address"
                                                        placeholder="Address"
                                                        value="{{ $user->hasRole('Teacher') ? $user->teacher->address : $user->student->address }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label>City <span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" name="city"
                                                        placeholder="City"
                                                        value="{{ $user->hasRole('Teacher') ? $user->teacher->city : $user->student->city }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label>State <span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" name="state"
                                                        placeholder="State"
                                                        value="{{ $user->hasRole('Teacher') ? $user->teacher->state : $user->student->state }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Zip Code <span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" name="zip_code"
                                                        placeholder="Zip Code"
                                                        value="{{ $user->hasRole('Teacher') ? $user->teacher->zip_code : $user->student->zip_code }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Country <span class="login-danger">*</span></label>
                                                    <input class="form-control" type="text" name="country"
                                                        placeholder="Country"
                                                        value="{{ $user->hasRole('Teacher') ? $user->teacher->country : $user->student->country }}">
                                                </div>
                                            @endif
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="password_tab" class="tab-pane fade">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Change Password</h5>
                                    <div class="row">
                                        <div class="col-md-10 col-lg-6">
                                            <form action="{{ route('my-profile.update', Auth::user()->id) }}"
                                                method="POST" id="password-change-form">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label>Old Password</label>
                                                    <input type="password" class="form-control" name="old_password">
                                                </div>
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password">
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input type="password" class="form-control"
                                                        name="password_confirmation">
                                                </div>
                                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#password-change-form').validate({
            rules: {
                old_password: {
                    required: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    equalTo: '#password'
                }
            },
            messages: {
                old_password: {
                    required: 'Please enter your old password.'
                },
                password: {
                    required: 'Please enter a new password.',
                    minlength: 'Password must be at least {0} characters.'
                },
                password_confirmation: {
                    required: 'Please confirm your new password.',
                    equalTo: 'Passwords do not match.'
                },
            },
            errorClass: 'error-message',
            highlight: function(element) {
                $(element).addClass("error-input");
            },
            unhighlight: function(element) {
                $(element).removeClass("error-input");
            },
        });
    </script>

@endsection