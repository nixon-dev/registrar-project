@extends('guest.base')
@section('title', 'Document Request Checker - Registrar Office (QSU)')
@section(section: 'head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .search-container {
            position: relative;
        }

        .search-input {
            height: 50px;
            border-radius: 30px;
            padding-left: 35px;
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .search-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #888;
        }
    </style>
@endsection
@section('form')

    <div class="col-md-12 d-md-block">
        <div class="">

            <form class="m-t" role="form" action="{{ route('checker') }}" method="POST">
                @csrf
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="search-container">
                                <input type="text" class="form-control search-input  border-secondary" name="student_id"
                                    placeholder="Search by student id number... E.g. 19-11270" required>
                                <i class="fas fa-search search-icon"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary full-width m-b d-none">Check</button>

            </form>

        </div>
    </div>
    

@endsection