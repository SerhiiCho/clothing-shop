<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddSlideToSliderTable extends Seeder
{
    // Run the database seeds
    public function run()
    {
        DB::table('slider')->insert([
			[ 'image' => '1.jpg' ]
		]);
    }
}
