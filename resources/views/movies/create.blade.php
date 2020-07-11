@extends('layouts.app')
@section('title', 'Dodaj film')
@section('content')
    <div class="block">
        <div class="head text-center">
            Dodaj film
        </div>
        <div class="body">
            <form method="POST" action="{{ url('/filmy') }}">
                @csrf
                Title <input type="text" name="title" value="{{ old('title') }}"><br>
                @error('title')
                    <p>{{ $errors->first('title') }}</p><br>
                @enderror
                Description <textarea name="desc" id="" cols="30" rows="10">
                    {{ old('desc') }}
                </textarea><br>
                Rok <input type="text" name="year" value="{{ old('year') }}"><br>
                Fdb <input type="text" name="fdb"><br>
                Rate <input type="text" name="rate"><br>
                View <input type="text" name="view"><br>
                <input type="submit">
            </form>
        </div>

    </div>
@endsection