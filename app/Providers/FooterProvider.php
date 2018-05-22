<?php

namespace App\Providers;

use App\Models\Item;
use Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class FooterProvider extends ServiceProvider
{
    /**
     * Take 7 last items from database and displat them
	 * in the footer
     */
    public function boot()
    {
		if (Schema::hasTable('items')) {
			$last_items_for_footer
				= Item::latest()
				->take(7)
				->get(['id', 'title']);

			$categories_women
				= Item::distinct()
				->whereCategory('women')
				->take(10)
				->get(['type_id']);

			$categories_men
				= Item::distinct()
				->whereCategory('men')
				->take(10)
				->get(['type_id']);

			view()->composer('*', function ($view) use ($last_items_for_footer, $categories_women, $categories_men) {
				$view->with(compact('last_items_for_footer', 'categories_men', 'categories_women'));
			});
		}
    }
}
