<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Movie;

$factory->define(Movie::class, function (Faker $faker) {
    return [
        'movie_title' =>$faker->text('40'),
        'category_id'=>$faker->randomNumber(1,true),
        'movie_time' =>$faker->randomNumber( 5,  true),
        'movie_language'=>$faker->languageCode,
        'movie_rel_date'=>$faker->date('Y-m-d'),
        'movie_rel_country'=>$faker->country,
        'rate_of_movie'=>$faker->randomFloat(null,1,5)
    ];
});
