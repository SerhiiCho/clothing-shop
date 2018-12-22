@extends('layouts.app')

@section('title', auth()->user()->name)

@section('content')
<div class="container pt-3 pb-5 text-center">
    <h4 class="mb-3">@lang('messages.stats')</h4>
    <table class="table table-hover">
        <tbody>
            <tr>
                <td>@lang('messages.all_items'):</td>
                <td>{{ $all_items }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
