@extends('layouts.app')

@section('title', trans('items.change_item'))

@section('head')
	<script src="{{ URL::to('/js/tinymce/tinymce.min.js') }}"></script>
@endsection

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
					<input type="text" value="{{ $item->title }}" name="title" placeholder="@lang('items.name')" class="form-control">
				</div>
				<div class="form-group col-12 col-sm-6">
					<label>@lang('items.price')</label>
					<input type="text" value="{{ $item->price }}" name="price" value="0" placeholder="@lang('items.select')" class="form-control">
				</div>
			</div>

			<div class="form-group">
				<label>@lang('items.description')</label>
				<textarea name="content" placeholder="@lang('items.description')" class="form-control" style="min-height: 200px">{{ $item->content }}</textarea>
			</div>

			<div class="row">
				<div class="form-group col-sm-2">
					<label>@lang('items.stock')</label>
					<input type="number" name="stock" value="{{ $item->stock }}" min="0" max="99"class="form-control">
				</div>
				<div class="form-group col-sm-5">
					<label>@lang('items.category')</label>
					<select name="category" class="form-control">
						<option value="{{ $item->category }}">{{ $category }}</option>
						<option>------------------------</option>
						<option value="women">@lang('items.women_items')</option>
						<option value="men">@lang('items.men_items')</option>
					</select>
				</div>
				<div class="form-group col-sm-5">
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
				<input type="file" name="photos[]" class="form-control-file" id="multiple-src-image" multiple>
				<label class="custom-file-label" for="multiple-src-image">@lang('forms.choose_file')...</label>
			</div>

			<button type="submit" class="btn btn-success btn-block mt-3">
				@lang('items.save_item')
			</button>
			<a href="/items" title="@lang('messages.back')" class="btn btn-primary btn-block mt-2">
				@lang('messages.back')
			</a>
		</form>

		<div class="col-md-6 col-lg-4 mt-3">
			<img src="{{ asset('/storage/img/clothes/' . $item->photos[0]->name) }}" alt="{{ $item->title }}" class="rounded mx-auto d-block" id="target-image1" style="width:225px; height:338px;">
			<div class="row mt-2">
				@foreach ($item->photos as $photo)
					@if (! $loop->first)
						<div class="col-6 mt-2">
							<img src="{{ asset('/storage/img/clothes/' . $photo->name) }}" alt="default" class="rounded mx-auto d-block" id="target-image{{ $loop->iteration }}" style="width:113; height:164px;">
						</div>
					@endif
				@endforeach
				@for ($i = 2; $i <= 5; $i++)
					@if ($i > $item->photos->count())
						<div class="col-6 mt-2">
							<img src="{{ asset('/storage/img/clothes/default.jpg') }}" alt="default" class="rounded mx-auto d-block" id="target-image{{ $i }}" style="width:113; height:164px;">
						</div>
					@endif
				@endfor
			</div>
			<div class="text-center">
				<a href="/item/{{ $item->category }}/{{ $item->id }}" class="btn btn-primary mt-3 pl-3 pr-3" title="@lang('items.go_to_product_with_title', ['title' => $item->title])">
					@lang('items.go_to_product') &raquo;
				</a>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script>
	var editor_config = {
		path_absolute: "{{ URL::to('/') }}/",
		selector: "textarea",
		language: 'ru',
		plugins: [
			"autolink lists link preview wordcount fullscreen paste",
		],
		toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
		relative_urls: false
	}
	tinymce.init(editor_config)
</script>
@endsection