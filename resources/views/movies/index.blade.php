@extends('layouts.app')
@section('title', 'Strona Główna')
@section('content')
    <div class="block">
        <div class="head text-center">
            Ostatnio dodane Popularne
        </div>
        <div class="body">
            @forelse ($movies as $movie)
                <div class="item">
                    <div class="poster">
                        <img src="{{ asset('static/poster/'.$movie->id.'.jpg') }}" class="thumb" alt="">
                    </div>
                    <div class="info">
                        <h3><a href="{{ $movie->path() }}">{{ Str::limit($movie->title, 55) }}</a></h3>
                        <p>{{ $movie->year }} | 
                            @foreach ($movie->categories as $category)
                                <a href="{{ route('movies.index', ['gatunek' => $category->name]) }}">{{ $category->name }}</a>@if (!$loop->last),@endif
                            @endforeach

                        </p>
                        <p class="desc">{{ Str::limit($movie->desc, 255) }}</p>
                        <p class="bar">
                        </p>
                    </div>
                </div>
                @empty
                <p>Brak wyników</p>
            @endforelse
        </div>
        {{ $movies->withQueryString()->links() }}

    </div>
@endsection
