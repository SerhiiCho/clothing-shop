<h5 class="mb-4">
    <i class="fas fa-wrench grey"></i>
    @lang('dashboard.dashboard')
</h5>

<table class="table">
    <tr> {{-- Registration option --}}
        <td>@lang('options.allow_registration')</td>
        <td>
            <form action="{{ action('Admin\OptionController@registration') }}" method="post">
                @csrf @method('put')
                <input type="checkbox"
                    class="auto-submit-cb"
                    name="option"
                    {{ $admin_options['registration'] ? 'checked' : '' }}
                >
            </form>
        </td>
    </tr>
    <tr> {{-- Men category option --}}
        <td>@lang('options.turn_on_men_category')</td>
        <td>
            <form action="{{ action('Admin\OptionController@menCategory') }}" method="post">
                @csrf @method('put')
                <input type="checkbox"
                    name="option" 
                    class="auto-submit-cb"
                    {{ $admin_options['men_category'] ? 'checked' : '' }}
                >
            </form>
        </td>
    </tr>
    <tr> {{-- Women category option --}}
        <td>@lang('options.turn_on_women_category')</td>
        <td>
            <form action="{{ action('Admin\OptionController@womenCategory') }}" method="post">
                @csrf @method('put')
                <input type="checkbox"
                    name="option" 
                    class="auto-submit-cb"
                    {{ $admin_options['women_category'] ? 'checked' : '' }}
                >
            </form>
        </td>
    </tr>
    <tr> {{-- Forget cache --}}
        <td>@lang('options.forget_cache')</td>
        <td>
            <form action="{{ action('Admin\OptionController@cacheForget') }}" method="post">
                @csrf @method('put')
                <button type="submit" style="background:none; border:none; cursor:pointer">
                    <i class="fas fa-trash-alt fa-1x" style="color:brown"></i>
                </button>
            </form>
        </td>
    </tr>
</table>