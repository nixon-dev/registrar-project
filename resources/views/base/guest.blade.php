<!DOCTYPE html>
<html>

<head>
    @include('components.head')
    @yield('head')
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="dns-prefetch" href="//cdn.jsdelivr.net">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body class="dark-skin-2">
    <div class="loginColumns" style="margin-top: -60px;">
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-center mb-1 animated fadeInDown">
                <img id="qsulogo" src="{{ asset('img/logo/QSU.webp') }}"
                    style="width: 150px; height: auto; object-fit: cover;" loading="lazy"
                    alt="Quirino State University Logo" />
            </div>
            <div class="col-sm-12 animated fadeIn">
                @include('components.alert')
            </div>
            <div class="col-sm-12 text-white text-center animated fadeInDown">
                <span class="h3">Registrar Document Request</span>
                <p>Track your requests via School ID</p>
            </div>
            @yield('form')
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    
</body>

</html>
