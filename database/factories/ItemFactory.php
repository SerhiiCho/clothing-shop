<?php

use App\Models\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'title'     => $faker->text(15),
		'content'   => $faker->text(200),
		'sex'       => 'women',
		'category'  => 'dress',
		'price'     => rand(99, 999),
		'status'    => 'none',
		'author'    => $faker->randomDigit,
		'image'     => rand(1, 30) . '.jpg'
    ];
});
