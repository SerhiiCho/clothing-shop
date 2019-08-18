<div class="row center three-cards">
    @foreach ($cards as $card)
        <div class="col-12 col-md-4 one-card">
            <img src="{{ asset("storage/img/big/cards/{$card['image']}") }}" 
                alt="{{ $card['type']['name'] }}"
            />

            <a href="/items?category={{ $card['category'] }}&type={{ $card['type_id'] }}" 
                title="{{ $card['type']['name'] }}" 
                class="card-btn"
            >
                <span>{{ $card['type']['name'] }}</span>
            </a>

            @if (isset($controls) && $controls)
                {{-- Edit button --}}
                @admin
                    <div style="opacity:0.9">
                        <a href="/admin/cards/{{ $card['id'] }}/edit"
                            class="position-absolute" 
                            title="@lang('cards.change_card')" 
                            style="top:5px; left:40px"
                        >
                            <h3>
                                <span class="badge badge-success">
                                    <i class="fas fa-pencil-alt"></i>
                                </span>
                            </h3>
                        </a>

                        {{-- Delete button --}}
                        <form action="{{ action('Admin\CardController@destroy', ['id' => $card['id']]) }}"
                            method="post" 
                            class="position-absolute" 
                            style="top:5px; right:40px"
                        >
                            @csrf @method('delete')

                            <button type="submit"
                                class="confirm bg-transparent" 
                                style="border:0; cursor:pointer"
                                title="@lang('cards.delete_card')"
                                data-confirm="@lang('cards.are_you_sure_you_want_delete')"
                            >
                                <h3>
                                    <span class="badge badge-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </span>
                                </h3>
                            </button>
                        </form>
                    </div>
                @endadmin
            @endif
        </div>
    @endforeach
</div>