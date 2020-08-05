<div class="block mb-1">
    <div class="bhead text-center">
        Filmy Online
    </div>
    <div class="bbody categories">
        @foreach ($categories as $category)
        <div class="category">
            <a href="{{ route('movies.index', ['gatunek' => $category->name]) }}">
                {{ $category->name }} ({{ $category->movies->count() }})
            </a>
        </div>
        @endforeach
    </div>
</div>