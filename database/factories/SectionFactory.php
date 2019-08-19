<?php

use App\Models\Section;

$factory->define(Section::class, function () {
    return [
        'title' => string_random(7),
        'content' => string_random(7),
        'name' => string_random(3),
    ];
});
