<?php

use App\Models\Section;

$factory->define(Section::class, function () {
    return [
        'title' => str_random(7),
        'content' => str_random(7),
        'name' => str_random(3),
    ];
});
