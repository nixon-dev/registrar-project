@extends('base.guest')
@section('title', 'Result - Registrar Office (QSU)')
@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection
@section('form')
    <div class="col-md-12 d-md-block">
        <div class="col-sm-12 text-white text-center">
            @if ($data->isNotEmpty())
                <a href="{{ route('home') }}" class="btn btn-sm btn-primary mb-3 "><i class="fa fa-arrow-left"
                        aria-hidden="true"></i>
                    Back</a>
            @endif
        </div>
        <div class="row">
            @forelse ($data as $d)
                <div class="col-sm-6 mb-4">
                    <div class="ibox-content dark-skin">
                        <h3>
                            @php
                                $status = match ($d->status) {
                                    'Released' => 'success',
                                    'For Release' => 'primary',
                                    'For Signing' => 'warning',
                                    'On Process' => 'light',
                                    default => 'secondary',
                                };
                            @endphp
                            <span class="badge bg-{{$status}} float-right p-2"><strong>{{ $d->status }}</strong></span>
                        </h3>
                        @php
                            $type = match ($d->request_type) {
                                'Transcript of Records' => 'file-text-o',
                                'Certificate of Graduation' => 'graduation-cap',
                                'Diploma' => 'certificate',
                                default => 'file-o',
                            };
                        @endphp
                        <i class="fa fa-{{$type}} fa-3x float-left" aria-hidden="true"></i>
                        <h4>&nbsp;&nbsp;{{$d->request_type}}<br><small
                                class="text-muted">&nbsp;&nbsp;&nbsp;{{  Carbon\Carbon::parse($d->request_date)->format('M d, Y') }}</small>
                        </h4>
                        <br>
                        <div class="row g-2">
                            <div class="col-6">Student ID:</div>
                            <div class="col-6 text-right text-secondary">{{$d->student_id}}</div>
                            <div class="col-6">Purpose:</div>
                            <div class="col-6 text-right text-secondary">{{ $d->purpose }}</div>
                            <div class="col-6">Last Updated:</div>
                            <div class="col-6 text-right text-secondary">
                                {{  Carbon\Carbon::parse($d->updated_at)->format('M d, Y') }}</div>
                        </div>
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