@extends('layouts.app')

@section('content')

<div class="container pb-5">
	<h4 class="display-4 text-center p-3">@lang('cards.change_card')</h4>
	<div>
		<img src="{{ asset('/storage/img/cards/' . $card->image) }}" alt="{{ $card->type->type }}" class="rounded mx-auto d-block" id="target-image" style="width: 300px; height:410px;">
	</div>
	<div class="col-md-8 offset-md-2">

		<form action="{{ action('CardController@update', ['card' => $card->id]) }}" method="post" enctype="multipart/form-data">
			@csrf
			@method('put')
			<div class="custom-file mt-3">
				<input type="file" name="image" class="custom-file-input" id="src-image">
				<label class="custom-file-label" for="src-image">
					@lang('forms.choose_file')...
				</label>
			</div>

			<select name="type" class="form-control mt-2" id="type">
				<option value="{{ $card->type_id }}">{{ $card->type->type }}</option>
				<option value="none">-------------------------</option>
				@foreach ($types as $type)
					<option value="{{ $type->id }}">{{ $type->type }}</option>
				@endforeach
			</select>

			<button type="submit" class="btn btn-pink mt-3">@lang('cards.change_card')</button>
		</form>

	</div>
</div>

@endsection