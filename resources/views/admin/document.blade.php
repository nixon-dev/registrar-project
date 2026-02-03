@extends('base.admin')
@section('title', 'Document Request - Registrar Office (QSU)')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row wrapper border-bottom page-heading">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Document Request Tracking</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">Admin</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Document Request Tracking</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="title-action">
                        <a data-toggle="modal" href="#modal-form" class="btn btn-primary">Add Request</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInDown">
        @include('components.message')
        <div class="row animated fadeIn">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title p-4">
                        <br>
                        <div class="ibox-tools">
                            <div id="bulk-actions" class="bulk-actions d-none pull-left">
                                <span class="bulk-count"></span>
                                <div class="bulk-select">
                                    <i class="bi bi-arrow-repeat"></i>
                                    <select id="bulk-status" data-bulk-url="{{ route('admin.documents.bulkUpdate') }}"
                                        data-bulk-csrf="{{ csrf_token() }}">
                                        <option value="" selected disabled>Change status…</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Processing">Processing</option>
                                        <option value="Ready for Pickup">Ready for Pickup</option>
                                        <option value="Released">Released</option>
                                    </select>
                                </div>
                                <button id="apply-bulk" class="btn btn-primary btn-md">
                                    Update Status
                                </button>
                            </div>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content table-responsive">
                        <table id="documentTable" class="table table-hover align-middle"
                            data-url="{{ route('admin.documents.data') }}" data-username="{{ auth()->user()->username }}"
                            data-csrf="{{ csrf_token() }}" class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="wp-5">
                                        <input type="checkbox" id="select-all">
                                    </th>
                                    <th class="wp-10">Request Date</th>
                                    <th class="wp-10">Student ID</th>
                                    <th class="wp-25">Name</th>
                                    <th class="wp-20 text-center">Type of Request</th>
                                    <th class="wp-10">Processed By</th>
                                    <th class="wp-15 text-center">Status</th>
                                    <th class="wp-5 text-center">View</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Request Date</th>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Type of Request</th>
                                    <th>Processed By</th>
                                    <th>Status</th>
                                    <th>View</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-form" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Request Info</h3>
                            <form role="form" action="{{ route('admin.document-add-request') }}" method="POST">
                                @csrf()
                                <div class="form-group d-none">
                                    <label>ID</label>
                                    <input type="text" name="admin_id" value="{{ Auth::id() }}" class="form-control"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label>Request Type *</label>
                                    <select name="request_type" class="form-control" required>
                                        <option value="Transcript of Records" selected>Transcript of Records
                                        </option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Certificate of Graduation">Certificate of Graduation</option>
                                        <option value="Honorable Dismissal">Honorable Dismissal</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Student ID *</label>
                                            <input type="text" name="student_id" placeholder="" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Last Name *</label>
                                            <input type="text" name="last_name" placeholder="" class="form-control "
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>First Name *</label>
                                            <input type="text" name="first_name" placeholder="" class="form-control "
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Middle Name</label>
                                            <input type="text" name="middle_name" placeholder=""
                                                class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Course *</label>
                                            <input type="text" name="course" placeholder="" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Year Graduated</label>
                                            <input type="text" name="year_graduated" placeholder="2023 / 2024 / 2025"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="Pending">Pending</option>
                                        <option value="Processing" selected>Processing</option>
                                        <option value="Ready for Pickup">Ready for Pickup</option>
                                        <option value="Released">Released</option>
                                    </select>
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-sm btn-primary m-t-n-xs w-100"
                                        type="submit"><strong>Submit</strong>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}" defer></script>
@endsection
