@extends('layouts.error')

@section('title', trans('errors.404_title'))

@section('content')

<div class="container" style="height:100vh; display:flex; align-items:center; justify-content:center; flex-direction:column">
	<h2 class="display-4">@lang('errors.404')</h2>
	<h2 class="display-4">@lang('errors.404_title')</h2>
	<p class="text-center">@lang('errors.404_description')</p>
	<a href="/" class="btn btn-dark" title="@lang('errors.to_home')">@lang('errors.to_home')</a>
</div>

@endsection