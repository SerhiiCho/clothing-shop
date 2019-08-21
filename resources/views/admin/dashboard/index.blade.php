@extends('layouts.app')

@section('title', auth()->user()->name)

@section('content')
<div class="container pt-4 pb-5 text-center">
    <h5 class="mb-5">
        <i class="fas fa-wrench grey"></i>
        @lang('dashboard.dashboard')
    </h5>

    <div class="row">
        <div class="col-md-6">
            @include('admin.dashboard.partials.settings1')
        </div>
        <div class="col-md-6">
            @include('admin.dashboard.partials.settings2')
        </div>
    </div>
</div>
@endsection
