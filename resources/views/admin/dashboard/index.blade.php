@extends('layouts.app')

@section('title', auth()->user()->name)

@section('content')
<div class="container pt-3 pb-5 text-center">
    <div class="row">
        <div class="col-md-6">
            <h5 class="mb-4">@lang('dashboard.dashboard')</h5>
            <table class="table">
                <tr>
                    <td>@lang('options.allow_registration')</td>
                    <td>
                        <form action="{{ action('Admin\OptionController@registration') }}" method="post">
                            @csrf
                            @method('put')
                            <input type="checkbox" name="option">
                            <button type="submit" class="btn btn-sm btn-success ml-3">
                                <i class="fas fa-save"></i>
                            </button>
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
