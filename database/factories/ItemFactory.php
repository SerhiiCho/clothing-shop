<?php

use App\Models\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {

	$sex = (rand(1, 2) === 1) ? 'women' : 'men';

	if ($sex === 'women') {
		$category = (rand(1, 2) === 1) ? 'dress' : 'skirt';
	} else {
		$category = (rand(1, 2) === 1) ? 'pants' : 'shorts';
	}

    return [
        'title'     => $faker->text(15),
		'content'   => $faker->text(200),
		'sex'       => $sex,
		'category'  => $category,
		'price'     => rand(99, 999),
		'status'    => 'none',
		'author'    => $faker->randomDigit,
		'image'     => rand(1, 16)
    ];
});
