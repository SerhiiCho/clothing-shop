<?php

use App\Models\Card;
use App\Models\Type;

$factory->define(Card::class, function () {
    return [
        'type_id' => rand(1, Type::count()),
        'category' => rand(1, 2) == 1 ? 'category2' : 'category1',
        'image' => 'default.jpg',
    ];
});
