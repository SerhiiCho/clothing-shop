@if (count($errors) > 0)
    <message state="error" header="@lang('messages.error')">
        @foreach ($errors->all() as $error)
            <hr> {{ $error }}
        @endforeach
    </message>
@endif

@if (session('success'))
    <message state="success" header="@lang('messages.success')">
        {!! session('success') !!}
    </message>
@endif

@if (session('error'))
    <message state="error" header="@lang('messages.error')">
        {!! session('error') !!}
    </message>
@endif