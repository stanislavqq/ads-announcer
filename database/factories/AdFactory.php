<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Ad;
use Faker\Generator as Faker;

$factory->define(Ad::class, function (Faker $faker) {
    return [
        'title' => $faker->text('50'),
        'description' => $faker->text,
        'city_id' => function () {
            return \App\Models\City::inRandomOrder()->first()->id;
        },
        'category_id' => function () {
            return \App\Models\Category::inRandomOrder()->first()->id;
        },
        'author_id' => function() {
            return \App\Models\User::inRandomOrder()->first()->id;
        }
    ];
});
