@extends('layouts.auth')
@section('title', 'PreSkool | List Fees Plans')
@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Fees</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Fees</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <form action="" method="get" id="fees-form">
                <div class="row">
                    <div class="col-10">
                        <div class="form-group local-forms">
                            <label>Class <span class="login-danger">*</span></label>
                            <select class="form-control select" name="class_id" id="classSelect">
                                <option value=""> -- Select Class -- </option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="search-student-btn">
                            <button type="button" class="btn btn-primary" id="searchButton">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div id="feesTableContainer">

        </div>
    </div>
<div>
    <script>
        $(document).ready(function() {
            $('#searchButton').click(function() {
                var classId = $('#classSelect').val();

                $.ajax({
                    url: '{{ url('fetch-feesData') }}',
                    method: 'GET',
                    data: {
                        class_id: classId,
                    },
                    success: function(response) {
                        var data = response.data;
                        $('#feesTableContainer').html(
                            '<table id="feesTable" class="display" style="width:100%"></table>'
                        );

                        $('#feesTable').DataTable({
                            data: data,
                            columns: [{
                                    data: null,
                                    title: '#',
                                    orderable: false,
                                    render: function(data, type, row, meta) {
                                        return meta.row + 1;
                                    }
                                },
                                {
                                    data: 'name',
                                    title: 'Plan Name',
                                },
                                {
                                    data: 'amount',
                                    title: 'Plan Amount',
                                    render: function(data) {
                                        const euroFormatter = new Intl
                                            .NumberFormat('en-US', {
                                                style: 'currency',
                                                currency: 'EUR',
                                            });

                                        return euroFormatter.format(data);
                                    }
                                },
                                {
                                    data: 'plan_period',
                                    title: 'Plan Period',
                                    render: function(data) {
                                        return '<span class="badge badge-info">' +
                                            data + '</span>';
                                    }
                                },
                                {
                                    data: 'currency',
                                    title: 'Currency',
                                    render: function(data) {
                                        return '<span class="badge badge-danger">' +
                                            data + '</span>';
                                    }
                                    
                                },
                                {
                                    data: 'user_name',
                                    title: 'Created By',
                                    render: function(data) {
                                        return '<span class="badge badge-success">' +
                                            data + '</span>';
                                    }
                                },
                                {
                                    data: 'id',
                                    title: 'Actions',
                                    orderable: false,
                                    render: function(data, type, row) {
                                        var editUrl =
                                            "{{ route('add-fees.edit', ':id') }}"
                                            .replace(':id', data);
                                        var deleteUrl =
                                            "{{ route('add-fees.destroy', ':id') }}"
                                            .replace(':id', data);

                                        return '<a href="' + editUrl +
                                            '" class="btn btn-sm bg-success-light me-2"> <i class="feather-edit"></i> </a> &nbsp; ' +
                                            '<form action="' + deleteUrl +
                                            '" method="POST">' +
                                            '@csrf' +
                                            '@method('DELETE')' +
                                            '<button type="submit" class="btn btn-sm bg-danger-light"><i class="feather-trash"></i></button>' +
                                            '</form>&nbsp;';
                                    }
                                },
                            ],
                        });
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
