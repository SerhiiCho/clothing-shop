@extends('layouts.app')

@section('title', trans('slider.slider'))

@section('content')

<div class="container">
    @if ($slider->count() > 0)
        <h3 class="display-4 text-center pt-3 pb-3">
            @lang('slider.slider'): 
            {{ $slider->count() }}
        </h3>

        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">@lang('slider.image')</th>
                    <th scope="col">@lang('slider.order')</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($slider->reverse() as $slide)
                    <tr>
                        <td>
                            <img src="{{ asset("storage/img/big/slider/{$slide->image}") }}" 
                                style="max-width:100px"
                            />
                        </td>
                        <th scope="row">{{ $slide->order }}</th>
                        <td>

                            {{-- Edit button --}}
                            @admin
                                <a href="slider/{{ $slide->id }}/edit" 
                                    class="btn btn-success" 
                                    title="@lang('slider.edit')"
                                >
                                    <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                                </a>

                                {{-- Delete button --}}
                                <form action="{{ action('Admin\SliderController@destroy', ['slider' => $slide->id]) }}" 
                                    method="post" 
                                    class="d-inline"
                                >

                                    @csrf @method('delete')

                                    {{-- Delete slide btn --}}
                                    <button type="submit" 
                                        class="btn btn-success confirm" 
                                        title="@lang('slider.delete')"
                                        data-confirm="@lang('slider.are_you_sure')"
                                    >
                                        <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                    </button>
                                </form>
                            @endadmin
                        </td>
                    </tr>	
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- Add slide btn --}}
    <div class="text-center pb-5">
        <a href="/admin/slider/create" title="@lang('slider.add_slide')" class="btn btn-success">
            @lang('slider.add_slide')
        </a>
    </div>
</div>

@endsection