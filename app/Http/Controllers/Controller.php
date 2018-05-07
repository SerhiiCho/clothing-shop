<?php

namespace App\Http\Controllers;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function log($message, $file_name = 'errors.log')
	{
		$view_log = new Logger('errors');
		$view_log->pushHandler(new StreamHandler(
			storage_path('/logs/' . $file_name), Logger::INFO
		));
		$view_log->addInfo($message);
	}
}
