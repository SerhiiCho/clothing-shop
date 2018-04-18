@extends('layouts.app')

@section('content')

	<banner></banner>

	<!-- 3 Cards -->
	<section class="heading">@lang('home.season_categories')</section>
	<div class="row center three-cards">
		<div class="col-xs-12 col-sm-4 one-of-three-cards">
			<img src="{{ asset('storage/img/3cards/1.jpg') }}" alt="">
			<a href="#" title="@lang('home.tops')" class="card-btn">
				<span>@lang('home.tops')</span>
			</a>
		</div>
		<div class="col-xs-12 col-sm-4 one-of-three-cards">
			<img src="{{ asset('storage/img/3cards/2.jpg') }}" alt="">
			<a href="#" title="@lang('home.skirts')" class="card-btn">
				<span>@lang('home.skirts')</span>
			</a>
		</div>
		<div class="col-xs-12 col-sm-4 one-of-three-cards">
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
			<div class="row">
				<div class="col-lg-2 col-md-3 col-xs-6 col-sm-4 card">
					<a href="#" title="#">
						<img src="{{ asset('storage/img/clothes/1.jpg') }}" alt="Платья">
					</a>
					<div class="card-price">
						<span>Title</span>
						<span>50 грн</span>
					</div>
				</div>
				<div class="col-lg-2 col-md-3 col-xs-6 col-sm-4 card">
					<a href="#" title="#">
						<img src="{{ asset('storage/img/clothes/2.jpg') }}" alt="Платья">
					</a>
					<div class="card-price">
						<span>Title</span>
						<span>50 грн</span>
					</div>
				</div>
				<div class="col-lg-2 col-md-3 col-xs-6 col-sm-4 card">
					<a href="#" title="#">
						<img src="{{ asset('storage/img/clothes/3.jpg') }}" alt="Платья">
					</a>
					<div class="card-price">
						<span>Title</span>
						<span>50 грн</span>
					</div>
				</div>
				<div class="col-lg-2 col-md-3 col-xs-6 col-sm-4 card">
					<a href="#" title="#">
						<img src="{{ asset('storage/img/clothes/4.jpg') }}" alt="Платья">
					</a>
					<div class="card-price">
						<span>Title</span>
						<span>50 грн</span>
					</div>
				</div>
				<div class="col-lg-2 col-md-3 col-xs-6 col-sm-4 card">
					<a href="#" title="#">
						<img src="{{ asset('storage/img/clothes/1.jpg') }}" alt="Платья">
					</a>
					<div class="card-price">
						<span>Title</span>
						<span>50 грн</span>
					</div>
				</div>
				<div class="col-lg-2 col-md-3 col-xs-6 col-sm-4 card">
					<a href="#" title="#">
						<img src="{{ asset('storage/img/clothes/2.jpg') }}" alt="Платья">
					</a>
					<div class="card-price">
						<span>Title</span>
						<span>50 грн</span>
					</div>
				</div>

				<!-- Pagination -->
				{{-- <div class="pagination">«»</div> --}}
			</div>
		</div>
	</section>

@endsection