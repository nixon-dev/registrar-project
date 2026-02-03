@extends('base.guest')
@section('title', 'Result - Registrar Office (QSU)')
@section('form')
    <div class="col-md-12 d-md-block animated fadeIn">
        <div class="col-sm-12 text-white text-center">
            @if ($data->isNotEmpty())
                <a href="{{ route('home') }}" class="btn btn-sm btn-primary mb-3 "><i class="bi bi-arrow-left"
                        aria-hidden="true"></i>
                    Back</a>
            @endif
        </div>
        <div class="col-sm mb-4">
            <span class="h4">Request for ID: {{ $studentId }}</span><br>
            <span>{{ $data->count() }} request(s) found</span>
        </div>
        <div class="row">
            @forelse ($data as $d)
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
                        @if (!empty($d->remarks))
                            <div class="doc-card-body">
                                <strong>Remarks:</strong>
                                <span>{{ $d->remarks }}</span>
                            </div>
                        @endif

                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>

@endsection
