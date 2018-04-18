<?php

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds to fill Items table.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Item::class, 16)->create();
    }
}
