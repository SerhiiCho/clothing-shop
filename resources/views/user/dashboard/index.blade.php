@extends('layouts.app')

@section('title', auth()->user()->name)

@section('content')
<div class="container pt-3 pb-5 text-center">
    <h4 class="mb-4">@lang('dashboard.dashboard')</h4>
    <div class="row">
        <div class="col-md-6">
            <table class="table">
                <tbody>
                    <tr>
                        <td>@lang('dashboard.lock_registration')</td>
                        <td>
                            <form action="">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </div>
        <div class="col-md-6">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <td>@lang('messages.all_items'):</td>
                        <td>{{ $all_items }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
