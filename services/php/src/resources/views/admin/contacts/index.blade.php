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
            <div class="col-12 col-lg-8 offset-lg-2">
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
                            <div class="align-items-right">
                                @admin
                                    <a href="/admin/contacts/{{ $contact['id'] }}/edit" 
                                        class="btn btn-primary mr-3" 
                                        title="@lang('contacts.change_contact')"
                                    >
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>

                                    <form action="{{ action('Admin\ContactController@destroy', ['contact' => $contact['id']]) }}" 
                                        method="post" 
                                        class="d-inline" 
                                    >
                                        @csrf @method('delete')

                                        <button class="btn btn-primary confirm"
                                            title="@lang('contacts.delete')"
                                            data-confirm="@lang('contacts.confirm_delete')"
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endadmin
                            </div>
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