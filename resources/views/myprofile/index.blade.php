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

            <div class="row">
                <div class="col-md-12">
                    <div class="profile-header">
                        <div class="row align-items-center">
                            <div class="col-auto profile-image">
                                <a href="#">
                                    <img class="rounded-circle" alt="User Image"
                                        src="{{ asset('uploads/' . Auth::user()->avatar) }}">
                                </a>
                            </div>
                            <div class="col ms-md-n2 profile-user-info">
                                <h4 class="user-name mb-0">{{ Auth::user()->name }}</h4>
                                @php
                                    $role = Auth::user()
                                        ->getRoleNames()
                                        ->first();
                                @endphp
                                <h6 class="text-muted">{{ $role }}</h6>
                                <div class="user-Location"><i class="fas fa-map-marker-alt"></i> Tamil Nadu, India
                                </div>
                                <div class="about-text">{{ Auth::user()->address }}</div>
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
                                                <p class="col-sm-9">{{ Auth::user()->name }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email ID</p>
                                                <p class="col-sm-9"><a href="#">{{ Auth::user()->email }}
                                                    </a>
                                                </p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Mobile</p>
                                                <p class="col-sm-9">305-310-5857</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-3 text-muted text-sm-end mb-0">Address</p>
                                                <p class="col-sm-9 mb-0">4663 Agriculture Lane,<br>
                                                    Miami,<br>
                                                    Florida - 33165,<br>
                                                    United States.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        <form action="{{ route('my-profile.update', Auth::user()->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ Auth::user()->name }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ Auth::user()->email }}">
                                            </div>
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
                                                    <input type="password" class="form-control" id="password" name="password">
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input type="password" class="form-control" name="password_confirmation">
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
