@extends('base.guest')
@section('title', 'Result - Registrar Office (QSU)')
@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection
@section('form')
    <div class="col-md-12 d-md-block animated fadeIn">
        <div class="col-sm-12 text-white text-center">
            @if ($data->isNotEmpty())
                <a href="{{ route('home') }}" class="btn btn-sm btn-primary mb-3 "><i class="fa fa-arrow-left"
                        aria-hidden="true"></i>
                    Back</a>
            @endif
        </div>

        <div class="row">
            @forelse ($data as $d)
                <div class="col-sm mb-4">
                    <span class="h4">Request for ID: {{ $d->student_id }}</span><br>
                    <span>{{ $data->count() }} request(s) found</span>
                </div>
                <div class="col-sm-12 mb-4">
                    <div class="doc-card dark-skin">

                        <div class="doc-card-header">
                            <div class="doc-left">
                                <span class="request-icon">
                                    <i class="bi {{ $d->request_icon }}"></i>
                                </span>

                                <div class="doc-title">
                                    <div class="h4 mb-0">{{ $d->request_type }}</div>
                                    <small class="text-muted">
                                        {{ $d->request_date->format('M d, Y') }}
                                    </small>
                                </div>
                            </div>

                            <span class="status-pill status-{{ $d->status_label }}">
                                <i class="bi {{ $d->status_icon }}"></i>
                                <span>{{ $d->status }}</span>
                            </span>
                        </div>

                        <!-- Body -->
                        @if (!empty($d->remarks))
                            <div class="doc-card-body">
                                <strong>Remarks:</strong>
                                <span>{{ $d->remarks }}</span>
                            </div>
                        @endif

                    </div>
                </div>

            @empty
                <div class="col-12 text-center">
                    <h1><i class="fa fa-search fa-5x mb-3 mt-4" aria-hidden="true"></i></h1>
                    <h3>No "Request for Document" Found</h3>
                    <p class="text-white">
                        Make sure your school id is correct...
                    </p>
                    <a href="{{ route('home') }}" class="btn btn-sm btn-primary mb-3 "><i class="fa fa-repeat"
                            aria-hidden="true"></i>
                        Try Again</a>
                </div>
            @endforelse
        </div>
    </div>

@endsection
