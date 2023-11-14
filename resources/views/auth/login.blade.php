@extends('layouts.auth')
@section('title', 'PreSkool | Login')

@section('content')
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="assets/img/login.png" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Welcome to Preskool</h1>
                            <h2 class="text-info fs-6 text-uppercase">Please Sign in</h2>

                            <form action="{{ route('login') }}" method="POST" id="login-form">
                                @csrf
                                <div class="form-group">
                                    <label>Username <span class="login-danger">*</span></label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" placeholder="Email" autofocus>
                                    <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Password <span class="login-danger">*</span></label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        placeholder="Password">
                                    <span class="profile-views feather-eye toggle-password"></span>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">Login</button>
                                </div>
                            </form>

                            <div class="login-or">
                                <span class="or-line"></span>
                                <span class="span-or">or</span>
                            </div>
                            <div class="social-login">
                                <a href="{{ route('auth.google') }}"><i class="fab fa-google-plus-g"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(".toggle-password").click(function() {
                var passwordField = $("#password");
                var fieldType = passwordField.attr("type");
                if (fieldType === "password") {
                    passwordField.attr("type", "text");
                } else {
                    passwordField.attr("type", "password");
                }
            });
            
            $("#login-form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 6,
                    },
                },
                messages: {
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address",
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Password must be at least {0} characters long",
                    },
                },
                errorPlacement: function(error, element) {
                    let errorDiv = element.parent();
                    error.insertAfter(errorDiv).addClass("error-message");
                },
                highlight: function(element) {
                    $(element).addClass("error-input");
                },
                unhighlight: function(element) {
                    $(element).removeClass("error-input");
                },
            });
        });
    </script>
@endsection
