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
            'content' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Iste nostrum quisquam amet vero qui voluptates voluptas aliquam fugit ipsam! Quibusdam culpa ipsa doloremque repudiandae iusto ducimus veniam nihil laboriosam sunt! Officia voluptates sunt voluptas debitis, aliquid ullam, consectetur nulla rem, tenetur a harum voluptatum impedit iusto. Hic consequuntur obcaecati aut.',
            'name' => 'home',
        ]);
    }
}
