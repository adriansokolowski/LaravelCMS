<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Link;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
    return [
        'user_id' => '1',
        'movie_id' => rand(1,10),
        'episode_id' => '1',
        'domain' => $faker->sentence,
        'file' => $faker->sentence,
        'version' => '1',
        'quality' => '1',
        'up' => '1',
        'down' => '1',
        'view' => '1',
        'last_view' => now(),
        'visible' => '1'
    ];
});
