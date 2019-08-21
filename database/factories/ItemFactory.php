<?php

use App\Models\Item;
use App\Models\Type;

$factory->define(Item::class, function () {
    return [
        'title' => string_random(10),
        'content' => 'sosfdls jf asjdfsjfajfsdjf ajf d;f jasfj dfa jsdlfj al;sdfj dfjdfjlkdsa jf;ldjflasdjf;jdsf ;afkj dfs dj',
        'category' => rand(1, 2) == 1 ? 'category2' : 'category1',
        'stock' => rand(1, 4),
        'price' => rand(200, 1500),
        'slug' => string_random(10),
        'user_id' => 1,
        'type_id' => rand(1, Type::count()),
    ];
});
