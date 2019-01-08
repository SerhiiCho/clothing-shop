@extends('layouts.app')

@section('title', trans('users.users'))

@section('content')

<div class="container">
    <h4 class="text-center py-3">
        @lang('users.users'): 
        <strong>{{ $users->count() }}</strong>
    </h4>

    {{-- Users --}}
    <div class="table-responsive-sm pb-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">@lang('users.user_id')</th>
                    <th scope="col">@lang('forms.input_name')</th>
                    <th scope="col">@lang('forms.input_email_address')</th>
                    <th scope="col">@lang('users.add')</th>
                    <th scope="col">@lang('cart.delete')</th>
                    <th scope="col">@lang('users.register_since')</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr style="border-left:4px solid {{ $user->isAdmin() ? '#19b719' : '#cc5e5e' }}">
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{-- Add user to admin button --}}
                            <form action="{{ action('Master\UserController@update', ['id' => $user->id]) }}" method="post">
                                @csrf @method('put')
                                <button type="submit"
                                    class="confirm btn btn-sm btn-primary"
                                    style="color:#0e7d0e"
                                    title="@lang('users.add')"
                                    data-confirm="@lang('users.add_to_admin_this_user')"
                                    {{ $user->isAdmin() ? 'disabled' : '' }}
                                >
                                    @lang('users.add')
                                </button>
                            </form>
                        </td>
                        <td>
                            {{-- Delete user button --}}
                            <form action="{{ action('Master\UserController@destroy', ['id' => $user->id]) }}" method="post">
                                @csrf @method('delete')
                                <button type="submit"
                                    class="confirm btn btn-sm btn-primary"
                                    style="color:#af2424"
                                    data-confirm="@lang('users.delete_this_user')"
                                    title="@lang('cart.delete')"
                                    {{ $user->id == 1 ? 'disabled' : '' }}
                                >
                                    @lang('cart.delete')
                                </button>
                            </form>
                        </td>
                        <td>{{ facebookTimeAgo($user->created_at) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <section class="text-center pb-4">
        <div class="mx-auto d-inline-block">{{ $users->links() }}</div>
    </section>
</div>

@endsection
