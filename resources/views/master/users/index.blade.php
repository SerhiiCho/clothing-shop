@extends('layouts.app')

@section('title', trans('users.users'))

@section('content')

<div class="container">
    <h4 class="text-center py-3">
        @lang('users.users'): 
        <strong>{{ $users->count() }}</strong>
    </h4>

    {{-- Cards --}}
    <div class="row pb-5">
        @foreach ($users as $user)
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card"
                    style="
                        border-top: 4px solid {{ $user->isAdmin() ? 'green' : '#e56114' }};
                        background: {{ $user->isAdmin() ? '#f4fff4' : '#fff4f4' }};
                    "
                >
                    <div class="card-body py-2">

                        <div class="row">
                            {{-- Add user to admin button --}}
                            <div class="col-12 col-md-6 mb-1">
                                <form action="{{ action('Master\UserController@update', ['id' => $user->id]) }}" method="post">
                                    @csrf @method('put')
                                    <button type="submit"
                                        class="confirm btn btn-sm btn-primary btn-block"
                                        style="border:2px inset #73b773"
                                        data-confirm="@lang('users.add_to_admin_this_user')"
                                        {{ $user->isAdmin() ? 'disabled' : '' }}
                                    >
                                        <i class="fas fa-plus"></i> @lang('users.add')
                                    </button>
                                </form>
                            </div>

                            {{-- Delete user button --}}
                            <div class="col-12 col-md-6 mb-1">
                                <form action="{{ action('Master\UserController@destroy', ['id' => $user->id]) }}" method="post">
                                    @csrf @method('delete')
                                    <button type="submit"
                                        class="confirm btn btn-sm btn-primary btn-block"
                                        style="border:2px inset #cc5e5e"
                                        data-confirm="@lang('users.delete_this_user')"
                                        {{ $user->id == 1 ? 'disabled' : '' }}
                                    >
                                        <i class="fas fa-trash-alt"></i> @lang('cart.delete')
                                    </button>
                                </form>
                            </div>

                        </div>


                        <h6 class="card-title pt-3">
                            @lang('users.user_id') <strong># {{ $user->id }}</strong>
                        </h6>
                        <hr />
                        <p class="card-text mb-1">
                            @lang('forms.input_name'): 
                            <strong>{{ $user->name }}</strong>
                        </p>
                        <p class="card-text mb-1">
                            @lang('forms.input_email_address'): 
                            <strong>{{ $user->email }}</strong>
                        </p>
                        <p class="card-text mb-1">
                            @lang('users.register_since'):
                            <strong>{{ facebookTimeAgo($user->created_at) }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <section class="text-center pb-4">
        <div class="mx-auto d-inline-block">{{ $users->links() }}</div>
    </section>
</div>

@endsection
