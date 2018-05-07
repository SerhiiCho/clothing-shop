<?php

namespace App\Http\Controllers\Api;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiOtherController extends Controller
{
    public function slider()
	{
		return Slider::all();
	}
}
