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
                logs()->error($e->getMessage());
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
                return [];
                logs()->error($e->getMessage());
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
            $items = Item::latest()
                ->instock()
                ->take(7)
                ->get(['id', 'title', 'category']);
        } catch (QueryException $e) {
            $items = collect();
            logs()->error($e->getMessage());
        }

        view()->composer('includes.footer', function ($view) use ($items) {
            $view->with('last_items_for_footer', $items);
        });
    }
}
