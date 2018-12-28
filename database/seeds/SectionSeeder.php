<?php

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::create([
            'title' => 'Lorem, ipsum dolor.',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore, voluptatem?',
            'name' => 'home',
        ]);
    }
}
