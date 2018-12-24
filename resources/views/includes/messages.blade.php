@if (count($errors) > 0)
    <div class="container mt-3 mb-3">
        @foreach ($errors->all() as $error)
            <message state="error">{{ $error }}</message>
        @endforeach
    </div>
@endif

@if (session('success'))
    <div class="container mt-3 mb-3">
        <message state="success">{!! session('success') !!}</message>
    </div>
@endif

@if (session('error'))
    <div class="container mt-3 mb-3">
        <message state="error">{!! session('error') !!}</message>
    </div>
@endif