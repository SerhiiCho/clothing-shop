<?php

use App\Models\ItemsPhoto;
use Faker\Generator as Faker;

$factory->define(ItemsPhoto::class, function (Faker $faker) {
    return ['name' => 'default.jpg'];
});
