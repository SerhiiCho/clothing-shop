@extends('layouts.app')

@section('content')

<div class="single-container">
	<div class="row">
		<single-item></single-item>

		<!-- Sidebar -->
		<div class="col-xs-12 sidebar">
			<section class="heading">@lang('messages.more_clothes')</section>
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
			</div>
		</div>
	</div>
</div>

@endsection