<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\View\View;

class WorkController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * @param string|null $tab
     * @return \Illuminate\View\View
     */
    public function index(?string $tab = null): View
    {
        if ($tab && $tab === 'closed') {
            $messages = Message::onlyTrashed()->latest()->paginate(24);
        } else {
            $messages = Message::latest()->paginate(24);
        }

        return view('admin.work.index', compact('messages', 'tab'));
    }
}
