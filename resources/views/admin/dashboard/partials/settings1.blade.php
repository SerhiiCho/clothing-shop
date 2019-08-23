<table class="table">
    <tr> {{-- Registration option --}}
        <td>
            <form action="{{ action('Admin\OptionController@registration') }}" method="post">

                @csrf
                @method('put')

                <input type="checkbox"
                    class="auto-submit-cb switch"
                    id="switch1"
                    name="option"
                    {{ $admin_options['registration'] ? 'checked' : '' }}
                >
                <label for="switch1">@lang('options.allow_registration')</label>
            </form>
        </td>
    </tr>
    <tr> {{-- First category option --}}
        <td>
            <form action="{{ action('Admin\OptionController@firstCategory') }}" method="post">

                @csrf
                @method('put')

                <input type="checkbox"
                    name="option"
                    id="switch2"
                    class="auto-submit-cb switch"
                    {{ $admin_options['category1'] ? 'checked' : '' }}
                >
                <label for="switch2">@lang('options.turn_on_category1')</label>
            </form>
        </td>
    </tr>
    <tr> {{-- Second category option --}}
        <td>
            <form action="{{ action('Admin\OptionController@secondCategory') }}" method="post">

                @csrf
                @method('put')

                <input type="checkbox"
                    name="option"
                    id="switch3"
                    class="auto-submit-cb switch"
                    {{ $admin_options['category2'] ? 'checked' : '' }}
                >
                <label for="switch3">@lang('options.turn_on_category2')</label>
            </form>
        </td>
    </tr>
    <tr> {{-- Forget cache --}}
        <td align="left">
            <form action="{{ action('Admin\OptionController@cacheForget') }}" method="post">

                @csrf
                @method('put')

                <button type="submit" class="btn btn-sm clean-cache-btn">
                    <i class="fas fa-trash-alt fa-1x"></i> 
                    @lang('options.forget_cache')
                </button>
            </form>
        </td>
    </tr>
</table>

