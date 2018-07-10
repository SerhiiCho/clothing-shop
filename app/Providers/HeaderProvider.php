<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HeaderProvider extends ServiceProvider
{
	/**
	 * @var array
	 */
	protected $headers = [
		"Content-Security-Policy-Report-Only: script-src 'self'",
	];

    /**
     * Bootstrap services.
     * @return void
     */
    public function boot()
    {
		foreach ($this->headers as $header) {
			header($header);
		}
	}
}
