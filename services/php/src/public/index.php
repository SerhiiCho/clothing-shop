<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */
define('LARAVEL_START', microtime(true));

// Register The Auto Loader
require __DIR__ . '/../local/vendor/autoload.php';

// Turn On The Lights
$app = require_once __DIR__ . '/../local/bootstrap/app.php';

// Run The Application
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
