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
    public function softDelete(Message $message): RedirectResponse
    {
        $message->delete();

        return redirect('/admin/work')->withSuccess(
            trans('messages.order_closed')
        );
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $message = Message::onlyTrashed()->whereId($id)->first();

        $item_ids = array_map(function ($item) {
            return $item['id'];
        }, $message->items->toArray());

        $message->items()->detach($item_ids);
        $message->forceDelete();

        return redirect('/admin/work/closed')->withSuccess(
            trans('messages.order_deleted')
        );
    }
}
