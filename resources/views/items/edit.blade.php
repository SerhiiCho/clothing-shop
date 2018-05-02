@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-xs-12 heading center">@lang('items.change_item')</div>

	<form action="{{ action('ItemController@update', ['id' => $item->id]) }}" method="post" enctype="multipart/form-data" class="col-md-6 offset-md-3 pb-5">

		@csrf
		@method('PUT')

		<div class="form-group">
			<label>@lang('items.name')</label>
			<input type="text" value="{{ $item->title }}" name="title" placeholder="@lang('items.name')" class="form-control" required>
		</div>

		<div class="form-group">
			<label>@lang('items.discreption')</label>
			<textarea name="content" placeholder="@lang('items.discreption')" class="form-control" required>{{ $item->content }}</textarea>
		</div>

		<div class="row">
			<div class="form-group col-md-6">
				<label>@lang('items.category')</label>
				<select name="category" class="form-control">
					<option value="{{ $item->category }}">{{ $category }}</option>
					<option>------------------------</option>
					<option value="women">@lang('items.women_items')</option>
					<option value="men">@lang('items.men_items')</option>
				</select>
			</div>

			<div class="form-group col-md-6">
				<label>@lang('items.type')</label>
				<select name="type" value="{{ $item->id }}" class="form-control">
					<option value="{{ $item->type->id }}">{{ $item->type->type }}</option>
					<option>------------------------</option>
					@foreach ($types as $type)
						<option value="{{ $type->id }}">{{ $type->type }}</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-6">
				<label>@lang('items.price_hryvnia')</label>
				<input type="number" value="{{ $item->price1 }}" name="price1" value="0" placeholder="@lang('items.select_hryvnia')" class="form-control" required>
			</div>

			<div class="form-group col-md-6">
				<label>@lang('items.price_change')</label>
				<input type="number" value="{{ $item->price2 }}" name="price2" value="0" class="form-control" placeholder="@lang('items.select_change')" max="99" required>
			</div>
		</div>

		<div class="form-group">
			<img src="{{ asset('/storage/img/clothes/' . $item->image) }}" alt="{{ $item->title }}" style="text-align:center; margin:1em auto; display:block;">
			<input type="file" name="image" class="form-control-file" required>
		</div>
		
		<button type="submit" class="btn btn-dark">@lang('items.change_item')</button>
	</form>
</div>

@endsection