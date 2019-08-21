<form action="{{ action('Admin\OptionController@categoryTitle') }}" method="post">
    <table class="table">

        @csrf
        @method('put')

        <tr> {{-- First category title option --}}
            <td>
                <div class="form-group text-left">
                    <label for="first_cat_title">@lang('options.set_category1_title')</label>
                    <input type="text"
                        class="form-control"
                        id="first_cat_title"
                        name="first"
                        value="{{ $admin_options['category1_title'] }}"
                    >
                </div>
            </td>
        </tr>
        <tr> {{-- Second category title option --}}
            <td>
                <div class="form-group text-left">
                    <label for="second_cat_title">@lang('options.set_category2_title')</label>
                    <input type="text"
                        class="form-control"
                        id="second_cat_title"
                        name="second"
                        value="{{ $admin_options['category2_title'] }}"
                    >
                </div>
                <button class="btn btn-sm clean-cache-btn mt-4" type="submit">
                    @lang('contacts.save')
                </button>
            </td>
        </tr>
    </table>
</form>
