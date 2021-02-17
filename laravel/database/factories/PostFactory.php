<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'=>$faker ->unique()-> word,
        'content'=>$faker -> text(500),    //max 500 caratteri
        'likes'=> rand(0, 1000)
    ];
});
