<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <meta name="description" content="Apprenticeship.">
    <meta name="msapplication-tap-highlight" content="no">

    <title>Voting</title>

    <link rel="icon" href="{{ asset('images/android-chrome-512x512.png') }}" sizes="512x512" type="image/png">
    <link rel="icon" href="{{ asset('images/android-chrome-192x192.png') }}" sizes="192x192" type="image/png">
    <link rel="icon" href="{{ asset('images/favicon-16x16.png') }}" sizes="16x16" type="image/png">
    <link rel="icon" href="{{ asset('images/favicon-32x32.png') }}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('images/apple-touch-icon.png') }}" sizes="180x180" type="image/png">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    @yield('css_includes')
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light rounded-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="logo" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.scan') }}">Vote</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.home') }}">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-12">
            @include('common.errors')
            @include('common.flash')
        </div>
    </div>
</div>
@yield('content')

{{--<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>--}}
<script type="text/javascript" src="{{ asset('js/bootstrap_.min.js') }}"></script>

<!-- Custom JS -->

<!-- JS from views -->
@yield('js')

</body>
</html>
