<?php

return [

    'checkout' => [
        'name' => [
            'min' => 3,
            'max' => 30,
        ],
        'phone' => [
            'min' => 10,
            'max' => 20,
        ],
    ],

    'contact' => [
        'icon' => [
            'max' => 20,
        ],
        'phone' => [
            'min' => 10,
            'max' => 20,
        ],
    ],

    'item' => [
        'title' => [
            'min' => 5,
            'max' => 80,
        ],
        'content' => [
            'min' => 10,
            'max' => 3000,
        ],
        'category' => [
            'max' => 10,
        ],
        'stock' => [
            'min' => 1,
            'max' => 99,
        ],
        'price' => [
            'min' => 10,
            'max' => 900000,
        ],
    ],

    'search' => [
        'word' => [
            'max' => 100,
        ],
    ],

    'card' => [
        'type' => [
            'max' => 1000,
        ],
        'category' => [
            'max' => 10,
        ],
    ],

    'slider' => [
        'order' => [
            'max' => 100,
        ],
    ],

    'section' => [
        'title' => [
            'max' => 250,
        ],
        'content' => [
            'max' => 7000,
        ],
    ],

];
