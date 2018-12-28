@extends('layouts.app')

@section('title', trans('messages.welcome'))

@section('content')

<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-10 pr-0 main-slider text-center" v-if="false">
                <div class="loader mt-5"></div>
            </div>
            <slider></slider>
            <cards></cards>
        </div>
    </div>

    <!-- 3 Cards -->
    @if (isset($cards) && count($cards) > 0)
        <h3 class="display-4 text-center p-4">
            @lang('cards.season_categories')
        </h3>

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
                </div>
            @endforeach
        </div>
    @endif

    <items-api
        hryvnia="@lang('items.hryvnia')"
        headline="@lang('cards.popular')"
        to="/api/item/popular"
    ></items-api>

    {{-- Home Section --}}
    @isset($home_section)
        <section class="position-relative">
            @admin
                <a href="#!" class="btn btn-success position-absolute rounded-circle edit-form-btn"
                    style="top:20px; right:20px;"
                    data-form="home-form"
                    data-section="home-section"
                >
                    <i class="fas fa-pen fa-1x"></i>
                </a>
            @endadmin
            {{-- Form --}}
            @admin
                <form action="{{ action('Admin\SectionController@update', ['section' => $home_section['id']]) }}"
                    class="px-4 d-none mt-3 editing-form"
                    method="post"
                    id="home-form"
                >
                    @csrf @method('put')
                    <div class="form-group">
                        <input type="text" 
                            name="title"
                            value="{{ $home_section['title'] }}"
                            class="form-control text-center"
                        >
                    </div>
                    <div class="form-group">
                        <textarea name="content"
                            class="form-control"
                        >{{ $home_section['content'] }}</textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit"
                            class="btn btn-success position-absolute rounded-circle edit-form-btn" 
                            title="@lang('contacts.save')"
                            style="top:20px; right:75px;"
                        >
                            <i class="fas fa-save fa-1x"></i>
                        </button>
                    </div>
                </form>
            @endadmin
            <div id="home-section">
                {{-- Title --}}
                @if (!empty($home_section['title']))
                    <h3 class="display-4 text-center p-4">
                        {{ $home_section['title'] }}
                    </h3>
                @endif
                {{-- Content --}}
                @if (!empty($home_section['content']))
                    <p class="text-justify px-5 pb-5" style="font-size:1.2em">
                        {{ $home_section['content'] }}
                    </p>
                @endif
            </div>
        </section>
    @endisset
</div>

@endsection
