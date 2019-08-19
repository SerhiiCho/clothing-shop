<?php

use App\Models\User;

$factory->define(User::class, function () {
    return [
        'name' => 'User #' . rand(),
        'email' => string_random(10) . '@some.com',
        'password' => bcrypt('111111'),
        'remember_token' => string_random(10),
    ];
});

$factory->state(User::class, 'admin', function () {
    return [
        'admin' => 1,
    ];
});
