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
            ['option' => 'registration', 'value' => 'on'],
            ['option' => 'app_name', 'value' => 'Одежда'],
        ]);
    }
}
