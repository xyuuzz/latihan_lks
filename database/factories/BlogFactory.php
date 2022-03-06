<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blog;
use Faker\Generator as Faker;
use \Illuminate\Support\Str;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        "title" => $faker->sentence(),
        "slug" => Str::slug($faker->sentence()),
        "body" => $faker->paragraph(20)
    ];
});
