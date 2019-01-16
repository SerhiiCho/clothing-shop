<?php

use App\Models\Order;

$factory->define(Order::class, function () {
    return [
        'ip' => rand(1, 255) . '.0.0.1',
        'phone' => '38063' . rand(1, 9) . rand(1, 9) . '91212',
        'name' => str_random(7),
        'user_id' => null,
        'total' => rand(80, 1700),
    ];
});
