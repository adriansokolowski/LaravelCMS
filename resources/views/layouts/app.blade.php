<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>
    <title>@yield('title')</title>
</head>
<body>
    <div class="wrapper">
        <div id="top">
            <a href="{{ url('/') }}">Logo</a>
        </div>
    </div>
    <div class="wrapper">
        <div id="left">
            <div class="block">
                <div class="head text-center white">
                    <a href="{{ route('movies.index') }}">Filmy</a> | Seriale
                </div>
                <div class="body text-center">
                    <input type="text" placeholder="Tytuł filmu lub serialu">
                    <input type="submit" value="Szukaj">
                </div>
            </div>
                @yield('content')
        </div>
        <div id="right">
            <div class="block">
                <div class="head text-center">
                    Panel logowania
                </div>
                <div class="body text-center">
                    <input class="field" type="text" placeholder="Login">
                    <input class="field" type="password" placeholder="Hasło">
                    Zarejestruj się | Zapomniałeś hasła?
                    <input type="submit" value="Zaloguj">
                </div>
            </div>
            <div class="block">
                <div class="head text-center">
                    ShoutBox
                </div>
                <div class="body">
                    Dostęp tylko dla zalogowanych użytkowników
                </div>
            </div>
            <div class="block">
                <div class="head text-center">
                    Filmy Online Seriale Online
                </div>
                <div class="body categories">
                    @foreach ($categories as $category)
                        <div class="category">
                        <a href="#">{{ $category->name }} ({{ $category->movies->count() }})</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>