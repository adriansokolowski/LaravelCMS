@extends('layouts.app')
@section('title', 'Strona Główna')
@section('content')
    <div class="block">
        <div class="bhead text-center">
            <ul class="nav nav-pills justify-content-around" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Ostatnio Dodane</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Ostatnio Oglądane</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Najpopularniejsze</a>
                </li>
            </ul>
        </div>
        <div class="bbody">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                @foreach ($movies as $movie)
                <div class="item">
                    <div class="poster">
                        <img src="{{ asset('static/poster/'.$movie->id.'.jpg') }}" class="thumb" alt="">
                    </div>
                    <div class="info">
                        <h3><a href="{{ $movie->path() }}">{{ Str::limit($movie->title, 55) }}</a></h3>
                        <p>
                            {{ $movie->year }} | 
   
                            @foreach ($movie->categories as $category)
                                <a href="#">{{ $category->name }}</a>@if (!$loop->last),@endif
                            @endforeach
                            | USA
                        </p>
                        <p class="desc">{{ Str::limit($movie->desc, 255) }}</p>
                        <p class="bar">
                        </p>
                    </div>
                </div>
            @endforeach
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
            </div>
        </div>
    </div>
@endsection