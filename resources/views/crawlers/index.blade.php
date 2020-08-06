@extends('layouts.app')

@section('content')
    <div class="block">
        <div class="bhead text-center">Fdb.pl</div>
        <div class="bbody">
        <form method="POST" action="{{ route('crawlers.add') }}">
            @csrf
            <div class="form-group row">
                <label for="from" class="col-md-4 col-form-label text-md-right">Od: *</label>

                <div class="col-md-6">
                    <input id="from" type="number" class="form-control @error('from') is-invalid @enderror" name="from" value="{{ old('from') }}" required autocomplete="from" autofocus>

                    @error('from')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="to" class="col-md-4 col-form-label text-md-right">Do: *</label>

                <div class="col-md-6">
                    <input id="to" type="number" class="form-control @error('to') is-invalid @enderror" name="to" value="{{ old('to') }}" required autocomplete="to" autofocus>

                    @error('to')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-custom">
                        Wyślij
                    </button>
                </div>
            </div>
        </form>
    
    </div>
    </div>
@endsection