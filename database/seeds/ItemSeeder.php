<?php

use App\Models\ItemsPhoto;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ItemsPhoto::class, 20)->create();
    }
}
