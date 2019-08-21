<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('master');
    }

    public function index(): View
    {
        return view('master.users.index', [
            'users' => User::paginate(20),
        ]);
    }

    public function update(User $user): RedirectResponse
    {
        if ($user->isAdmin()) {
            return redirect('master/users');
        }

        cache()->forget('non_admin_users');
        $user->update(['admin' => 1]);

        return redirect('master/users')->withSuccess(
            trans('users.user_was_added_to_admins', ['name' => $user->name])
        );
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->isMaster()) {
            return redirect('master/users');
        }

        cache()->forget('non_admin_users');

        return ($user->delete())
            ? redirect('master/users')->withSuccess(trans('users.user_deleted'))
            : redirect('master/users')->withError(trans('users.user_deleted_fail'));
    }
}
