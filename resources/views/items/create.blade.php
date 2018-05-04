@extends('layouts.app')

@section('content')

<div class="container pb-4 col-12 col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
	<h5 class="text-center pt-4">@lang('items.add_item')</h5>

	<div class="row">
		<form action="{{ action('ItemController@store') }}" method="post" enctype="multipart/form-data" class="col-md-6 col-lg-8">

			@csrf

			<div class="form-group">
				<label>@lang('items.name')</label>
				<input type="text" name="title" placeholder="@lang('items.name')" class="form-control" required>
			</div>

			<div class="form-group">
				<label>@lang('items.discreption')</label>
				<textarea name="content" placeholder="@lang('items.discreption')" class="form-control" style="min-height: 200px" required></textarea>
			</div>

			<div class="row">
				<div class="form-group col-sm-6">
					<label>@lang('items.category')</label>
					<select name="category" class="form-control">
						<option value="women">@lang('items.women_items')</option>
						<option value="men">@lang('items.men_items')</option>
					</select>
				</div>

				<div class="form-group col-sm-6">
					<label>@lang('items.type')</label>
					<select name="type" class="form-control">
						@foreach ($types as $type)
							<option value="{{ $type->id }}">{{ $type->type }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-6">
					<label>@lang('items.price_hryvnia')</label>
					<input type="number" name="price1" value="0" placeholder="@lang('items.select_hryvnia')" class="form-control" required>
				</div>

				<div class="form-group col-6">
					<label>@lang('items.price_change')</label>
					<input type="number" name="price2" value="0" class="form-control" placeholder="@lang('items.select_change')" max="99" required>
				</div>
			</div>

			<div class="custom-file">
				<input type="file" name="image" class="form-control-file" id="src-image" required>
				<label class="custom-file-label" for="src-image">@lang('forms.choose_file')...</label>
			</div>
			
			<button type="submit" class="btn btn-dark mt-3">@lang('items.add_item')</button>
		</form>

		<div class="col-md-6 col-lg-4 mt-3">
			<img src="{{ asset('/storage/img/clothes/default.jpg') }}" alt="default" class="rounded mx-auto d-block" id="target-image" style="width: 300px; height:380px;">
		</div>
	</div>
</div>

@endsection