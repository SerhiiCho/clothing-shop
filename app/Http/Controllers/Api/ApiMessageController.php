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

	public function store()
	{
		$checkIfMessageIsAlreadyExists = Message::where([
			'phone'   => request()->phone,
			'ip'	  => request()->ip()
		])->first();

		if ($checkIfMessageIsAlreadyExists) {
			return 'exists';
		} else {
			Message::create([
				'phone'   => request()->phone,
				'ip'	  => request()->ip(),
				'item_id' => request()->item
			]);
			return 'success';
		}
	}

	public function destroy($id)
    {
		Message::findOrFail($id)->delete();

		return Message::all();
    }
}
