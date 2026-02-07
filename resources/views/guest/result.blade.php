@extends('base.guest')
@section('title', 'Result - Registrar Office (QSU)')
@section('form')
    <div class="col-md-12 d-md-block animated fadeIn">
        <div class="col-sm-12 text-white text-center mb-4">
            <form action="{{ route('checker') }}" method="GET">
                <div class="input-group search-box">
                    <input type="text" class="form-control text-dark" name="student_id"
                        placeholder="Search by student id number... E.g. 19-123456" pattern="^[0-9]{2}-[0-9]{4,6}$"
                        value="{{ $studentId }}" required>

                    <button class="btn btn-search" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                <small class="text-muted d-block">
                    Your information is confidential. Only request status details will be shown.
                </small>
            </form>
        </div>

        @if ($data->isNotEmpty())
            <div class="col-sm mb-4">
                <span class="h5">Request for ID: {{ $studentId }}</span><br>
                <span>{{ $data->count() }} request(s) found</span>
            </div>
        @endif

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
                                    <div class="h4 mb-1">{{ $d->request_type }}</div>
                                    <span class="text-muted d-block">
                                        Request Printed: {{ $d->request_date->format('M d, Y') }}
                                    </span>
                                    <span class="text-muted d-block">
                                        Last Status Update: {{ $d->updated_at->format('M d, Y') }}
                                    </span>
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
                <div class="col-sm-12 text-center p-3">
                    <i class="bi bi-search h1 text-muted"></i>
                    <span class="h4 mt-3 text-white fw-bold d-block mb-2">No Request Found </span>
                    <p class="text-muted mb-1">
                        We couldn’t find any document request under this Student ID: {{ $studentId }}.
                    </p>

                    <p class="text-muted">
                        Please check your Student ID format (example: <b>19-1234</b> or <b>19-123456</b>) and try again.
                    </p>
                    <p class="text-muted">
                        Note: If your request was submitted recently, it may still be in the queue and will appear once it has
                        been processed by the Registrar Staff. </p>
                </div>
            @endforelse
        </div>
    </div>

@endsection
