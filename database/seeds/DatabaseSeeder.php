<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(IconSeeder::class);
        $this->call(OptionSeeder::class);
        $this->call(TypesSeeder::class);
        $this->call(UserSeeder::class);

        if (app()->env != 'production') {
            $this->call(SliderSeeder::class);
            $this->call(CardSeeder::class);
        }
    }
}
