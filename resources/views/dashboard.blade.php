@extends('layouts.app')

@section('content')
	<a href="/">Home</a>
	<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Выйти">
		Выйти
	</a>

	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
		@csrf
	</form>
@endsection
