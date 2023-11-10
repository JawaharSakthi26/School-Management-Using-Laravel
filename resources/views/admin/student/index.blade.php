@extends('layouts.auth')
@section('title', 'PreSkool | List Student')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="students.html">Student</a></li>
                                <li class="breadcrumb-item active">All Students</li>
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
                                <a href="{{ route('excel-listStudents') }}" class="btn btn-success" id="exportExcel">Excel</a>
                                <a href="{{ route('pdf-listStudents') }}" class="btn btn-danger" id="exportPdf">PDF</a>
                                <a href="#" class="btn btn-secondary" id="exportCsv">CSV</a>
                                <a href="{{ route('add-student.create') }}" class="btn btn-primary"><i
                                        class="fas fa-plus"></i></a>
                            </div>

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Students</h3>
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
