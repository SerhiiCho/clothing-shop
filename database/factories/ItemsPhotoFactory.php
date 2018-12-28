<?php

use App\Models\Item;
use App\Models\ItemsPhoto;

$factory->define(ItemsPhoto::class, function () {
    return [
        'name' => 'default.jpg',
        'item_id' => factory(Item::class)->create(),
    ];
});
