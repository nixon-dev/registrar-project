<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/ico" href="{{ asset('img/favicon.ico') }}">
    <title> @yield('title', 'Registrar Office (QSU)')</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css'])

</head>
<body class="dark-skin-2">
    <div class="loginColumns animated fadeInDown" style="margin-top: -80px;">
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-center mb-4">
                <img src="{{ asset('img/logo/QSU.png') }}"
                    style="width: 150px; height: auto; object-fit: cover;" />
            </div>
            <div class="col-md-12">
                @include('components.alert')
            </div>
            <div class="col-md-6 d-md-block d-none text-white">
                <h2 class="font-bold">Registrar Office</h2>
                <p>Registrar Document Request</p>
                <p>Track your requests via School ID</p>
            </div>
            @yield('form')
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12 text-white">
                <small class="pull-right">/nixon-dev</small>
                © Quirino State University - Registrar Office
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js ') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/inspinia.js') }}"></script>
</body>
</html>