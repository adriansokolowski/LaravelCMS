@extends('main.app')
@section('title', 'Serial')
@section('content')
    <div class="block">
        <div class="head">
            asd
        </div>
        <div class="body">
            {{ $serie->title }}
            <img src="{{ asset('static/poster/'.$serie->id.'-series.jpg') }}"></a>
        </div>
    </div>
    
@endsection
