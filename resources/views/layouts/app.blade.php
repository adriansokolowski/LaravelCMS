<!DOCTYPE html>
<html lang="pl">

<head>
    <title>@yield('title')</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
</head>

<body>
    <div id="app">
        <div class="container">
            <div id="top">
                <a href="{{ url('/') }}">Logo</a>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 px-lg-1">
                    @include('layouts.search')
                    @yield('content')
                </div>
                <div class="col-lg-5 px-lg-1">
                    @include('layouts.ucp')
                    @include('layouts.sb')
                    @include('layouts.side')
                </div>
            </div>
            <div class="col-lg-12 p-5">Copyright @ 2020</div>
        </div>
    </div>
</body>

</html>