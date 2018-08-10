<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{

    public function cache($url_key)
    {
        if ($url_key != env('URL_KEY')) {
            abort(403);
        }

        try {
            Artisan::call('config:cache');
            Artisan::call('view:cache');
            Artisan::call('route:cache');
            echo 'Настройки кеша сохранены! <br> <a href="/" title="На главную">На главную</a>';

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function clear($url_key)
    {
        if ($url_key != config('custom.url_key')) {
            abort(403);
        }

        try {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            echo 'Настройки кеша удалены! <br> <a href="/" title="На главную">На главную</a>';

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function link($url_key)
    {
        if ($url_key != config('custom.url_key')) {
            abort(403);
        }

        try {
            Artisan::call('storage:link');
            echo 'Ссылка создана! <br> <a href="/" title="На главную">На главную</a>';

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function migrate($url_key)
    {
        if ($url_key != config('custom.url_key')) {
            abort(403);
        }

        try {
            Artisan::call('migrate:fresh');
            Artisan::call('db:seed');
            echo 'Миграция завершена успешно! <br> <a href="/" title="На главную">На главную</a>';

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
