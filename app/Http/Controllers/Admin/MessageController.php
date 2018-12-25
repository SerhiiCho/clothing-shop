<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;

class MessageController extends Controller
{
    /**
     * @param \App\Models\Message $message
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Message $message): RedirectResponse
    {
        $item_ids = array_map(function ($item) {
            return $item['id'];
        }, $message->items->toArray());

        $message->items()->detach($item_ids);
        $message->delete();

        return redirect('/admin/work')->withSuccess(
            trans('messages.message_deleted')
        );
    }
}
