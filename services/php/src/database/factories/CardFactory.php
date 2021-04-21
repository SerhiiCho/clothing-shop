<?php

use App\Models\Card;
use App\Models\Type;

$factory->define(Card::class, function () {
    return [
        'type_id' => rand(1, Type::count()),
        'category' => rand(1, 2) == 1 ? 'women' : 'men',
        'image' => 'default.jpg',
    ];
});
