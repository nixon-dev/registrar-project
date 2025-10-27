<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/ico" href="{{ asset('img/favicon.ico') }}">

    <title>404 Not Found - Registrar Office (QSU)'</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css ') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/personal.css') }}" rel="stylesheet">
    @yield('head')


</head>

<body class="dark-skin-2">

    <div class="loginColumns animated fadeInDown" style="margin-top: -80px;">

        <div class="row">
            <!-- <div class="col-sm-12 text-center mb-2">
                <img class="text-center" src="{{ asset('img/logo/QSU.png') }}"
                    style="width: 150px; height: auto; object-fit: cover;" />
            </div> -->

            <div class="col-sm-12">
                @include('components.alert')
            </div>
            <div class="col-sm-12 text-white text-center">

                <p class="font-bold" style="font-size: 10vh;">404 NOT FOUND</p>

                <h1>
                    Where are you going?
                </h1>

                <img class="text-center" src="{{ asset('img/404.png') }}"
                    style="width: 80vh ; height: auto; object-fit: cover;" />

            </div>

        </div>
        <hr />

    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js ') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>




</body>

</html>