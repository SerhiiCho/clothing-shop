@extends('layouts.app')

@section('title', trans('cards.add_card'))

@section('content')

<div class="container pb-5">
	<h4 class="display-4 text-center p-3">@lang('cards.add_card')</h4>
	<div>
		<img src="{{ asset('/storage/img/clothes/default.jpg') }}" alt="default" class="rounded mx-auto d-block" id="target-image" style="width: 300px; height:410px;">
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

			<select name="type" class="form-control mt-2" id="type">
				<option value="none">@lang('forms.choose_category')</option>
				@foreach ($types as $type)
					<option value="{{ $type->id }}">{{ $type->name }}</option>
				@endforeach
			</select>

			<button type="submit" class="btn btn-dark btn-block mt-3">@lang('cards.add_card')</button>
		</form>
		<a href="/cards" title="@lang('messages.back')" class="btn btn-dark btn-block mt-2">@lang('messages.back')</a>

	</div>
</div>

@endsection