@extends('layouts.auth')
@section('title', 'PreSkool | Add Event')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add Event</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('calendar') }}">Events</a></li>
                            <li class="breadcrumb-item active">Add Event</li>
                        </ul>
                    </div>
                </div>
            </div>
            @php
                $eventCategory = ['Academic Events', 'Extracurricular Activities', 'Social and Cultural Events', 'Community and Charity Events', 'Parent and Family Engagement', 'Special Celebrations'];
            @endphp
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('event.store') }}" method="POST" id="event-form">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Event Information</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Event Name <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="title" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Event Category <span class="login-danger">*</span></label>
                                            <select class="form-control select" name="category" id="category">
                                                <option value="">-- Select Category --</option>
                                                @foreach ($eventCategory as $index => $event)
                                                    <option value="{{ $index + 1 }}">{{ $event }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Event Start Date <span class="login-danger">*</span></label>
                                            <input class="form-control" type="datetime-local" name="start">
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Event End Date <span class="login-danger">*</span></label>
                                            <input class="form-control" type="datetime-local" name="end">
                                        </div>
                                    </div>
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
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
        $('#event-form').validate({
            rules: {
                title: {
                    required: true,
                },
                category: {
                    required: true,
                },
                start: {
                    required: true,
                },
                end: {
                    required: true,
                },
            },
            messages: {
                title: {
                    required: "Please enter an event title",
                },
                category: {
                    required: "Please select an event category",
                },
                start: {
                    required: "Please enter your event start date and time",
                },
                end: {
                    required: "Please enter your event end date and time",
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
