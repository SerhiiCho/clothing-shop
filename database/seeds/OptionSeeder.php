<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            ['option' => 'registration', 'value' => 1],
            ['option' => 'category1', 'value' => 1],
            ['option' => 'category2', 'value' => 1],
            ['option' => 'category1_title', 'value' => 'Мужская одежда'],
            ['option' => 'category2_title', 'value' => 'Женская одежда'],
        ]);
    }
}
