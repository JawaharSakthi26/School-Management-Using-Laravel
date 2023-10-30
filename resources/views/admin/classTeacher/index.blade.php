@extends('layouts.auth')
@section('title', 'PreSkool | Class Teacher List')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Classes</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Classes</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="{{ route('add-classTeacher.create') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <table
                                class="table border-0 star-student table-hover table-center mb-0 table-striped" id="datatable">
                                <thead class="student-thread">
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>ID</th>
                                        <th>Teacher</th>
                                        <th>Class</th>
                                        <th>Created By</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $value)
                                        <tr>
                                            <td>
                                                <div class="form-check check-tables">
                                                    <input class="form-check-input" type="checkbox" value="something">
                                                </div>
                                            </td>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                <h2>
                                                    <a>{{ $value->teacher->name }}</a>
                                                </h2>
                                            </td>
                                            <td>{{ $value->class->name }}</td>
                                            <td><span class="badge bg-info">{{ $value->user->name }}</span></td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="{{ route('add-classTeacher.edit', $value->id) }}"
                                                        class="btn btn-sm bg-success-light me-2">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <form action="{{ route('add-classTeacher.destroy', $value->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm bg-danger-light"><i
                                                                class="feather-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
