@extends('layouts.app')

@section('title', trans('items.change_item'))

@section('content')

<div class="container pb-4 col-12 col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
	<h5 class="text-center pt-4">@lang('items.change_item')</h5>

	<div class="row">
		<form action="{{ action('ItemController@update', ['id' => $item->id]) }}" method="post" enctype="multipart/form-data" class="col-md-6 col-lg-8">

			@csrf
			@method('PUT')

			<div class="row">
				<div class="form-group col-12 col-sm-6">
					<label>@lang('items.name')</label>
					<input type="text" value="{{ $item->title }}" name="title" placeholder="@lang('items.name')" class="form-control" required>
				</div>
				<div class="form-group col-12 col-sm-6">
					<label>@lang('items.price')</label>
					<input type="text" value="{{ $item->price }}" name="price" value="0" placeholder="@lang('items.select')" class="form-control" required>
				</div>
			</div>

			<div class="form-group">
				<label>@lang('items.description')</label>
				<textarea name="content" placeholder="@lang('items.description')" class="form-control" style="min-height: 200px" required>{{ $item->content }}</textarea>
			</div>

			<div class="row">
				<div class="form-group col-sm-6">
					<label>@lang('items.category')</label>
					<select name="category" class="form-control">
						<option value="{{ $item->category }}">{{ $category }}</option>
						<option>------------------------</option>
						<option value="women">@lang('items.women_items')</option>
						<option value="men">@lang('items.men_items')</option>
					</select>
				</div>

				<div class="form-group col-sm-6">
					<label>@lang('items.type')</label>
					<select name="type" value="{{ $item->id }}" class="form-control">
						<option value="{{ $item->type->id }}">{{ $item->type->name }}</option>
						<option>------------------------</option>
						@foreach ($types as $type)
							<option value="{{ $type->id }}">{{ $type->name }}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="custom-file">
				<input type="file" name="image" class="form-control-file" id="src-image">
				<label class="custom-file-label" for="src-image">@lang('forms.choose_file')...</label>
			</div>

			<button type="submit" class="btn btn-dark btn-block mt-3">
				@lang('items.change_item')
			</button>
			<a href="/items" title="@lang('messages.back')" class="btn btn-dark btn-block mt-2">
				@lang('messages.back')
			</a>
		</form>

		<div class="col-md-6 col-lg-4 mt-3">
			<img src="{{ asset('/storage/img/clothes/' . $item->image) }}" alt="{{ $item->title }}" class="rounded mx-auto d-block" id="target-image" style="width:225px; height:338px;">
		</div>
	</div>
</div>

@endsection