@extends('base.admin')
@section('title', 'Document Request - Registrar Office (QSU)')
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
                            <strong>DRT</strong>
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
                        <h5>Academic Document Request Monitoring System</h5>
                        <br>
                        <div class="ibox-tools">
                            <div id="bulk-actions" class="bulk-actions d-none pull-left">
                                <button id="bulk-delete" type="button" class="btn btn-danger mr-5 pl-3 pr-3"
                                    data-delbulk-url="{{ route('admin.documents.bulkDelete') }}"
                                    data-delbulk-csrf="{{ csrf_token() }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                        <path
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                    </svg> <strong>Delete</strong></button>
                                <div class="bulk-select">

                                    <select id="bulk-status" class="form-control"
                                        data-bulk-url="{{ route('admin.documents.bulkUpdate') }}"
                                        data-bulk-csrf="{{ csrf_token() }}">
                                        <option value="" selected disabled>Change status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Processing">Processing</option>
                                        <option value="Ready for Pickup">Ready for Pickup</option>
                                        <option value="Released">Released</option>
                                    </select>
                                </div>
                                <button id="apply-bulk" class="btn btn-primary btn-md">
                                    <i class="bi bi-floppy"></i> Save Changes
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
                                        <input type="checkbox" id="select-all" class="check-lg">
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-form" class="animated modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Request Info</h3>
                            <form role="form" action="{{ route('admin.document-add-request') }}" method="POST">
                                @csrf()
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
                                        <div class="form-group ">
                                            <label>Student ID *</label>
                                            <input type="text" name="student_id" placeholder="" class="form-control "
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
    <script src="{{ asset('js/dtab.js') }}" defer></script>

@endsection
