@extends('layouts.app')

@section('title', trans('slider.add_slide'))

@section('content')

<div class="container pb-5">
	<h4 class="display-4 text-center p-3">@lang('slider.add_slide')</h4>
	<div>
		<img src="{{ asset('/storage/img/slider/default.jpg') }}" alt="default" class="rounded mx-auto d-block" id="target-image" style="width:768px; height:384px;">
	</div>
	<div class="col-md-8 offset-md-2">

		<form action="{{ action('CardController@store') }}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="custom-file mt-3">
				<input type="file" name="image" class="custom-file-input" id="src-image" required>
				<label class="custom-file-label" for="src-image">
					@lang('forms.choose_file')...
				</label>
			</div>

			<button type="submit" class="btn btn-pink mt-3">@lang('slider.add_slide')</button>
		</form>

	</div>
</div>

@endsection