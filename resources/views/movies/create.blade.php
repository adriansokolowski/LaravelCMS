@extends('layouts.app')
@section('title', 'Dodaj film')
@section('content')
<div class="block">
    <div class="bhead text-center">
        Dodaj film
    </div>
    <div class="bbody">
        @if (auth()->user()->is_admin)
        <p>Jesteś zalogowany jako administrator</p>
        @endif
        <div id="app">
            <movie-create :user="{{ auth()->user() }}"></movie-create>
        </div>
    </div>
</div>
@endsection