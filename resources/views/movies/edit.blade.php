@extends('main.app')
@section('title', 'Edytuj film')
@section('content')
    <div class="block">
        <div class="head text-center">
            Edytuj film
        </div>
        <div class="body">
            <form method="POST" action="{{ url('/film') }}/{{ $movie->id }}">
                @csrf
                @method('PUT');
                Title <input type="text" name="title" value="{{ $movie->title }}"><br>
                Description <input type="text" name="desc" value="{{ $movie->desc }}"><br>
                Rok <input type="text" name="year" value="{{ $movie->year }}"><br>
                Fdb <input type="text" name="fdb" value="{{ $movie->fdb }}"><br>
                Rate <input type="text" name="rate" value="{{ $movie->rate }}"><br>
                View <input type="text" name="view" value="{{ $movie->view }}"><br>
                <input type="submit">
            </form>
        </div>

    </div>
@endsection