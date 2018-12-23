<?php

namespace App\Providers;

use App\Models\Option;
use Illuminate\Database\QueryException;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    // Bootstrap any application services
    public function boot()
    {
        \Schema::defaultStringLength(191);

        $this->fetchAdminOptionsFromDb();

        //\Artisan::call('migrate');

        // if (app()->env === 'production') {
        //     \URL::forceScheme('https');
        // }
    }

    /**
     * @return void
     */
    public function fetchAdminOptionsFromDb(): void
    {
        $admin_options = cache()->rememberForever('admin_options', function () {
            try {
                $options = Option::get();
                return [
                    'registration' => $options->where('option', 'registration')->first()->value,
                    'men_category' => $options->where('option', 'men_category')->first()->value,
                    'women_category' => $options->where('option', 'women_category')->first()->value,
                ];
            } catch (QueryException $e) {
                logs()->error($e->getMessage());
            }
        });
        view()->share(compact('admin_options'));
    }
}
