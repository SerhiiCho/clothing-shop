<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\Message;

class ApiMessageController extends Controller
{
    public function index()
    {
        return MessageResource::collection(Message::get());
    }

    public function destroy($id)
    {
        $message = Message::with('items')->find($id);

        $item_ids = array_map(function ($item) {
            return $item['id'];
        }, $message->items->toArray());

        $message->items()->detach($item_ids);
        $message->delete();

        return MessageResource::collection(Message::get());
    }
}
