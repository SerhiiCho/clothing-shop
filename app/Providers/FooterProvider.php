<?php

namespace App\Providers;

use App\Models\Item;
use Illuminate\Database\QueryException;
use Illuminate\Support\ServiceProvider;

class FooterProvider extends ServiceProvider
{
    /**
     * Take 7 last items from database and display them in the footer
     *
     * @return void
     * @throws \Exception
     */
    public function boot(): void
    {
        $this->categoriesSecond();
        $this->categoriesFirst();
        $this->lastItems();
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function categoriesFirst(): void
    {
        $categories1 = cache()->rememberForever('categories1', function () {
            try {
                return Item::distinct()
                    ->with('type')
                    ->whereCategory('category1')
                    ->inStock()
                    ->get(['type_id', 'category'])
                    ->toArray();
            } catch (QueryException $e) {
                no_connection_error($e, __CLASS__);
                return [];
            }
        });
        view()->share(compact('categories1'));
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function categoriesSecond(): void
    {
        $categories2 = cache()->rememberForever('categories2', function () {
            try {
                return Item::distinct()
                    ->with('type')
                    ->whereCategory('category2')
                    ->inStock()
                    ->get(['type_id', 'category'])
                    ->toArray();
            } catch (QueryException $e) {
                no_connection_error($e, __CLASS__);
                return [];
            }
        });
        view()->share(compact('categories2'));
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function lastItems(): void
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
