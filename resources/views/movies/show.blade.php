@extends('layouts.app')
@section('title', $movie->title.' ('.$movie->release_date->year.')')
@section ('content')
    <div class="block">
        <div class="head text-center">
            <a href="#wm1" onclick="openCity(event, 'London')">Opis filmu </a> 
            <a href="#wm2" onclick="openCity(event, 'Paris')">Oglądaj online</a>
            
        </div>
        <div class="body">
            <div class="about_movie_title">
                {{ $movie->title }} ({{ $movie->release_date->year }})
            </div>
            <div class="about_movie">
                <div class="poster">
                    <img src="{{ asset('storage/poster/'.$movie->id.'.jpg') }}" class="thumb" alt="">
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr;" class="info">
                    <a href="{{ $movie->path() }}/edit">Edytuj</a>
                    <div class="key">
                        <p>Gatunek: </p>
                        <p>Odsłon: </p>
                        <p>Ulubione: </p>
                        <p>Ocena: </p>
                    </div>
                    <div class="value">
                        <p>
                            @foreach ($movie->categories as $category)
                            <a href="{{ route('movies.index', ['gatunek' => $category->name]) }}">{{ $category->name }}</a>@if (!$loop->last),@endif
                            @endforeach
                        </p>
                        <p>{{ $movie->view }}</p>
                        <p>Ulubione: </p>
                        <p>{{ $movie->rate }} </p>
                    </div>
                </div>
            </div>
            @foreach ($movie->links as $link)
                <p>{{ $link->domain }}</p>  
            @endforeach
        </div>
    </div>

    <div id="London" class="tabcontent">
        <div class="block">
            <div class="head text-center">
                Opis filmu
            </div>
            <div class="body">
                {{ $movie->desc }}
            </div>
        </div>
    </div>

    <div id="Paris" class="tabcontent">
        <div class="block">
            <div class="head text-center">
                Oglądaj online
            </div>
            <div class="body">
            <div style="position:relative;padding-bottom:56%;padding-top:20px;height:0;"><IFRAME SRC="https://clipwatching.com/embed-3dpgzwuk88e1.html" FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0 SCROLLING=NO WIDTH=640 HEIGHT=360 allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;"></IFRAME></div>
            </div>
        </div>
    </div>
@endsection

<script>
    function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
    }
</script>