<?php

use Faker\Generator as Faker;
use App\Category;

$factory->define(App\Products::class, function (Faker $faker) {
    return [
        'sku' => rand(100,5000),
        'size' => rand(0,10),
        'name' => $faker->name,
        'description' => str_random( 150 ),
        'price' => rand(100,5000),
        'categories_id' => \App\Category::all('id')->random(),
     ];
});
