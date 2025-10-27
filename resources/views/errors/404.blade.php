<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/ico" href="{{ asset('img/favicon.ico') }}">
    <title>404 Not Found - Registrar Office (QSU)'</title>
    @vite(['resources/css/app.css'])
</head>

<body class="dark-skin-2">
    <div class="loginColumns">
        <div class="row">
            <div class="col-sm-12 text-white d-flex justify-content-center">
                <img class="text-center" src="{{ asset('img/404.jpg') }}"
                    style="width: 80vh ; height: auto; object-fit: cover;" />

            </div>

        </div>
    </div>
</body>
</html>