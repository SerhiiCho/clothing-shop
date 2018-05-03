@extends('layouts.app')

@section('content')

	<banner></banner>

	<!-- 3 Cards -->
	<section class="heading">@lang('home.season_categories')</section>
	<div class="row center three-cards">
		<div class="col-12 col-sm-4 one-card">
			<img src="{{ asset('storage/img/3cards/1.jpg') }}" alt="">
			<a href="/items?type=4" title="@lang('home.tops')" class="card-btn">
				<span>Юбки</span>
			</a>
		</div>
	</div>

	<!-- Content -->
	<section class="main-content">
		<section class="heading" style="background:#F2F2F2;">@lang('home.popular')</section>
		<div class="container">
			<popular :hryvnia="{{ json_encode(trans('items.hryvnia')) }}"></popular>
		</div>
	</section>

@endsection