@extends('layouts.app')
@section('title', 'Dodaj film')
@section('content')
    <div class="block">
        <div class="bhead text-center">
            Dodaj film
        </div>
        <div class="bbody">
            <!-- <form method="POST" action="{{ route('movies.store') }}" enctype="multipart/form-data"> -->
            <!-- @csrf -->
            <div id="app">
                <movie-create :user="{{ auth()->user() }}"></movie-create>
            </div>
            <!-- <div class="form-group row">
                <label for="title" class="col-md-3 col-form-label text-md-right">Tytuł: *</label>

                <div class="col-md-5">
                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-2">
                    <button class="btn btn-custom test">
                        Import
                    </button>

                </div>
            </div> -->
            <!-- <div class="form-group row">
                <label for="desc" class="col-md-3 col-form-label text-md-right">Opis filmu:</label>

                <div class="col-md-7">
                    <textarea class="form-control @error('desc') is-invalid @enderror" name="desc" id="desc" value="{{ old('desc') }}" placeholder="Opis filmu..." rows="3"></textarea>

                    @error('desc')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div> -->
            <!-- <div class="form-group row">
                <label for="thumb" class="col-md-3 col-form-label text-md-right">Okładka filmu: *</label>

                <div class="col-md-7">
                    <input type="file" class="form-control-file @error('thumb') is-invalid @enderror" name="thumb" id="thumb">

                    @error('thumb')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div> -->
            <!-- <div class="form-group row">
                <label for="categories" class="col-md-3 col-form-label text-md-right">Gatunek filmu: *</label>

                <div class="col-md-7">
                    <select multiple class="form-control @error('categories') is-invalid @enderror" name="categories[]" id="categories">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('categories')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div> -->
            <!-- <div class="form-group row">
                <label for="year" class="col-md-3 col-form-label text-md-right">Rok produkcji: *</label>

                <div class="col-md-7">
                <input id="year" type="number" class="form-control @error('year') is-invalid @enderror" name="year" value="{{ old('year') }}" required autocomplete="year" autofocus>

                    @error('year')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="fdb" class="col-md-3 col-form-label text-md-right">Fdb: *</label>

                <div class="col-md-7">
                <input id="fdb" type="number" class="form-control @error('fdb') is-invalid @enderror" name="fdb" value="{{ old('fdb') }}" required autocomplete="fdb" autofocus>

                    @error('fdb')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="rate" class="col-md-3 col-form-label text-md-right">rate: *</label>

                <div class="col-md-7">
                <input id="rate" type="number" class="form-control @error('rate') is-invalid @enderror" name="rate" value="{{ old('rate') }}" required autocomplete="rate" autofocus>

                    @error('rate')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="view" class="col-md-3 col-form-label text-md-right">view: *</label>

                <div class="col-md-7">
                <input id="view" type="number" class="form-control @error('view') is-invalid @enderror" name="view" value="{{ old('view') }}" required autocomplete="view" autofocus>

                    @error('view')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div> -->
                <!-- <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4 text-right">
                        <button type="submit" class="btn btn-custom">
                            Zapisz
                        </button>
                    </div>
                </div> -->
            <!-- </form> -->
        </div>
    </div>
@endsection