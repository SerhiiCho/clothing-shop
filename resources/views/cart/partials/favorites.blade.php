<div class="my-5"></div>
@if (Cart::instance('favorite')->count() > 0)
    <h4 class="text-center pt-2 font-weight-normal">
        @lang('cart.favorite')
    </h4>
@endif

<section class="row pt-4">
    @if (Cart::instance('favorite')->count() > 0)
        <table id="cart" class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width:50%">@lang('cart.product')</th>
                    <th style="width:20%" class="text-center">
                        @lang('cart.price')
                    </th>
                    <th style="width:30%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach (Cart::instance('favorite')->content() as $item)
                    <tr>
                        <td>
                            <div class="row">
                                <a href="/item/{{ $item->model->category }}/{{ $item->model->slug }}" 
                                    class="col-12 col-sm-2"
                                >
                                    <img src="{{ asset("storage/img/small/clothes/{$item->model->photos[0]->name}") }}" 
                                        alt="{{ $item->model->title }}" 
                                        class="img-responsive" 
                                        style="max-width:50px"
                                    />
                                </a>
                                <div class="col-12 col-sm-10 pt-2">
                                    <h6 class="nomargin">{{ $item->model->title }}</h6>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <h6>{{ $item->model->price }} @lang('items.hryvnia')</h6>
                        </td>
                        <td class="text-center">
                            <form class="d-inline" 
                                action="{{ action('FavoriteItemController@switchToCart', ['id' => $item->rowId]) }}" 
                                method="post"
                            >
                                @csrf

                                <button type="submit"
                                    class="btn btn-dark btn-sm" 
                                    title="@lang('cart.add_to_cart')"
                                >
                                    <i class="fas fa-cart-plus grey"></i>
                                </button>
                            </form>
                            <form class="d-inline" 
                                action="{{ action('FavoriteItemController@destroy', ['id' => $item->rowId]) }}" 
                                method="post"
                            >
                                @csrf @method('delete')

                                <button type="submit"
                                    class="btn btn-danger btn-sm" 
                                    title="@lang('cart.delete')"
                                >
                                    <i class="fas fa-trash-alt grey"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</section>