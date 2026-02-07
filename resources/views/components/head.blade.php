<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Document Tracking Status System | Quirino State University')</title>

    <meta name="description" content="@yield('meta_description', 'The Document Tracking Status System of Quirino State University allows students to track requests for Transcript of Records, Diplomas, and other official documents.')">

    <meta name="keywords" content="Quirino State University, QSU Registrar, Document Tracking System, Transcript of Records, TOR, Diploma, OTR">

    <meta name="author" content="Quirino State University">
    <link rel="author" href="https://github.com/nixon-dev">

    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="robots" content="index, follow">

    <meta property="og:title" content="@yield('og_title', 'Document Tracking Status System | Quirino State University')">
    <meta property="og:description" content="@yield('og_description', 'Track and monitor document requests such as Transcript of Records, Diplomas, and other registrar services.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('img/og-image.webp'))">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'Document Tracking Status System | Quirino State University')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Track and monitor document requests such as Transcript of Records, Diplomas, and other registrar services.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('img/og-image.webp'))">

    <meta name="theme-color" content="#0f172a">

    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;700&display=swap">


    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
