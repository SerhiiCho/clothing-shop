<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
			[ 'type' => 'Аксесуары' ],
			[ 'type' => 'Джинсы' ],
			[ 'type' => 'Рубашки' ],
			[ 'type' => 'Куртки' ],
			[ 'type' => 'Платья' ],
			[ 'type' => 'Майки' ],
			[ 'type' => 'Юбки' ],
			[ 'type' => 'Шорты' ],
			[ 'type' => 'Штаны' ],
		]);
    }
}
