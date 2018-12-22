<?php

use App\Models\User;

$factory->define(User::class, function () {
    return [
        'name' => 'User #' . rand(),
        'email' => str_random(10) . '@some.com',
        'password' => bcrypt('111111'),
        'remember_token' => str_random(10),
    ];
});
