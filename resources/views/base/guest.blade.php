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

    @yield('head')
</head>

<body class="dark-skin-2">
    <div class="loginColumns animated fadeInDown" style="margin-top: -80px;">
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-center mb-2">
                <img id="qsulogo" src="{{ asset('img/logo/QSU.png') }}"
                    style="width: 150px; height: auto; object-fit: cover;" />
            </div>
            <div class="col-sm-12">
                @include('components.alert')
            </div>
            <div class="col-sm-12 text-white text-center">
                <h2 class="font-bold">Registrar Document Request</h2>
                <p>Track your requests via School ID</p>
            </div>
            @yield('form')
        </div>
        <hr />
        <div class="row">
            <div class="footer dark-skin-2">
                <div class="text-white pull-left">
                    <small>© QSU - Registrar Office</small>
                </div>
                <div class="pull-right text-white">
                    <small class="pull-right">/nixon-dev</small>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js ') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('js/inspinia.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const logoElement = document.getElementById('qsulogo');
            const redirectUrl = '{{route('login')}}';
            const requiredClicks = 3;
            const clickTimeoutMs = 500;

            let clickCounter = 0;
            let timer = 100;

            if (logoElement) {
                logoElement.addEventListener('click', function () {
                    clickCounter++;

                    if (clickCounter === requiredClicks) {
                        clearTimeout(timer);
                        clickCounter = 0;

                        window.location.href = redirectUrl;

                        return;
                    }

                    if (timer) {
                        clearTimeout(timer);
                    }

                    timer = setTimeout(() => {
                        clickCounter = 0;
                        timer = null;
                        console.log('Click sequence timed out. Counter reset.');
                    }, clickTimeoutMs);

                    console.log(`Click count: ${clickCounter}`);
                });
            }
        });
    </script>
</body>

</html>