@extends('layouts.auth')
@section('title', 'PreSkool | ' . (isset($selectLookups['fees']) ? 'Edit' : 'Add') . ' Fees')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ isset($selectLookups['fees']) ? 'Edit' : 'Add' }} Fees</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('add-fees.index') }}">Fees</a></li>
                            <li class="breadcrumb-item active">{{ isset($selectLookups['fees']) ? 'Edit' : 'Add' }} Fees</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form
                                action="{{ isset($selectLookups['fees']) ? route('add-fees.update', $selectLookups['fees']->id) : route('add-fees.store') }}"
                                method="POST" id="fees-form">
                                @csrf
                                {{ isset($selectLookups['fees']) ? method_field('PUT') : '' }}
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>{{ isset($selectLookups['fees']) ? 'Edit' : 'Add' }}
                                                Fees</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Class <span class="login-danger">*</span></label>
                                            <select class="form-control select" name="class_id" id="class_id">
                                                <option value="">-- Select Class --</option>
                                                @foreach ($selectLookups['classes'] as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ old('class_id', isset($selectLookups['fees']) && $selectLookups['fees']->class_id == $class->id ? 'selected' : '') }}>
                                                        {{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Plan Name <span class="login-danger">*</span></label>
                                            <select class="form-control select" name="name" id="name">
                                                <option value="">-- Select Plan --</option>
                                                @foreach (config('custom.plan_name') as $key => $plan)
                                                    <option value="{{ $key }}"
                                                        {{ old('name', isset($selectLookups['fees']) && $selectLookups['fees']->name == $key ? 'selected' : '') }}>
                                                        {{ $plan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Plan Amount <span class="login-danger">*</span></label>
                                            <input class="form-control" type="number" name="amount"
                                                value="{{ old('amount', isset($selectLookups['fees']) ? $selectLookups['fees']->amount : '') }}">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Currency <span class="login-danger">*</span></label>
                                            <input class="form-control text-secondary" type="text" name="currency" value="gbp" readonly>
                                        </div>
                                    </div>

                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="plan_id" value="{{ isset($selectLookups['fees']->plan_id) ? $selectLookups['fees']->plan_id : '' }}">
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit"
                                                class="btn btn-primary">{{ isset($selectLookups['fees']) ? 'Update' : 'Submit' }}</button>
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
                name: {
                    required: true,
                },
                amount: {
                    required: true,
                },
            },
            messages: {
                class_id: {
                    required: "Please select a class",
                },
                name: {
                    required: "Please select a plan name",
                },
                amount: {
                    required: "Please enter the plan amount",
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
