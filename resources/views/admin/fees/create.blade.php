@extends('layouts.auth')
@section('title', 'PreSkool | Add Event')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add Fees</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('calendar') }}">Fees</a></li>
                            <li class="breadcrumb-item active">Add Fees</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('add-fees.store') }}" method="POST" id="fees-form">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Add Fees</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Class <span class="login-danger">*</span></label>
                                            <select class="form-control select" name="class_id" id="class_id">
                                                <option value="">-- Select Class --</option>
                                                @foreach ($selectLookups['classes'] as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Term <span class="login-danger">*</span></label>
                                            <select class="form-control select" name="term" id="term">
                                                <option value="">-- Select Term --</option>
                                                @foreach (config('custom.school_terms') as $key => $terms)
                                                    <option value="{{ $key }}">{{ $terms }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Fees Amount <span class="login-danger">*</span></label>
                                            <input class="form-control" id="money" type="text" name="amount">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Due Date <span class="login-danger">*</span></label>
                                            <input type="date" name="due_date" class="form-control">
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
        $('#fees-form').validate({
            rules: {
                class_id: {
                    required: true,
                },
                term: {
                    required: true,
                },
                amount: {
                    required: true,
                },
                due_date: {
                    required: true,
                },
            },
            messages: {
                class_id: {
                    required: "Please select a class",
                },
                term: {
                    required: "Please select a term",
                },
                amount: {
                    required: "Please enter the fees amount",
                },
                due_date: {
                    required: "Please enter the due date",
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
