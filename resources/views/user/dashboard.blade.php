@extends('layouts.app')

@section('title', auth()->user()->name)

@section('content')
<div class="container pt-3 pb-5 text-center">
    <h3>{{ user()->name }}</h3>
    <h5>@lang('messages.all_items', ['items' => $all_items])</h5>
</div>
@endsection
