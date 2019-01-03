<?php

namespace App\Http\Controllers\Admin;

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
        $this->middleware('admin');
    }

    /**
     * Display all users
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::paginate(20),
        ]);
    }

    /**
     * Make user an admin
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(User $user): RedirectResponse
    {
        if ($user->isAdmin()) {
            return redirect('admin/users');
        }

        $user->update(['admin' => 1]);

        return redirect('admin/users')->withSuccess(
            trans('users.user_was_added_to_admins', ['name' => $user->name])
        );
    }

    /**
     * Remove the specified user from database
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        if ($user->id == 1) {
            return redirect('admin/users');
        }

        return ($user->delete())
        ? redirect('admin/users')->withSuccess(trans('users.user_deleted'))
        : redirect('admin/users')->withError(trans('users.user_deleted_fail'));
    }
}
