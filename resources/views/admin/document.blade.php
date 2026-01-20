@extends('base.admin')
@section('title', 'Document Request - Registrar Office (QSU)')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">

@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-12">
            <div class="title-action pull-right">
                <a data-toggle="modal" href="#modal-form" class="btn btn-primary">Add Request</a>
            </div>
            <h2>Document Tracking</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Admin</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Document Tracking</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInDown">

        @include('components.message')

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Document Data</h5>
                    </div>
                    <div class="ibox-content">
                        <table id="documentTable" class="table table-bordered table-responsive table-hover">
                            <thead>
                                <tr>
                                    <th class="wp-10">Request Date</th>
                                    <th class="wp-10">Student ID</th>
                                    <th class="wp-35">Name</th>
                                    <th class="wp-20">Type of Request</th>
                                    <th class="wp-10">By</th>
                                    <th class="wp-15 text-center">Status</th>
                                    <th class="wp-20 text-center">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $d)
                                    <tr>
                                        <td>{{  Carbon\Carbon::parse($d->request_date)->format('M d, Y') }}</td>
                                        <td> @shorten($d->student_id, 50) </td>
                                        <td> {{ $d->last_name }}, {{ $d->first_name }} {{ $d->middle_name }} </td>
                                        <td> {{ $d->request_type }} </td>

                                        <td> {{ $d->username }} </td>
                                        <td class="text-center font-bold">
                                            {{ $d->status }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.document-view', ['id' => $d->dr_id]) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye text-white"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="wp-10">Request Date</th>
                                    <th class="wp-10">Student ID</th>
                                    <th class="wp-20">Name</th>
                                    <th class="wp-15">Type of Request</th>
                                    <th class="wp-10">By</th>
                                    <th class="wp-15 text-center">Status</th>
                                    <th class="wp-20 text-center">View</th>
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

                                <div class="form-group d-none">
                                    <label>Request Date</label>
                                    <input type="date" name="request_date" value="{{ date('Y-m-d') }}" class="form-control"
                                        onfocus="this.showPicker()">
                                </div>
                                <div class="form-group">
                                    <label>Request Type *</label>
                                    <select name="request_type" class="form-control" required>
                                        <option value="Transcript of Records" selected>Transcript of Records
                                        </option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Certificate of Graduation">Certificate of Graduation</option>
                                        <option value="Others (WIP)">Others (WIP)</option>
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
                                            <input type="text" name="middle_name" placeholder="" class="form-control ">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Course *</label>
                                            <input type="text" name="course" placeholder="" class="form-control" required>
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
                                        <option value="For Signing" selected>For Signing</option>
                                        <option value="For Release">For Release</option>
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

    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script>
        $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

        $(document).ready(function () {
            $('#documentTable').DataTable({
                language: {
                    zeroRecords: "No Request Found"
                },
                pageLength: 50,
                order: [],
                responsive: true,
                columnDefs: [{
                    'orderable': false,
                    'targets': [6, 7]
                }],
                initComplete: function () {
                    const api = this.api();
                    if (api.data().count() > 0) {
                        api.columns([3, 5, 6])
                            .every(function () {
                                var column = this;

                                var select = $('<select style="width: 100%;"><option value=""></option></select>')
                                    .appendTo($(column.footer()).empty())
                                    .on('change', function () {
                                        column
                                            .search($(this).val(), {
                                                exact: true
                                            })
                                            .draw();
                                    });

                                column
                                    .data()
                                    .unique()
                                    .sort()
                                    .each(function (d, j) {
                                        select.append(
                                            '<option value="' + d + '">' + d + '</option>'
                                        );
                                    });
                            });
                    }
                }
            });
        });
    </script>

@endsection