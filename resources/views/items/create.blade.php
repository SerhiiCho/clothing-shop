@extends('layouts.app')

@section('content')

<div class="container">
	<h4 class="heading center">@lang('items.add_item')</h4>

	<form action="{{ action('ItemController@store') }}" method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3 pb-5">

		@csrf

		<div class="form-group">
			<label>@lang('items.name')</label>
			<input type="text" name="title" placeholder="@lang('items.name')" class="form-control" required>
		</div>

		<div class="form-group">
			<label>@lang('items.discreption')</label>
			<textarea name="content" placeholder="@lang('items.discreption')" class="form-control" required></textarea>
		</div>

		<div class="row">
			<div class="form-group col-md-6">
				<label>@lang('items.category')</label>
				<select name="category" class="form-control">
					<option value="women">@lang('items.women_items')</option>
					<option value="men">@lang('items.men_items')</option>
				</select>
			</div>

			<div class="form-group col-md-6">
				<label>@lang('items.type')</label>
				<select name="type" class="form-control">
					@foreach ($types as $type)
						<option value="{{ $type->id }}">{{ $type->type }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-6">
				<label>@lang('items.price_hryvnia')</label>
				<input type="number" name="price1" value="0" placeholder="@lang('items.select_hryvnia')" class="form-control" required>
			</div>

			<div class="form-group col-md-6">
				<label>@lang('items.price_change')</label>
				<input type="number" name="price2" value="0" class="form-control" placeholder="@lang('items.select_change')" max="99" required>
			</div>
		</div>

		<div class="form-group">
			<input type="file" name="image" class="form-control-file" required>
		</div>
		
		<button type="submit" class="btn btn-dark">@lang('items.add_item')</button>
	</form>
</div>

@endsection