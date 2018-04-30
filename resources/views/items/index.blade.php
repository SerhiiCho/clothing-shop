@extends('layouts.app')

@section('content')

<section class="main-content">
	<items :admin={{ json_encode(optional(auth()->user())->admin) }}></items>
</section>

@endsection