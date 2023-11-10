@extends('layouts.auth')
@section('title', 'PreSkool | My Students')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="students.html">Student</a></li>
                                <li class="breadcrumb-item active">My Students</li>
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
                                <a href="{{ route('excel-myStudents') }}" class="btn btn-success" id="exportExcel">Excel</a>
                                <a href="{{ route('pdf-myStudents') }}" class="btn btn-danger" id="exportPdf">PDF</a>
                                <a href="#" class="btn btn-secondary" id="exportCsv">CSV</a>
                            </div>

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <h3 class="page-title">My Students</h3>
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
