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
			[ 'name' => 'Блузки' ],
			[ 'name' => 'Джинсы' ],
			[ 'name' => 'Рубашки' ],
			[ 'name' => 'Куртки' ],
			[ 'name' => 'Кофты' ],
			[ 'name' => 'Платья' ],
			[ 'name' => 'Майки' ],
			[ 'name' => 'Юбки' ],
			[ 'name' => 'Шорты' ],
			[ 'name' => 'Штаны' ],
		]);
    }
}
