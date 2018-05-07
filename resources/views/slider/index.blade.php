@extends('layouts.app')

@section('title', trans('slider.slider'))

@section('content')

<div class="container">

	@if ($slider->count() > 0)
		<h3 class="display-4 text-center pt-3">@lang('slider.slider')</h3>
		<slider></slider>
	@endif
	<div class="text-center pb-5">
		<div class="alert alert-light mb-3" role="alert">
			@lang('slider.amount_of_slides'): {{ $slider->count() }}
		</div>
		<a href="/slider/create" title="@lang('slider.add_slide')" class="btn btn-dark">@lang('slider.add_slide')</a>
	</div>
</div>

@endsection