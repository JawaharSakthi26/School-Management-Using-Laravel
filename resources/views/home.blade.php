@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8"> 
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="container my-2">
                        @hasrole('Admin')
                            <div class="admin">
                                <a href="" class="btn btn-info mt-2">Admin Module</a>
                            </div>
                        @endhasrole

                        @hasrole('Student')
                            <div class="student">
                                <a href="" class="btn btn-info mt-2">Student Module</a>
                            </div>
                        @endhasrole

                        @hasrole('Teacher')
                            <div class="teacher">
                                <a href="" class="btn btn-info mt-2">Teacher Module</a>
                            </div>
                        @endhasrole
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                            </div>
                        @endif
                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
