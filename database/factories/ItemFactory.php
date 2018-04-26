<?php

use App\Models\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {

	$category = (rand(1, 2) === 1) ? 'women' : 'men';

	if ($category === 'women') {
		$type = (rand(1, 2) === 1) ? 'платья' : 'юбки';
	} else {
		$type = (rand(1, 2) === 1) ? 'штаны' : 'шорты';
	}

    return [
        'title'     => $faker->text(15),
		'content'   => $faker->text(200),
		'category'	=> $category,
		'type'  	=> $type,
		'price'     => rand(99, 999),
		'status'    => 'none',
		'author'    => $faker->randomDigit,
		'image'     => rand(1, 16)
    ];
});
