@extends('layouts.app')

@section('content')

<section class="main-content">
	<items :admin="'@json('auth()->user()->admin')'">
	</items>
</section>

@endsection