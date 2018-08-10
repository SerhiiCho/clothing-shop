<?php

use App\Models\Item;
use App\Models\ItemsPhoto;
use Faker\Generator as Faker;

$factory->define(ItemsPhoto::class, function (Faker $faker) {
    return [
        'name' => 'default.jpg',
        'item_id' => factory(Item::class)->create(),
    ];
});
