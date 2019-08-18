<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('master');
    }

    /**
     * Display all users
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('master.users.index', [
            'users' => User::paginate(20),
        ]);
    }

    /**
     * Make user an admin
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
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

    /**
     * Remove the specified user from database
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
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
