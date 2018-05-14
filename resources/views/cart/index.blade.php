@extends('layouts.app')

@section('title', '')

@section('content')

<div class="container">
	@if (Cart::count() > 0)
		<table id="cart" class="table table-hover table-condensed">
			<thead>
				<tr>
					<th style="width:50%">@lang('cart.product')</th>
					<th style="width:10%">@lang('cart.price')</th>
					<th style="width:8%">@lang('cart.quantity')</th>
					<th style="width:22%" class="text-center">@lang('cart.total')</th>
					<th style="width:10%"></th>
				</tr>
			</thead>
			<tbody>
				@foreach (Cart::content() as $item)
					<tr>
						<td data-th="@lang('cart.product')">
							<div class="row">
								<a href="/item/{{ $item->model->id }}" class="col-sm-2 hidden-xs">
									<img src="{{ asset('storage/img/clothes/' . $item->model->image) }}" alt="{{ $item->model->title }}" class="img-responsive" />
								</a>
								<div class="col-sm-10">
									<h4 class="nomargin">{{ $item->model->title }}</h4>
									<p>{{ $item->model->intro }}</p>
								</div>
							</div>
						</td>
						<td data-th="@lang('cart.price')">{{ $item->model->price }} @lang('items.hryvnia')</td>
						<td data-th="@lang('cart.quantity')">
							<input type="number" class="form-control text-center" value="1">
						</td>
						<td data-th="@lang('cart.total')" class="text-center">0 @lang('items.hryvnia')</td>
						<td class="actions" data-th="@lang('cart.add_to_favorite')">
							<form action="{{ action('CartController@addToFavorite', ['id' => $item->rowId]) }}" method="post" class="d-inline">
								@csrf
								<button type="submit" class="btn btn-info btn-sm" title="@lang('cart.add_to_favorite')">
									<i class="fa fa-star-o"></i>
								</button>
							</form>
							<form action="{{ action('CartController@destroy', ['item' => $item->rowId]) }}" method="post" class="d-inline">
								@csrf @method('delete')
								<button type="submit" class="btn btn-danger btn-sm" title="@lang('cart.delete')">
									<i class="fa fa-trash-o"></i>
								</button>
							</form>
						</td>
					</tr>
				@endforeach

			</tbody>

			{{-- Table Footer --}}
			<tfoot>
				<tr>
					<td>
						<a href="#" class="btn btn-warning">
							<i class="fa fa-angle-left"></i> @lang('messages.back')
						</a>
					</td>
					<td colspan="2" class="hidden-xs"></td>
					<td class="hidden-xs text-center">
						<strong>
							@lang('cart.total')  {{ Cart::total() }} @lang('items.hryvnia')
						</strong>
					</td>
					<td>
						<a href="/checkout" class="btn btn-success btn-block">
							@lang('cart.order') <i class="fa fa-angle-right"></i>
						</a>
					</td>
				</tr>
			</tfoot>
		</table>
	@else
		<p class="text-center pt-5 pb-5">@lang('cart.empty')</p>
	@endif

	{{-- Favorite --}}
	<hr />
	<h3 class="display-4 p-3 text-center">@lang('cart.favorite')</h3>

	<section class="row pt-4">
		@if (Cart::instance('favorite')->count() > 0)
			<table id="cart" class="table table-hover table-condensed">
				<thead>
					<tr>
						<th style="width:50%">@lang('cart.product')</th>
						<th style="width:10%">@lang('cart.price')</th>
						<th style="width:10%"></th>
					</tr>
				</thead>
				<tbody>
					@foreach (Cart::instance('favorite')->content() as $item)
						<tr>
							<td data-th="@lang('cart.product')">
								<div class="row">
									<a href="/item/{{ $item->model->id }}" class="col-sm-2 hidden-xs">
										<img src="{{ asset('storage/img/clothes/' . $item->model->image) }}" alt="{{ $item->model->title }}" class="img-responsive" />
									</a>
									<div class="col-sm-10">
										<h4 class="nomargin">{{ $item->model->title }}</h4>
										<p>{{ $item->model->intro }}</p>
									</div>
								</div>
							</td>
							<td data-th="@lang('cart.price')">{{ $item->model->price }} @lang('items.hryvnia')</td>
							<td class="actions" data-th="@lang('cart.add_to_favorite')">
								<form action="{{ action('FavoriteItemController@addToCart', ['id' => $item->rowId]) }}" method="post" class="d-inline">
									@csrf
									<button type="submit" class="btn btn-info btn-sm" title="@lang('cart.add_to_cart')">
										<i class="fa fa-cart-plus"></i>
									</button>
								</form>
								<form action="{{ action('FavoriteItemController@destroy', ['id' => $item->rowId]) }}" method="post" class="d-inline">
									@csrf @method('delete')
									<button type="submit" class="btn btn-danger btn-sm" title="@lang('cart.delete')">
										<i class="fa fa-trash-o"></i>
									</button>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<p class="text-center col-12 pt-5 pb-5">@lang('cart.favorite_empty')</p>
		@endif
	</section>
</div>

@endsection