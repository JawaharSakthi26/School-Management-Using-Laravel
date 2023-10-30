@extends('layouts.auth')
@section('title', 'PreSkool | List Subject')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Subjects</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Subjects</li>
                        </ul>
                    </div>
                </div>
            </div>
            @php
                $typeLabels = [
                    '1' => 'Theory',
                    '2' => 'Practical',
                    '3' => 'Theory & Practical',
                    '4' => 'Extra-Curricular',
                ];
            @endphp
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">

                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Subjects</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="{{ route('add-subject.create') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table border-0 star-student table-hover table-center mb-0 table-striped"
                                    id="datatable">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>ID</th>
                                            <th>Subject Name</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $value)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    <h2>
                                                        <a>{{ $value->name }}</a>
                                                    </h2>
                                                </td>
                                                <td>{{ $typeLabels[$value->type] ?? '' }}</td>
                                                <td>
                                                    @if ($value->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @elseif($value->status == 0)
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a href="{{ route('add-subject.edit', $value->id) }}"
                                                            class="btn btn-sm bg-success-light me-2">
                                                            <i class="feather-edit"></i>
                                                        </a>
                                                        {{-- <a href="{{route()}}" class="btn btn-sm bg-danger-light">
                                                            <i class="feather-trash"></i>
                                                        </a> --}}
                                                        <form action="{{ route('add-subject.destroy', $value->id) }}"
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
        </div>
        <footer>
            <p>Copyright © 2022 Dreamguys.</p>
        </footer>
    </div>
@endsection
