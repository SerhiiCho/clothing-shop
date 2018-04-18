@extends('layouts.app')

@section('content')
	<banner></banner>

	<!-- 3 Cards -->
	<section class="col-xs-12 home-cards-heading center">
		Сезонные категории
	</section>
	<div class="row center three-cards">
		<div class="col-xs-12 col-sm-4 one-of-three-cards">
			<img src="{{ asset('storage/img/3cards/1.jpg') }}" alt="">
			<a href="#" title="Топы" class="card-btn">
				<span>Топы</span>
			</a>
		</div>
		<div class="col-xs-12 col-sm-4 one-of-three-cards">
			<img src="{{ asset('storage/img/3cards/2.jpg') }}" alt="">
			<a href="#" title="Юбки" class="card-btn">
				<span>Юбки</span>
			</a>
		</div>
		<div class="col-xs-12 col-sm-4 one-of-three-cards">
			<img src="{{ asset('storage/img/3cards/3.jpg') }}" alt="Платья">
			<a href="#" title="Платья" class="card-btn">
				<span>Платья</span>
			</a>
		</div>
	</div>

	<!-- Content -->
	<section class="col-xs-12 home-cards-heading center" style="background:#F2F2F2;">Популярное</section>
	<section class="main-content">
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