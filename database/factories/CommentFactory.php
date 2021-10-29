<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'comment_detail'=>$faker->text,
        'movie_id'=>$faker->numberBetween(1,25)
    ];
});
