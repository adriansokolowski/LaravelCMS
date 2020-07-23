@extends('layouts.app')
@section('title', 'Dodaj film')
@section('content')
    <div class="block">
        <div class="bhead text-center">
            Dodaj film
        </div>
        <div class="bbody">
            <form method="POST" action="{{ route('movies.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Tytuł filmu</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title') }}" placeholder="Tytuł filmu...">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="desc">Opis filmu</label>
                    <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc" value="{{ old('desc') }}" placeholder="Opis filmu..." rows="3"></textarea>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="thumb">Okładka filmu</label>
                    <input type="file" class="form-control-file @error('thumb') is-invalid @enderror" name="thumb" id="thumb">
                    @error('thumb')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="categories">Gatunek filmu</label>
                    <select multiple class="form-control" name="categories[]" id="categories">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('categories')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="year">Rok produkcji</label>
                    <input type="number" class="form-control @error('year') is-invalid @enderror" name="year" id="year" value="{{ old('year') }}" placeholder="Rok produkcji...">
                    @error('year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fdb">Fdb</label>
                    <input type="number" class="form-control @error('fdb') is-invalid @enderror" name="fdb" id="fdb" value="{{ old('fdb') }}" placeholder="Fdb...">
                    @error('fdb')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="rate">Ocena</label>
                    <input type="number" class="form-control @error('rate') is-invalid @enderror" name="rate" id="rate" value="{{ old('rate') }}" placeholder="Ocena filmu...">
                    @error('rate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="view">Odsłon</label>
                    <input type="number" class="form-control @error('view') is-invalid @enderror" name="view" id="view" value="{{ old('view') }}" placeholder="Wyświetleń...">
                    @error('view')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Dodaj film</button>
            </form>
        </div>
    </div>
@endsection