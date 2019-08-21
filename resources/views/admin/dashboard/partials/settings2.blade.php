<form action="{{ action('Admin\OptionController@categoryTitle') }}" method="post">
    <table class="table">

        @csrf
        @method('put')

        <tr> {{-- Women category title option --}}
            <td>
                <div class="form-group text-left">
                    <label for="women_cat_title">@lang('options.set_women_category_title')</label>
                    <input type="text"
                        class="form-control"
                        id="women_cat_title"
                        name="women"
                        value="{{ $admin_options['women_category_title'] }}"
                    >
                </div>
            </td>
        </tr>
        <tr> {{-- Men category title option --}}
            <td>
                <div class="form-group text-left">
                    <label for="men_cat_title">@lang('options.set_men_category_title')</label>
                    <input type="text"
                        class="form-control"
                        id="men_cat_title"
                        name="men"
                        value="{{ $admin_options['men_category_title'] }}"
                    >
                    <button class="btn btn-sm clean-cache-btn mt-4" type="submit">@lang('contacts.save')</button>
                </div>
            </td>
        </tr>
    </table>
</form>
