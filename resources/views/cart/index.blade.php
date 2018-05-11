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
				<tr>
					<td data-th="Product">
						<div class="row">
							<div class="col-sm-2 hidden-xs">
								<img src="{{ asset('storage/img/clothes/yubka-karandash-sinyaya-indresser-1526026776.jpg') }}" alt="..." class="img-responsive" />
							</div>
							<div class="col-sm-10">
								<h4 class="nomargin">Product 1</h4>
								<p>Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet.</p>
							</div>
						</div>
					</td>
					<td data-th="@lang('cart.price')">$1.99</td>
					<td data-th="@lang('cart.quantity')">
						<input type="number" class="form-control text-center" value="1">
					</td>
					<td data-th="@lang('cart.total')" class="text-center">1.99</td>
					<td class="actions" data-th="">
						<button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
						<button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
					</td>
				</tr>
			</tbody>

			{{-- Table Footer --}}
			<tfoot>
				<tr>
					<td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> @lang('messages.back')</a></td>
					<td colspan="2" class="hidden-xs"></td>
					<td class="hidden-xs text-center"><strong>@lang('cart.total') $1.99</strong></td>
					<td>
						<a href="#" class="btn btn-success btn-block">
							@lang('cart.order') <i class="fa fa-angle-right"></i>
						</a>
					</td>
				</tr>
			</tfoot>
		</table>
	@else
		<h4 class="display-4 text-center pt-5 pb-5">@lang('cart.empty')</h4>
	@endif
</div>

@endsection