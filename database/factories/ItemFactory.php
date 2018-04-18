<?php

use App\Models\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'title'     => $faker->text(15),
		'content'   => $faker->text(200),
		'category'  => $faker->text(5),
		'price'     => rand(99, 999),
		'status'    => 'none',
		'author'    => $faker->randomDigit
    ];
});
