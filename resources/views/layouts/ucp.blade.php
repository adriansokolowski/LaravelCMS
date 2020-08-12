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
                    <a href="/register">Rejestracja</a> |
                    <a href="">przypomnienie hasła</a>
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-custom">Zaloguj się</button>
                </div>
        </form>
    </div>
</div>
@else
<div class="block mb-1">
    <div class="bhead text-center">
        {{ Auth::user()->email }} {{ Auth::user()->name }} <a href="{{ route('logout') }}"> Wyloguj </a>
    </div>
    <div class="bbody">
        Panel uzytkownika
        <a href="{{ route('movies.create') }}">Dodaj film</a>
    </div>
</div>
@endguest