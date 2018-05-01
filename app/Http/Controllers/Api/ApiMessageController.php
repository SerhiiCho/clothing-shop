<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiMessageController extends Controller
{
    public function send() {

		$checkIfMessageIsAlreadyExists = 

		Message::create([
			'phone' => request()->phone,
			'item_id' => request()->item
		]);

		return request()->all();
	}
}
