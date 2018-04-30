@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-xs-12 heading center">@lang('items.change_item')</div>

	<form action="{{ action('ItemController@update', ['id' => $item->id]) }}" method="post" class="form" enctype="multipart/form-data">

		@csrf
		@method('PUT')

		<input type="text" value="{{ $item->title }}" name="title" placeholder="@lang('items.name')" required>
		<textarea name="content" placeholder="@lang('items.discreption')" required>{{ $item->content }}</textarea>

		<label for="category">@lang('items.category')</label>
		<select name="category" id="category">
			<option value="{{ $item->category }}">{{ $category }}</option>
			<option>------------------------</option>
			<option value="women">@lang('items.women_items')</option>
			<option value="men">@lang('items.men_items')</option>
		</select>

		<label for="type">@lang('items.type')</label>
		<select name="type" id="type">
			<option value="{{ $item->type->id }}">{{ $item->type->type }}</option>
			<option>------------------------</option>
			@foreach ($types as $type)
				<option value="{{ $type->id }}">{{ $type->type }}</option>
			@endforeach
		</select>

		<input type="hidden" name="item" value="{{ $item->id }}">

		<label for="price1" style="display:inline-block; width:39%; float:left; margin-left:10%;">@lang('items.price_hryvnia')</label>
		<label for="price2" style="display:inline-block; width:39%; float:left; margin-left:2%;">@lang('items.price_change')</label>

		<input id="price1" value="{{ $item->price1 }}" type="number" name="price1" value="0" placeholder="@lang('items.select_hryvnia')" style="width:39%; margin-left:10%; margin-right:1%; float:left;" required>
		<input id="price2" value="{{ $item->price2 }}" type="number" name="price2" value="0" style="width:39%; float:left; margin-right:10%; margin-left:1%;" placeholder="@lang('items.select_change')" max="99" required>

		<img src="{{ asset('/storage/img/clothes/' . $item->image) }}" alt="{{ $item->title }}" style="text-align:center; margin:1em auto; display:block;">
		<input type="file" name="image" id="image">

		<button type="submit" class="btn block">@lang('items.change_item')</button>
	</form>
</div>

@endsection