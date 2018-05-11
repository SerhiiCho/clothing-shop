<?php

namespace App\Http\Controllers\Api;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;

class ApiMessageController extends Controller
{
	public function index()
	{
		return Message::all();
	}

	public function destroy($id)
    {
		Message::delete($id);

		return Message::all();
    }
}
