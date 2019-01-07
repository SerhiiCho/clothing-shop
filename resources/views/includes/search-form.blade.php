<form method="post" 
    class="header-search"
    action="{{ action('PageController@search') }}"
>
    @csrf
    <input type="search" name="word" placeholder="@lang('navigation.search')" />
    <input type="submit" class="d-none" />
</form>