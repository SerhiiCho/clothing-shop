@extends('layouts.app')

@section('title', trans('user-sidebar.contacts'))

@section('content')

<div class="container pb-5">
    @if (count($contacts) > 0)
        <h4 class="display-4 text-center p-3">
            @lang('user-sidebar.contacts'): 
            {{ count($contacts) }}
        </h4>

        <div class="row">
            <ul class="col-12 col-lg-8 offset-lg-2">
                <ul class="list-group mb-4">
                    @foreach ($contacts as $contact)
                        <li class="list-group-item d-flex justify-content-between align-items-center">

                            {{-- Icon --}}
                            @empty(! $contact['icon_id'])
                                <img src="{{ asset("storage/img/gsm/{$contact['icon']['image']}") }}"
                                    alt="{{ $contact['icon']['name'] }}"
                                    width="35" 
                                    height="35" 
                                    class="gsm-operator"
                                >
                            @endempty

                            <strong>{{ $contact['phone'] }}</strong>
                                
                            {{-- Buttons --}}
                            <ul class="m-0" style="max-width: 30px">
                                @admin
                                <li class="mb-1">
                                    <a href="/admin/contacts/{{ $contact['id'] }}/edit"
                                       class="btn btn-primary btn-sm mr-3"
                                       title="@lang('contacts.change_contact')"
                                    >
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ action('Admin\ContactController@destroy', ['contact' => $contact['id']]) }}"
                                          method="post"
                                          class="d-inline"
                                    >
                                        @csrf @method('delete')

                                        <button class="btn btn-primary btn-sm confirm" data-confirm="@lang('contacts.confirm_delete')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </li>
                                @endadmin
                            </ul>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @else
        <p class="text-center pt-5 pb-3">@lang('contacts.no_contacts')</p>
    @endif

    <div class="text-center">
        <a href="/admin/contacts/create"
            title="@lang('contacts.add_contact')"
            class="btn btn-success"
        >
            @lang('contacts.add_contact')
        </a>
    </div>
</div>

@endsection