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

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        {{-- @if ($studentsInClass->isEmpty())
                                            <div class="alert alert-info text-center">
                                                You are not a <b>Class Teacher</b>/No Student is <b>Enrolled in your Class!</b>
                                            </div>
                                        @else --}}
                                            <h3 class="page-title">My Students</h3>
                                    </div>
                                </div>
                            </div>
                            {{-- @endif --}}
                            <div class="card-body">
                                {!! $dataTable->table(['class' => 'table table-striped table-responsive dt-bootstrap4 no-footer', 'id' => 'datatable-buttons']) !!}
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