<?php

namespace App\Providers;

use App\Models\Option;
use Illuminate\Database\QueryException;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services
     *
     * @return void
     */
    public function boot(): void
    {
        \Schema::defaultStringLength(191);

        $this->enableSqlQueryLogging(false);
        $this->enableHttps(false);
        $this->fetchAdminOptionsFromDb();
    }

    /**
     * @return void
     */
    private function fetchAdminOptionsFromDb(): void
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
                no_connection_error($e, __CLASS__);
            }
        });
        view()->share(compact('admin_options'));
    }

    /**
     * @codeCoverageIgnore
     * @param bool $enable
     * @return void
     */
    private function enableHttps(bool $enable): void
    {
        if (app()->env === 'production' && $enable) {
            \URL::forceScheme('https');
        }
    }

    /**
     * Method for debuging sql queries
     *
     * @codeCoverageIgnore
     * @param bool $enable
     * @return void
     */
    private function enableSqlQueryLogging(bool $enable): void
    {
        if (app()->env == 'local' && $enable) {
            \DB::listen(function ($query) {
                dump($query->sql, $query->time, $query->bindings);
                dump('__________________________________________');
            });
        }
    }
}
