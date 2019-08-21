<?php

use App\Models\Type;

$factory->define(Type::class, function () {
    return ['name' => string_random(9)];
});

