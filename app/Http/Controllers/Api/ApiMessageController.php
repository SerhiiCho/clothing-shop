<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiMessageController extends Controller
{
	public function index()
	{
		return Message::all();
	}

	public function send()
	{

		$checkIfMessageIsAlreadyExists = Message::wherePhone(
			request()->phone
		)->first();

		if ($checkIfMessageIsAlreadyExists) {
			return 'exists';
		} else {
			Message::create([
				'phone' => request()->phone,
				'item_id' => request()->item
			]);
			return 'success';
		}
	}
}
