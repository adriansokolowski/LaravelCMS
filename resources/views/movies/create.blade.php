@extends('layouts.app')
@section('title', 'Dodaj film')
@section('content')
    <div class="block">
        <div class="bhead text-center">
            Dodaj film
        </div>
        <div class="bbody">
            <form method="POST" action="{{ route('movies.store') }}">
                @csrf
                @error('title')
                    <p>{{ $errors->first('title') }}</p>
                @enderror
                <div class="form-group">
                    <label for="title">Tytuł filmu</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Tytuł filmu...">
                </div>
                <div class="form-group">
                    <label for="desc">Opis filmu</label>
                    <textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="year">Rok produkcji</label>
                    <input type="text" class="form-control" name="year" id="year" placeholder="Rok produkcji...">
                </div>
                <div class="form-group">
                    <label for="fdb">Fdb</label>
                    <input type="text" class="form-control" name="fdb" id="fdb" placeholder="Fdb...">
                </div>
                <div class="form-group">
                    <label for="rate">Ocena</label>
                    <input type="text" class="form-control" name="rate" id="rate" placeholder="Ocena filmu...">
                </div>
                <div class="form-group">
                    <label for="view">Odsłon</label>
                    <input type="text" class="form-control" name="view" id="view" placeholder="Wyświetleń...">
                </div>
                <button type="submit" class="btn btn-primary">Dodaj film</button>
            </form>
        </div>
    </div>
@endsection