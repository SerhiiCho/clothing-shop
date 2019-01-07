<form method="post" action="{{ action('PageController@search') }}" class="search-form">
    @csrf
    <input type="search" name="word"
        placeholder="@lang('navigation.search')"
        class="search-form__input"
    />
    <button type="submit" class="search-form__button">
        <i class="fas fa-search"></i>
    </button>
</form>