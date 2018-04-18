@extends('layouts.app')

@section('content')

<section class="main-content">
	<section class="heading" style="background:#F2F2F2;">Все</section>
	<div class="container">
		<div class="row">
			<div class="col-lg-2 col-md-3 col-xs-6 col-sm-4 card">
				<a href="/item/1" title="#">
					<img src="{{ asset('storage/img/clothes/1.jpg') }}" alt="Платья">
				</a>
				<div class="card-price">
					<span>Title</span>
					<span>50 грн</span>
				</div>
			</div>
			<div class="col-lg-2 col-md-3 col-xs-6 col-sm-4 card">
				<a href="/item/1" title="#">
					<img src="{{ asset('storage/img/clothes/2.jpg') }}" alt="Платья">
				</a>
				<div class="card-price">
					<span>Title</span>
					<span>50 грн</span>
				</div>
			</div>

			<div class="pagination">
				{{-- Pagination --}}
			</div>


			{{-- <p class="center" style="display:block;padding:3em;">В этом разделе еще нет публикаций</p> --}}
		</div>
	</div>
</section>

@endsection