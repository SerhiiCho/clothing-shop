<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IconSeeder extends Seeder
{
    public function run()
    {
        DB::table('icons')->insert([
            ['name' => 'Life', 'image' => 'life.png'],
            ['name' => 'Kyevstar', 'image' => 'kyevstar.png'],
            ['name' => 'MTC', 'image' => 'mts.png'],
            ['name' => 'Viber', 'image' => 'viber.png'],
            ['name' => 'Telegram', 'image' => 'telegram.png'],
            ['name' => 'Vodafone', 'image' => 'vodafone.png'],
        ]);
    }
}
