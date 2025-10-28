@extends('base.admin')
@section('title', 'View Document Request- Registrar Office (QSU)')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/plugins/jQueryUI/jquery-ui.css') }}" type="text/css" />
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-12">
            <div class="title-action pull-right">
                <a data-toggle="modal" href="#modal" class="btn btn-primary ">Update
                    Status</a>
            </div>
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
    </div>
    @include('components.message')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInDown">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="row mb-3">

                                    <div class="col-10 ">
                                        <div class="m-b md  pull-left mr-4 ml-4">
                                            @php
                                                $type = match ($data->request_type) {
                                                    'Transcript of Records' => 'file-text-o',
                                                    'Certificate of Graduation' => 'graduation-cap',
                                                    'Diploma' => 'certificate',
                                                    default => 'file-o',
                                                };
                                            @endphp
                                            <h1><i class="fa fa-{{$type}} fa-3x float-left" aria-hidden="true"></i></h1>
                                        </div>
                                        <div class="m-b-md">
                                            <h2 class="font-bold text-dark">
                                                {{ $data->last_name }}, {{ $data->first_name }} {{ $data->middle_name }}
                                            </h2>
                                            <h3 class="text-dark">{{ $data->student_id }}</h3>
                                        </div>

                                    </div>
                                    <div class="col-1 ml-4 mr-3">

                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <dl class="dl-horizontal">
                                                <dt class="fs-18">Status:</dt>
                                                <dd class="fs-16">
                                                    @php
                                                        $status = match ($data->status) {
                                                            'For Release' => 'success',
                                                            'For Signing' => 'info',
                                                            'On Process' => 'primary',
                                                            default => 'warning',
                                                        };
                                                    @endphp
                                                    <span class="label label-{{ $status }}">{{ $data->status }}</span>
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="col-lg-5">
                                            <dl class="dl-horizontal">
                                                <dt class="fs-18">By:</dt>
                                                <dd class="fs-16">{{ $data->username }}</dd>
                                            </dl>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <dl class="dl-horizontal">

                                                <dt class="fs-18">Request Date:</dt>
                                                <dd class="fs-16">
                                                    {{  Carbon\Carbon::parse($data->request_date)->format('M d, Y') }}
                                                </dd>
                                                <dt class="fs-18">OR Number:</dt>
                                                <dd class="fs-16">{{ $data->or_number }}</dd>
                                                <dt class="fs-18">OR Date:</dt>
                                                <dd class="fs-16">
                                                    {{  Carbon\Carbon::parse($data->or_date)->format('M d, Y') }}
                                                </dd>

                                            </dl>
                                        </div>
                                        <div class="col-lg-7" id="cluster_info">
                                            <dl class="dl-horizontal">
                                                <dt class="fs-18">Type of Request</dt>
                                                <dd class="fs-16">
                                                    {{ $data->request_type }}
                                                </dd>
                                                <dt class="fs-18">Purpose:</dt>
                                                <dd class="fs-16">{{ $data->purpose}}</dd>


                                            </dl>
                                        </div>


                                    </div>
                                    @if (!empty($data->remarks))
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h3>Remarks:</h3>
                                                <h4>{{ $data->remarks }}</h4>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
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
                    <form action="{{ route('admin.document-update-request') }}" method="POST">
                        @csrf()
                        <div class="form-group d-none">
                            <label>id</label>
                            <input type="number" name="dr_id" value="{{ $data->dr_id ?? '' }}" class="form-control"
                                readonly>
                        </div>
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option value="Pending" {{ $data->status == 'Pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="For Signing" {{ $data->status == 'For Signing' ? 'selected' : '' }}>For Signing
                                </option>
                                <option value="For Release" {{ $data->status == 'For Release' ? 'selected' : '' }}>For Release
                                </option>
                                <option value="Released" {{ $data->status == 'Released' ? 'selected' : '' }}>Released</option>
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