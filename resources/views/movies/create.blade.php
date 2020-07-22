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
                <div class="form-group">
                    <label for="title">Tytuł filmu</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Tytuł filmu...">
                    @error('title')
                        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="desc">Opis filmu</label>
                    <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc" placeholder="Opis filmu..." rows="3"></textarea>
                    @error('title')
                        <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="year">Rok produkcji</label>
                    <input type="number" class="form-control @error('year') is-invalid @enderror" name="year" id="year" placeholder="Rok produkcji...">
                    @error('year')
                        <div class="invalid-feedback">{{ $errors->first('year') }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fdb">Fdb</label>
                    <input type="number" class="form-control @error('fdb') is-invalid @enderror" name="fdb" id="fdb" placeholder="Fdb...">
                    @error('fdb')
                        <div class="invalid-feedback">{{ $errors->first('fdb') }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="rate">Ocena</label>
                    <input type="number" class="form-control @error('rate') is-invalid @enderror" name="rate" id="rate" value="0" placeholder="Ocena filmu...">
                    @error('rate')
                        <div class="invalid-feedback">{{ $errors->first('rate') }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="view">Odsłon</label>
                    <input type="number" class="form-control @error('view') is-invalid @enderror" name="view" id="view" value="0" placeholder="Wyświetleń...">
                    @error('view')
                        <div class="invalid-feedback">{{ $errors->first('view') }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Dodaj film</button>
            </form>
        </div>
    </div>
@endsection