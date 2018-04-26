@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-xs-12 heading center">Добавить товар</div>
	<form action="{{ action('ItemController@store') }}" method="post" class="form" enctype="multipart/form-data">

			@csrf
			@method('put')

			<input type="text" name="title" placeholder="Название" required>
			<textarea name="content" placeholder="Описание" required></textarea>

			<label for="category">Категория</label>
			<select name="category" id="category">
				<option value="women">Женская одежда</option>
				<option value="men">Мужская одежда</option>
			</select>

			<label for="type">Тип</label>
			<select name="type" id="type">
				@foreach ($types as $type)
					<option value="{{ $type->id }}">{{ $type->type }}</option>
				@endforeach
			</select>

			<label for="price1" style="display:inline-block; width:39%; float:left; margin-left:10%;">Цена (гривны)</label>
			<label for="price2" style="display:inline-block; width:39%; float:left; margin-left:2%;">Цена (мелочь)</label>

			<input id="price1" type="number" name="price1" value="0" placeholder="Укажите гривны" style="width:39%; margin-left:10%; margin-right:1%; float:left;" required>
			<input id="price2" type="number" name="price2" value="0" style="width:39%; float:left; margin-right:10%; margin-left:1%;" placeholder="Укажите мелоч" max="99" required>


			<input type="file" name="image" id="image" required>
			<button type="submit" class="btn block">Добавить товар</button>
	</form>
</div>

@endsection