@extends('layouts.app')

@section('title', auth()->user()->name)

@section('content')
<div class="container pt-3 pb-5 text-center">
    <div class="row">
        <div class="col-md-6">
            <h5 class="mb-4">@lang('dashboard.dashboard')</h5>
            <table class="table">
                <tr> {{-- Registration option --}}
                    <td>@lang('options.allow_registration')</td>
                    <td>
                        <form action="{{ action('Admin\OptionController@registration') }}" method="post">
                            @csrf @method('put')
                            <input type="checkbox"
                                class="auto-submit-cb"
                                name="option"
                                {{ $admin_options['registration'] ? 'checked' : '' }}
                            >
                        </form>
                    </td>
                </tr>
                <tr> {{-- Men category option --}}
                    <td>@lang('options.turn_on_men_category')</td>
                    <td>
                        <form action="{{ action('Admin\OptionController@menCategory') }}" method="post">
                            @csrf @method('put')
                            <input type="checkbox"
                                name="option" 
                                class="auto-submit-cb"
                                {{ $admin_options['men_category'] ? 'checked' : '' }}
                            >
                        </form>
                    </td>
                </tr>
                <tr> {{-- Women category option --}}
                    <td>@lang('options.turn_on_women_category')</td>
                    <td>
                        <form action="{{ action('Admin\OptionController@womenCategory') }}" method="post">
                            @csrf @method('put')
                            <input type="checkbox"
                                name="option" 
                                class="auto-submit-cb"
                                {{ $admin_options['women_category'] ? 'checked' : '' }}
                            >
                        </form>
                    </td>
                </tr>
            </table>

        </div>
        <div class="col-md-6">
            <h5 class="mb-4">@lang('dashboard.stats')</h5>
            <table class="table table-hover">
                <tr>
                    <td>@lang('messages.all_items'):</td>
                    <td>{{ $all_items }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
