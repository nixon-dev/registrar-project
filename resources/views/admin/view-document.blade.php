@extends('admin.base')
@section('title', 'View Document - Management Information System')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('css/plugins/iCheck/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins/jQueryUI/jquery-ui.css') }}" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">
    <style>
        .dropzone {
            background: #e3e6ff;
            border-radius: 13px;
            max-width: 550px;
            margin-left: auto;
            margin-right: auto;
            border: 2px dotted #1833FF;
            margin-top: 50px;
        }
    </style>
@endsection


@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
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
        <div class="col-sm-4 d-none">
            <div class="title-action">
                <a href="#" class="btn btn-primary">Update Status</a>
            </div>


        </div>
    </div>

    @include('components.message')



    <div class="row">
        <div class="col-lg-6">
            <div class="wrapper wrapper-content animated fadeInDown">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="m-b-md">
                                    <!-- <a data-toggle="modal" href="#items-form"
                                                        class="btn btn-primary btn-xs pull-right m-l-10">Add Items</a>

                                                    <a data-toggle="modal" href="#amount-form"
                                                        class="btn btn-primary btn-xs pull-right m-l-10">Edit Document</a -->

                                    <a data-toggle="modal" href="#modal" class="btn btn-primary btn-xs pull-right">Update
                                        Status</a>
                                    <h2 class="font-bold">{{ $data->student_id }} | {{ $data->last_name }},
                                        {{ $data->first_name }} {{ $data->middle_name }}
                                    </h2>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <dl class="dl-horizontal">
                                            <dt class="fs-18 mb-1">Status:</dt>
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <dl class="dl-horizontal">

                                    <dt class="fs-18">Request Date:</dt>
                                    <dd class="fs-16">{{  Carbon\Carbon::parse($data->request_date)->format('M d, Y') }}
                                    </dd>
                                    <dt class="fs-18">OR Number:</dt>
                                    <dd class="fs-16">{{ $data->or_number }}</dd>
                                    <dt class="fs-18">OR Date:</dt>
                                    <dd class="fs-16">{{  Carbon\Carbon::parse($data->or_date)->format('M d, Y') }}
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

                    </div>
                </div>

            </div>
        </div>
    </div>




@endsection

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
                            <option value="On Process" {{ $data->status == 'On Process' ? 'selected' : '' }}>On Process
                            </option>
                            <option value="For Signing" {{ $data->status == 'For Signing' ? 'selected' : '' }}>For Signing
                            </option>
                            <option value="For Release" {{ $data->status == 'For Release' ? 'selected' : '' }}>For Release
                            </option>
                            <option value="Released" {{ $data->status == 'Released' ? 'selected' : '' }}>Released</option>
                        </select>
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


@section('script')
    <script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.i-checks').on('ifChanged', function (event) {
                let checkbox = $(this).find('input[type="checkbox"]');
                let itemId = checkbox.attr('onchange').match(/'([^']+)'/)[1]; // Extract 'air' or 'dv'
                let isChecked = checkbox.prop('checked');

                updateStatus(itemId, isChecked);
            });
        });

        function updateStatus(itemId, isChecked) {
            var document_id = {{ $data->dr_id }};
            var token = "{{ csrf_token() }}";

            $.ajax({
                method: 'POST',
                url: '/admin/document/update-status',
                data: {
                    'document_id': document_id,
                    'item_column': itemId,
                    'item_status': isChecked ? true : false,
                    _token: token,
                },
                success: function (response) {
                    console.log("Success:", response);
                },
                error: function (xhr) {
                    console.error("Error:", xhr.responseText);
                }
            });
        }
    </script>
@endsection