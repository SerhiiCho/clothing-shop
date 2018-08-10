<?php

use App\Models\Card;
use App\Models\Type;
use Faker\Generator as Faker;

$factory->define(Card::class, function (Faker $faker) {
    return [
        'type_id' => rand(1, Type::count()),
        'category' => rand(1, 2) == 1 ? 'women' : 'men',
        'image' => 'default.jpg',
    ];
});
