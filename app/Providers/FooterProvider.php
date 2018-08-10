<?php

namespace App\Providers;

use App\Models\Item;
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
        $this->categoriesWomen();
        $this->categoriesMen();
        $this->lastItems();
    }

    public function categoriesMen()
    {
        if (Schema::hasTable('items')) {
            view()->composer('*', function ($view) {
                $view->with('categories_men',
                    Item::distinct()
                        ->whereCategory('men')
                        ->inStock()
                        ->get(['type_id', 'category'])
                );
            });
        }
    }

    public function categoriesWomen()
    {
        if (Schema::hasTable('items')) {
            view()->composer('*', function ($view) {
                $view->with('categories_women',
                    Item::distinct()
                        ->whereCategory('women')
                        ->inStock()
                        ->get(['type_id', 'category'])
                );
            });
        }
    }

    public function lastItems()
    {
        if (Schema::hasTable('items')) {
            view()->composer('includes.footer', function ($view) {
                $view->with('last_items_for_footer',
                    Item::latest()
                        ->inStock()
                        ->take(7)
                        ->get(['id', 'title', 'category'])
                );
            });
        }
    }
}
