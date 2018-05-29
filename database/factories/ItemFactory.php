<?php

use App\Models\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
		'title' => $faker->name,
		'content' => $faker->paragraph(5),
		'category' => rand(1, 2) == 1 ? 'women' : 'men',
		'stock' => rand(1, 4),
		'price' => rand(100, 1000),
		'user_id' => 1,
		'type_id' => 2
    ];
});
