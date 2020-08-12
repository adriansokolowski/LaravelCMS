@extends('layouts.app')
@section('title', 'Dodaj film')
@section('content')
    <div class="block">
        <div class="bhead text-center">
            Dodaj film
        </div>
        <div class="bbody">
            <div id="app">
                <movie-create :user="{{ auth()->user() }}"></movie-create>
            </div>
        </div>
    </div>
@endsection