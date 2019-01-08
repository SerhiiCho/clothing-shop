<section class="position-relative"
    style="{{ isset($color) ? "background:{$color}" : '' }}"
>
    {{-- Anchor --}}
    <a name="{{ $anchor ?? '' }}"></a>

    @admin
        <a href="#!" class="btn btn-success position-absolute rounded-circle"
            style="top:20px; right:20px;"
            data-form="home-form-{{ $section['id'] }}"
            data-section="home-section-{{ $section['id'] }}"
        >
            <i class="fas fa-pen fa-1x"></i>
        </a>

        <form action="{{ action('Admin\SectionController@update', ['section' => $section['id']]) }}"
            class="px-4 d-none mt-3 editing-form"
                method="post"
                id="home-form-{{ $section['id'] }}"
            >
                @csrf @method('put')
                <div class="form-group">
                    <input type="text" 
                        name="title"
                        value="{{ $section['title'] }}"
                        class="form-control text-center"
                    >
                </div>
                <div class="form-group">
                    <textarea name="content"
                        class="form-control"
                    >{{ $section['content'] }}</textarea>
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

    <div id="home-section-{{ $section['id'] }}">
        {{-- Title --}}
        @if (!empty($section['title']))
            <h3 class="display-4 text-center p-4">
                {{ $section['title'] }}
            </h3>
        @endif
        {{-- Content --}}
        @if (!empty($section['content']))
            <p class="text-justify px-5 pb-5" style="font-size:1.2em">
                {!! nl2br($section['content']) !!}
            </p>
        @endif
    </div>
</section>