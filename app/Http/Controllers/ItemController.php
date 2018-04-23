<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
	
    public function index()
    {
        return view('items.index');
	}


    public function men()
    {
        return view('items.men');
	}


    public function women()
    {
        return view('items.women');
    }


    public function create()
    {
        // 
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Item $item)
    {
        return view('items.show');
    }


    public function edit(Item $item)
    {
        //
    }


    public function update(Request $request, Item $item)
    {
        //
    }


    public function destroy(Item $item)
    {
        //
    }
}
