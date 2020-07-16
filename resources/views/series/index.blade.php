@extends('layouts.app')
@section('title', 'Seriale')
@section('content')
    <div class="block">
    <div class="head text-center">
        Seriale
    </div>
    <div class="body"></div>
    @forelse ($series as $serie)
    <div class="item">
        <div class="poster">
            <img src="{{ asset('static/poster/'.$serie->id.'.jpg') }}" class="thumb" alt="">
        </div>
        <div class="info">
            <h3><a href="">{{ Str::limit($serie->title, 55) }}</a></h3>
            <p>{{ $serie->year }} | 
                

            </p>
            <p class="desc">{{ Str::limit($serie->desc, 255) }}</p>
            <p class="bar">
            </p>
        </div>
    </div>
    @empty
    <p>Brak wyników</p>
    @endforelse
    </div>
@endsection