<?php

use App\Models\Item;
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
        Item::create([
			'title'   => 'Шмотка',
			'content' => 'Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации "Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст.." ',
			'category' => 'Женская одежда',
			'status'  => 'inherit',
			'author'  => 1
		]);
    }
}
