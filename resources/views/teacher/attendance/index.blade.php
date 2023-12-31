@extends('layouts.auth')
@section('title', 'PreSkool | Student Attendance')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="students.html">Dashboard</a></li>
                                <li class="breadcrumb-item active">Attendance</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">

                            <div class="mb-3 float-end">
                                <a href="{{ route('excel-attendance') }}" class="btn btn-success" id="exportExcel">Excel</a>
                                <a href="{{ route('pdf-attendance') }}" class="btn btn-danger" id="exportPdf">PDF</a>
                                <a href="{{ route('attendance.create') }}" class="btn btn-primary mx-3"><i class="fas fa-plus"></i></a>
                            </div>

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Attendance</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                {!! $dataTable->table([
                                    'class' => 'table table-striped table-responsive dt-bootstrap4 no-footer',
                                    'id' => 'datatable-buttons',
                                ]) !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <p>Copyright © 2023 PreSkool.</p>
        </footer>
    </div>
@endsection
