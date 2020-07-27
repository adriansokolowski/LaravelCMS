<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
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
                <div class="block text-center mb-1">
                    <div class="bhead">
                        <a href="{{ route('movies.index') }}">Filmy</a> | 
                        <a href="{{ route('series.index') }}">Seriale</a>
                    </div>
                        <div class="bbody">
                            <form action="">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="text" class="form-control" placeholder="Tytuł filmu lub serialu">
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-custom" type="submit">Szukaj</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
                    @yield('content')
            </div>
            <div class="col-lg-5 px-lg-1">
                @guest
                <div class="block mb-1">
                    <div class="bhead text-center">
                        Panel logowania
                    </div>
                    <div class="bbody">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-row mb-2">
                                <div class="col px-lg-1">
                                    <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" type="text" placeholder="Login">
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col px-lg-1">
                                    <input class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" type="password" placeholder="Hasło">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        <div class="form-row align-items-center">
                            <div class="col-lg-9">
                                <a href="/register">Zarejestruj się</a> |
                                <a href="">Zapomniałeś hasła?</a>
                            </div>
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-custom">Zaloguj</button>
                            </div>
                        </form>
                            
                            
                    </div>
                    
                    
                </div>
                @else
                    <div class="block mb-1">
                        <div class="bhead text-center">
                            {{ auth()->user()->email }} {{ auth()->user()->name }} <a href="{{ url('/logout') }}"> Wyloguj </a>
                        </div>
                        <div class="bbody">
                            Panel uzytkownika
                        </div>
                    </div> 
                @endguest

            
                <div class="block mb-1">
                    <div class="bhead text-center">
                        ShoutBox
                    </div>
                    <div class="bbody">
                        Dostęp tylko dla zalogowanych użytkowników
                    </div>
                </div>
                <div class="block mb-1">
                    <div class="bhead text-center">
                        Filmy Online
                    </div>
                    <div class="bbody categories">
                        @foreach ($categories as $category)
                            <div class="category">
                            <a href="{{ route('movies.index', ['gatunek' => $category->name]) }}">
                                {{ $category->name }} ({{ $category->movies->count() }})
                            </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>