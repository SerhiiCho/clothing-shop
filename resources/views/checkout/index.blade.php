@extends('layouts.app')

@section('title', trans('checkout.checkout'))

@section('content')
<div class="container pb-5 pt-5">
	<div class="row">
		<div class="col-md-4 order-md-2 mb-4">
			<h4 class="d-flex justify-content-between align-items-center mb-3">
				<span class="text-muted">@lang('checkout.your_order')</span>
				<span class="badge badge-secondary badge-pill">{{ Cart::content()->count() }}</span>
			</h4>
			<ul class="list-group mb-3">
				@foreach (Cart::content() as $item)
					<li class="list-group-item d-flex justify-content-between lh-condensed">
						<div>
							<h6 class="my-0">{{ $item->model->title }}</h6>
						</div>
						<span class="text-muted text-right" style="min-width:80px">
							{{ $item->model->price }} @lang('items.hryvnia')
						</span>
					</li>
				@endforeach
				<li class="list-group-item d-flex justify-content-between">
					<span>@lang('cart.total')</span>
					<strong>{{ Cart::total() }} @lang('items.hryvnia')</strong>
				</li>
			</ul>
		</div>
		<div class="col-md-8 order-md-1">
			<h4 class="mb-3">@lang('checkout.your_info')</h4>
			<form action="{{ action('CheckoutController@store') }}" method="post" class="needs-validation" id="prevent-double-submitting">
				@csrf
				<div class="row">
					<div class="col-md-6 mb-3">
						<label for="name">@lang('checkout.name')</label>
						<input type="text" class="form-control" id="name" placeholder="@lang('checkout.name')" name="name" required>
					</div>
					<div class="col-md-6 mb-3">
						<label for="phone">@lang('checkout.phone')</label>
						<input type="text" class="form-control" id="phone" placeholder="@lang('checkout.phone')" name="phone" required>
					</div>
				</div>
				<hr class="mb-4">
				<button class="btn btn-dark btn-lg btn-block" type="submit" id="submit-button" onclick="disableButton()">
					@lang('cart.order')
				</button>
			</form>
		</div>
	</div>
</div>
@endsection