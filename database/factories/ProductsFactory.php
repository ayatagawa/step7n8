<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_name' => $faker->word,
        'price' => $faker->numberBetween($min = 100, $max = 250),
        'stock' => $faker->randomNumber(3),
        'comment' => $faker->realText
    ];
});
