<?php

namespace App\Providers;

use App\Models\Item;
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

    /**
     * @return void
     */
    public function categoriesMen(): void
    {
        // cache()->put('hello', 'world', 1);
        $categories_men = cache()->rememberForever('categories_men', function () {
            return Item::distinct()
                ->with('type')
                ->whereCategory('men')
                ->inStock()
                ->get(['type_id', 'category'])
                ->toArray();
        });

        view()->share(compact('categories_men'));
    }

    /**
     * @return void
     */
    public function categoriesWomen(): void
    {
        $categories_women = cache()->rememberForever('categories_women', function () {
            return Item::distinct()
                ->with('type')
                ->whereCategory('women')
                ->inStock()
                ->get(['type_id', 'category'])
                ->toArray();
        });

        view()->share(compact('categories_women'));
    }

    /**
     * @return void
     */
    public function lastItems(): void
    {
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
