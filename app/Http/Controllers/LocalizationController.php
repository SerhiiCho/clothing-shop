<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LocalizationController extends Controller
{
    public function local() {
		$strings = Cache::rememberForever('lang.js', function () {
			$lang = config('app.locale');
	
			$files   = glob(resource_path('lang/' . $lang . '/*.php'));
			$strings = [];
	
			foreach ($files as $file) {
				$name           = basename($file, '.php');
				$strings[$name] = require $file;
			}
	
			return $strings;
		});
	
		header('Content-Type: text/javascript');
		echo('window.trans = ' . json_encode($strings) . ';');
		exit();
	}
}
