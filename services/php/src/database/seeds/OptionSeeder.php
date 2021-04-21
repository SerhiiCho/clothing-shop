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
            ['option' => 'men_category', 'value' => 1],
            ['option' => 'women_category', 'value' => 1],
        ]);
    }
}
