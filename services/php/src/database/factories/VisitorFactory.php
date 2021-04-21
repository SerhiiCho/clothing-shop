<?php

use App\Models\Visitor;

$factory->define(Visitor::class, function () {
    return ['ip' => rand(100, 999) . '.' . rand(0, 255) . '.0.1'];
});
