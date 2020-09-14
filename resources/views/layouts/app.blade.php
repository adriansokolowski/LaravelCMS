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
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
</head>

<body>
    <div id="app">
        <v-app>
            <div class="body">
                <v-container>
                    <div id="top">
                        <a href="{{ url('/') }}">Logo</a>
                    </div>
                </v-container>
                <v-container>
                    <v-row>
                        <v-col cols="12" lg="7">
                            <!-- col-lg-7 px-lg-1 -->
                            @include('partials.searchbar')
                            @yield('content')
                        </v-col>
                        <!-- col-lg-5 px-lg-1 -->
                        <v-col>
                            @include('partials.ucp')
                            @include('partials.shoutbox')
                            @include('partials.side')
                        </v-col>
                    </v-row>
                    @include('partials.footer')
                </v-container>
            </div>
        </v-app>
    </div>
</body>

</html>