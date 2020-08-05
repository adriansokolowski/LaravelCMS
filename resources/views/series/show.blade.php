@extends('layouts.app')
@section('title', 'Serial')
@section('content')
<div class="block">
    <div class="bhead">
        asd
    </div>
    <div class="bbody">
        {{ $serie->title }}
        <img src="{{ asset('static/poster/'.$serie->id.'-series.jpg') }}"></a>
    </div>
</div>

@endsection