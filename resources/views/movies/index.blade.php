@extends('layouts.app')
@section('title', 'Strona Główna')
@section('content')
<div id="app">
    <movies-index :category="'{{ request('category') }}'" :year="'{{ request('year') }}'"></movies-index>
</div>
<!--     
    <div class="block">
        <div class="bhead text-center">
            <ul class="nav nav-pills justify-content-around" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="ostatnio-dodane-tab" data-toggle="pill" href="#ostatnio-dodane" role="tab" aria-controls="ostatnio-dodane" aria-selected="true">Ostatnio Dodane</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="ostatnio-ogladane-tab" data-toggle="pill" href="#ostatnio-ogladane" role="tab" aria-controls="ostatnio-ogladane" aria-selected="false">Ostatnio Oglądane</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="najpopularniejsze-tab" data-toggle="pill" href="#najpopularniejsze" role="tab" aria-controls="najpopularniejsze" aria-selected="false">Najpopularniejsze</a>
                </li>
            </ul>
        </div>
        <div class="bbody p-0">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="ostatnio-dodane" role="tabpanel" aria-labelledby="ostatnio-dodane-tab">
                @forelse ($movies as $movie)
                <div class="item d-flex m-2">
                    <div class="poster">
                        <img src="{{ asset('storage/poster/'.$movie->id.'.jpg') }}" class="thumb" alt="">
                    </div>
                    <div class="info">
                    <a href="{{ $movie->path() }}" title="{{ $movie->title }}" class="font-weight-bold">{{ Str::limit($movie->title, 100) }}</a>
                        <div class="gen">
                            <a href="{{ route('movies.index', ['rok' => $movie->year]) }}">{{ $movie->year }}</a> | 
   
                            @foreach ($movie->categories as $category)
                                <a href="{{ route('movies.index', ['gatunek' => $category->name]) }}">{{ $category->name }}</a>@if (!$loop->last),@endif
                            @endforeach
                            | USA
                            <img src="https://raw.githubusercontent.com/multitheftauto/mtasa-resources/master/%5Badmin%5D/admin/client/images/flags/de.png" alt=""> 
                        </div>
                        <div class="desc">{{ Str::limit($movie->desc, 255) }}</div>
                        <p class="bar mb-0">
                            1111 odsłon Lektor Napisy
                        </p>
                    </div>
                </div>
                @empty
                <p>Brak wyników</p>
            @endforelse
                </div>
                <div class="tab-pane fade" id="ostatnio-ogladane" role="tabpanel" aria-labelledby="ostatnio-ogladane-tab">

                </div>
                <div class="tab-pane fade" id="najpopularniejsze" role="tabpanel" aria-labelledby="najpopularniejsze-tab">
                @forelse ($movies as $movie)
                <div class="item d-flex m-2">
                    <div class="poster">
                        <img src="{{ asset('static/poster/'.$movie->id.'.jpg') }}" class="thumb" alt="">
                    </div>
                    <div class="info">
                        <a href="{{ $movie->path() }}" class="font-weight-bold">{{ Str::limit($movie->title, 65) }}</a>
                        <p>
                        <a href="{{ route('movies.index') }}">{{ $movie->year }}</a> | 
   
                            @foreach ($movie->categories as $category)
                                <a href="{{ route('movies.index', ['gatunek' => $category->name]) }}">{{ $category->name }}</a>@if (!$loop->last),@endif
                            @endforeach
                            | USA 
                            <img src="https://raw.githubusercontent.com/multitheftauto/mtasa-resources/master/%5Badmin%5D/admin/client/images/flags/pl.png" alt=""> 
                        </p>
                        <p class="desc">{{ Str::limit($movie->desc, 255) }}</p>
                        <p class="bar">
                        1111 odsłon Lektor Napisy
                        </p>
                    </div>
                </div>
                @empty
                <p>Brak wyników</p>
            @endforelse
                </div>
                {{ $movies->withQueryString()->links() }}
            </div>
            
        </div>
    </div> -->
@endsection