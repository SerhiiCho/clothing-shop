<?php

namespace App\Providers;

use App\Models\Item;
use Illuminate\Database\QueryException;
use Illuminate\Support\ServiceProvider;

class FooterProvider extends ServiceProvider
{
    /**
     * Take 7 last items from database and displat them
     * in the footer
     *
     * @return void
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
        $categories_men = cache()->rememberForever('categories_men', function () {
            try {
                return Item::distinct()
                    ->with('type')
                    ->whereCategory('men')
                    ->inStock()
                    ->get(['type_id', 'category'])
                    ->toArray();
            } catch (QueryException $e) {
                no_connection_error($e, __CLASS__);
                return [];
            }
        });
        view()->share(compact('categories_men'));
    }

    /**
     * @return void
     */
    public function categoriesWomen(): void
    {
        $categories_women = cache()->rememberForever('categories_women', function () {
            try {
                return Item::distinct()
                    ->with('type')
                    ->whereCategory('women')
                    ->inStock()
                    ->get(['type_id', 'category'])
                    ->toArray();
            } catch (QueryException $e) {
                no_connection_error($e, __CLASS__);
                return [];
            }
        });
        view()->share(compact('categories_women'));
    }

    /**
     * @return void
     */
    public function lastItems(): void
    {
        try {
            $items = cache()->rememberForever('footer_latest', function () {
                return Item::latest()
                    ->instock()
                    ->take(7)
                    ->get(['id', 'title', 'category', 'slug'])
                    ->toArray();
            });
        } catch (QueryException $e) {
            no_connection_error($e, __CLASS__);
            $items = [];
        }

        view()->composer('includes.footer', function ($view) use ($items) {
            $view->with('footer_latest', $items);
        });
    }
}
