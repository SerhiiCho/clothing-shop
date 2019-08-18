<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesSeeder extends Seeder
{
    public function run()
    {
        DB::table('types')->insert([
            ['name' => 'Аксессуары'],
            ['name' => 'Боди'],
            ['name' => 'Брюки'],
            ['name' => 'Бомпер'],
            ['name' => 'Блузы'],
            ['name' => 'Верхняя одежда'],
            ['name' => 'Водолазки'],
            ['name' => 'Головные уборы'],
            ['name' => 'Джинсы'],
            ['name' => 'Джемпер'],
            ['name' => 'Кардиганы'],
            ['name' => 'Комбинезоны'],
            ['name' => 'Костюмы'],
            ['name' => 'Куртки'],
            ['name' => 'Купальники'],
            ['name' => 'Кофты'],
            ['name' => 'Толстовки'],
            ['name' => 'Спортивная одежда'],
            ['name' => 'Свитера'],
            ['name' => 'Сарафаны'],
            ['name' => 'Свитшоты'],
            ['name' => 'Туники'],
            ['name' => 'Майки'],
            ['name' => 'Футболки'],
            ['name' => 'Платья'],
            ['name' => 'Парки'],
            ['name' => 'Поло'],
            ['name' => 'Лосины'],
            ['name' => 'Рубашки'],
            ['name' => 'Юбки'],
            ['name' => 'Шорты'],
            ['name' => 'Штаны'],
            ['name' => 'Жакеты'],
            ['name' => 'Жилеты'],
            ['name' => 'Худи'],
        ]);
    }
}
