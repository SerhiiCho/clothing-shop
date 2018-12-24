<?php

return [

    // View
    'cart' => 'Корзина',
    'add_or_delete' => 'Сохранить | Удалить',
    'product' => 'Продукт',
    'price' => 'Цена',
    'total' => 'Всего',
    'delete' => 'Удалить',
    'order' => 'Заказать',
    'empty' => 'Ваша корзина пуста',
    'favorite' => 'Избранное',
    'add_to_cart' => 'Добавить в корзину',
    'favorite' => 'Избранное',
    'add_to_favorite' => 'Добавить в избранное',

    // Controller
    'added_to_cart' => ':item добавлено а корзину. <a href="' . url()->to('/cart') . '">Перейти к корзине</a>',
    'was_deleted' => 'Удалено с корзины',
    'was_deleted_from_favs' => 'Удалено с избранного',
    'item_is_in_your_cart' => 'Этот товар уже в вашей корзине. <a href="' . url()->to('/cart') . '">Перейти к корзине</a>',
    'added_to_favorite' => ':item добавлен в избранное',
    'item_is_in_favorite' => 'Этот товар уже добавлен в избранное',
    'moved_to_cart' => ':item перенесен в корзину',

];
