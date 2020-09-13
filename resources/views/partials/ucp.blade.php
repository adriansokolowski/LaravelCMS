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
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        przypomnienie hasła
                    </a>
                    @endif
                </div>
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-custom">Zaloguj się</button>
                </div>
        </form>
    </div>
</div>
@else
<ucp :user="{{ auth()->user() }}"></ucp>
<div class="block mb-1">
    <div class="bhead text-center">
        {{ auth()->user()->name }} Konto Ulubione
        <a href="{{ route('logout') }}"> Wyloguj </a>
        @if (auth()->user()->is_admin)
        <a href="/admin">Panel administratora</a>
        @endif
    </div>
    <div class="bbody">
        <a href="{{ route('movies.create') }}">Dodaj film</a>
    </div>
</div>
@endguest