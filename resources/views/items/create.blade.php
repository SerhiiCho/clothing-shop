@extends('layouts.app')

@section('content')

<div class="container">
	<div class="col-xs-12 heading center">Добавить товар</div>
	<form action="{{ action('ItemController@store') }}" method="post" class="form">

			@csrf
			@method('put')

			<input type="text" name="title" placeholder="Название">
			<textarea name="content" placeholder="Описание"></textarea>

			<label for="category">Категория</label>
			<select name="category" id="category">
				<option value="women">Женская одежда</option>
				<option value="men">Мужская одежда</option>
			</select>

			<label for="type">Тип</label>
			<select name="type" id="type">
				<option value="Юбки">Юбки</option>
				<option value="Платья">Платья</option>
				<option value="Штаны">Штаны</option>
			</select>

			<input type="file" name="image" id="image">
			<button type="submit" class="btn block">Добавить товар</button>
	</form>
</div>

@endsection