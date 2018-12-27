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
            'max' => 20,
        ],
        'stock' => [
            'min' => 1,
            'max' => 99,
        ],
        'price' => [
            'min' => 1,
            'max' => 6,
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
            'max' => 30,
        ],
    ],

    'slider' => [
        'order' => [
            'max' => 100,
        ],
    ],

];
