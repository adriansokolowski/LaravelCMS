<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Resources\MovieResource;
use App\Movie;
use App\Country;
use App\Person;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $query = Movie::query();
        
        if (request('category'))
        {
            $query->whereHas('categories', function($q) {
                $q->where('categories.name', request('category'));
            });
        }
        //dd($request->all());
        if (request('year'))
        {
            $query->where('release_date', '1986-03-08 11:23:16');
        }
        
        return MovieResource::collection(
            $query->orderBy($sortBy, 'desc')->get()
        );
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
}
