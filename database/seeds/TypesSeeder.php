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
			[ 'type' => 'Штаны' ],
			[ 'type' => 'Шорты' ],
			[ 'type' => 'Юбки' ],
			[ 'type' => 'Платья' ],
			[ 'type' => 'Майки' ],
			[ 'type' => 'Куртки' ],
			[ 'type' => 'Аксесуары' ]
		]);
    }
}
