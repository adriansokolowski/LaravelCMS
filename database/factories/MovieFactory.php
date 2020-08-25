<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movie;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

use function PHPSTORM_META\map;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Movie::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'release_date' => $faker->dateTime,
        'description' => $faker->text,
        'trailer' => $faker->text(10),
        'fdb' => $faker->randomNumber,
        'up' => $faker->randomNumber,
        'down' => $faker->randomNumber,
        'views' => $faker->randomNumber,
        'slider' => $faker->randomNumber,
        'report' => 0,
        'html' => $faker->text,
        'last_view' => now(),
        'imdb_rate' => 7,
        'visible' => 1
    ];
});