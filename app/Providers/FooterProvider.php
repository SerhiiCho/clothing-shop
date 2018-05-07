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

			$distinct_items
				= Item::distinct()
				->take(10)
				->get(['type_id']);

			view()->composer('includes.footer', function ($view) use ($last_items_for_footer, $distinct_items) {
				$view->with(compact('last_items_for_footer', 'distinct_items'));
			});
		}
    }
}
