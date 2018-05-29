<?php

use App\Models\Item;
use App\Models\Type;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
		'title' => $faker->name,
		'content' => $faker->paragraph(7),
		'category' => rand(1, 2) == 1 ? 'women' : 'men',
		'stock' => rand(1, 4),
		'price' => rand(200, 1500),
		'user_id' => 1,
		'type_id' => rand(1, Type::count())
    ];
});
