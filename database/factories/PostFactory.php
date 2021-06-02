<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => factory('App\User'),
        'title' => $faker->sentence,
        'short_description' => $faker->sentence,
        'long_description' => $faker->paragraph,
        'featured_image' => $faker->imageUrl('900', '300')
    ];
});
