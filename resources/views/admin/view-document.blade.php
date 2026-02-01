@extends('base.admin')
@section('title', 'View Document Request- Registrar Office (QSU)')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/plugins/jQueryUI/jquery-ui.css') }}" type="text/css" />
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-6">
                    <h2>View Document</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.index') }}">Admin</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.document') }}">Document Tracking</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>{{ $data->dr_id }}</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="title-action">
                        <a data-toggle="modal" href="#modal" class="btn btn-primary ">Update
                            Status</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @include('components.message')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInDown">
                <div class="ibox">
                    <div class="ibox-content doc-view-card">

                        <div class="doc-header">
                            <div class="doc-header-left">
                                <div class="doc-icon">
                                    <i class="bi {{ $data->request_icon }}"></i>
                                </div>
                                <div>
                                    <div class="doc-name">{{ $data->fullname }}</div>
                                    <div class="doc-sub">{{ $data->student_id }}</div>
                                </div>
                            </div>

                            <span class="status-pill status-{{ $data->status_label }}">
                                <i class="bi {{ $data->status_icon }}"></i>
                                <span>{{ $data->status }}</span>
                            </span>
                        </div>

                        <div class="doc-info-grid">
                            <div>
                                <div class="doc-label">Processed by</div>
                                <div class="doc-value">{{ $data->username }}</div>
                            </div>

                            <div>
                                <div class="doc-label">Request Date</div>
                                <div class="doc-value">{{ $data->request_date->format('M d, Y') }}</div>
                            </div>

                            <div>
                                <div class="doc-label">Course</div>
                                <div class="doc-value">{{ $data->course  ?? 'N/A' }}</div>
                            </div>

                            <div>
                                <div class="doc-label">Year Graduated</div>
                                <div class="doc-value">{{ $data->year_graduated ?? 'N/A' }}</div>
                            </div>

                            <div>
                                <div class="doc-label">Type of Request</div>
                                <div class="doc-value">{{ $data->request_type }}</div>
                            </div>
                        </div>

                        @if (!empty($data->remarks))
                            <div class="doc-remarks">
                                <div class="doc-label">Remarks</div>
                                <div class="doc-value">{{ $data->remarks }}</div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id="modal" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="m-t-none m-b">Update Status</h3>
                    <form action="{{ route('admin.document-update-request', ['id' => $data->dr_id]) }}" method="POST">
                        @csrf()
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option value="Pending" {{ $data->status == 'Pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="Processing" {{ $data->status == 'Processing' ? 'selected' : '' }}>Processing
                                </option>
                                <option value="Ready for Pickup"
                                    {{ $data->status == 'Ready for Pickup' ? 'selected' : '' }}>Ready for Pickup
                                </option>
                                <option value="Released" {{ $data->status == 'Released' ? 'selected' : '' }}>Released
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Remarks</label>
                            <textarea name="remarks" id="remarks" class="form-control">{{ $data->remarks ?? '' }}</textarea>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-sm btn-primary m-t-n-xs w-100" type="submit"><strong>Update</strong>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
