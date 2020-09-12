<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Resources\MovieResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Movie;
use App\Models\Country;
use App\Models\Person;
use App\Models\Category;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $sortBy = request('sortBy', 'created_at');
        if (!in_array($sortBy, ['created_at', 'last_view', 'views'])) {
            $sortBy = 'created_at';
        }
        $category = request('category', null);
        $categories = Category::all()->pluck('name')->toArray();
        if (!in_array($category, $categories)) {
            $category = null;
        }

        $year = request('year', null);

        $page = request('page', null);

        $country = request('country', null);
        $countries = Country::all()->pluck('name')->toArray();
        if (!in_array($country, $countries)) {
            $country = null;
        }

        $results = Cache()->remember("homepage-movies-${sortBy}-${year}-${country}-${category}-${page}", 60 * 1, function () use ($category, $year, $country, $sortBy) {
            $query = Movie::query();
            //Movie::query()->select(['title', 'description']);

            if ($category) {
                $query->whereHas('categories', function ($q) {
                    $q->where('categories.name', request('category'));
                });
            }

            if ($year) {
                $query->whereYear('release_date', $year);
            }

            if ($country) {
                $query->whereHas('countries', function ($q) {
                    $q->where('countries.name', request('country'));
                });
            }

            return $query->orderBy($sortBy, 'desc')->paginate(5);
        });

        return MovieResource::collection($results);
    }

    public function store(StoreMovieRequest $request)
    {
        $movie = Movie::firstOrNew(
            ['title' => $request->title],
            $request->validated()
        );
        $movie->html = '';
        $movie->last_view = now();
        $movie->save();
        $contents = file_get_contents($request->poster);
        Storage::disk("public")->put('/poster/' . $movie->id . '.jpg', $contents);
        $movie->categories()->attach($request->categories);

        foreach ($request->countries as $country) {
            $country = Country::query()->firstOrCreate(['name' => $country]);
            $movie->countries()->attach($country);
        }

        foreach ($request->direction as $direction) {
            $direction = Person::query()->firstOrCreate(['name' => $direction]);
            $movie->persons()->attach($direction, ['type' => '1']);
        }

        foreach ($request->screenplay as $screenplay) {
            $screenplay = Person::query()->firstOrCreate(['name' => $screenplay]);
            $movie->persons()->attach($screenplay, ['type' => '2']);
        }

        foreach ($request->cast as $cast) {
            $cast = Person::query()->firstOrCreate(['name' => $cast]);
            $movie->persons()->attach($cast, ['type' => '3']);
        }

        return $movie->path();
    }

    public function show(Movie $movie)
    {
        return new MovieResource($movie);
    }
}
