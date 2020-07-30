<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <title>@yield('title')</title>

</head>

<body>
    <div class="container">
        <div id="top">
            <a href="{{ url('/') }}">Logo</a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 px-lg-1">
                @include('main.search')
                @yield('content')
            </div>
            <div class="col-lg-5 px-lg-1">
                @include('main.ucp')
                @include('main.sb')
                @include('main.side')
            </div>
        </div>
    </div>
</body>

</html>