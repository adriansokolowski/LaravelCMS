<div class="block text-center mb-1">
    <div class="bhead">
        <a href="{{ route('movies.index') }}">Filmy</a> |
        <a href="{{ route('series.index') }}">Seriale</a>
    </div>
    <div class="bbody">
        <form action="">
            <div class="input-group">
                <div class="custom-file">
                    <input type="text" class="form-control" placeholder="Tytuł filmu lub serialu">
                </div>
                <div class="input-group-append">
                    <button class="btn btn-custom" type="submit">Szukaj</button>
                </div>
            </div>
        </form>
    </div>
</div>