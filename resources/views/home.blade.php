@extends('layouts.app')

@section('content')

	<banner></banner>

	<!-- 3 Cards -->
	<section class="heading">@lang('home.season_categories')</section>
	<div class="row center three-cards">
		<div class="col-12 col-sm-4 one-card">
			<img src="{{ asset('storage/img/3cards/1.jpg') }}" alt="">
			<a href="#" title="@lang('home.tops')" class="card-btn">
				<span>@lang('home.tops')</span>
			</a>
		</div>
		<div class="col-12 col-sm-4 one-card">
			<img src="{{ asset('storage/img/3cards/2.jpg') }}" alt="">
			<a href="#" title="@lang('home.skirts')" class="card-btn">
				<span>@lang('home.skirts')</span>
			</a>
		</div>
		<div class="col-12 col-sm-4 one-card">
			<img src="{{ asset('storage/img/3cards/3.jpg') }}" alt="Платья">
			<a href="#" title="@lang('home.dresses')" class="card-btn">
				<span>@lang('home.dresses')</span>
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