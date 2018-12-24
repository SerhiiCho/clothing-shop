@extends('layouts.app')

@section('title', auth()->user()->name)

@section('content')
<div class="container pt-3 pb-5 text-center">
    <div class="row">
        <div class="col-md-6">
            @include('admin.dashboard.partials.settings')
        </div>
        <div class="col-md-6">
            @include('admin.dashboard.partials.statistics')
        </div>
    </div>
</div>
@endsection
