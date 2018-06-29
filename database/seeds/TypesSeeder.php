<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesSeeder extends Seeder
{
    // Run the database seeds
    public function run()
    {
        DB::table('types')->insert([
			[ 'name' => 'Аксесуары' ],
			[ 'name' => 'Боди' ],
			[ 'name' => 'Брюки' ],
			[ 'name' => 'Верхняя одежда' ],
			[ 'name' => 'Водолазки, лонгслив' ],
			[ 'name' => 'Джинсы' ],
			[ 'name' => 'Блузы, рубашки' ],
			[ 'name' => 'Кардиганы' ],
			[ 'name' => 'Камбинизоны' ],
			[ 'name' => 'Костюмы' ],
			[ 'name' => 'Куртки' ],
			[ 'name' => 'Купальники' ],
			[ 'name' => 'Кофты, свитера' ],
			[ 'name' => 'Свитшорты, толстовки' ],
			[ 'name' => 'Спортивная одежда' ],
			[ 'name' => 'Сарафаны' ],
			[ 'name' => 'Туники' ],
			[ 'name' => 'Платья' ],
			[ 'name' => 'Футболки, майки' ],
			[ 'name' => 'Юбки' ],
			[ 'name' => 'Шорты' ],
			[ 'name' => 'Штаны' ],
			[ 'name' => 'Жакеты, жилеты' ],
		]);
    }
}
