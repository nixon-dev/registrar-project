@extends('base.admin')
@section('title', 'Activity Logs - Registrar Office (QSU)')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Activity Log</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Admin</a>
                </li>
                <li class="breadcrumb-item active">
                    Settings
                </li>
                <li class="breadcrumb-item active">
                    <strong>Activity Log</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInDown">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Activity Log </h5>
                    </div>

                    <div class="ibox-content">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                    <th>Student ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activities as $a)
                                    <tr>
                                        <td>{{ $a->created_at->diffForHumans() }}</td>
                                        <td>{{ $a->history_name }}</td>
                                        <td>{{ $a->history_action }}</td>
                                        <td>{{ $a->history_description }}</td>
                                    </tr>
                                @endforeach
                                @empty($activities)
                                    <tr>
                                        <td colspan="4" class="text-center">No Activity Found</td>
                                    </tr>
                                @endempty
                            </tbody>
                        </table>
                        <div class="mt-3 row align-items-center">
                            <div class="col-sm-6">
                                <small class="text-muted">
                                    Showing {{ $activities->firstItem() }} to {{ $activities->lastItem() }} of
                                    {{ $activities->total() }} entries
                                </small>
                            </div>
                            <div class="col-sm-6 d-flex justify-content-end">
                                {{ $activities->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
