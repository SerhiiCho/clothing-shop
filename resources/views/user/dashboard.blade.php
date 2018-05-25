@extends('layouts.app')

@section('title', auth()->user()->name)

@section('content')
<div class="container pt-3 pb-5">
	<h4 class="display-4 text-center">{{ user()->name }}</h4>
	<p class="text-center mb-3">@lang('profile.your_rights')</p>
	<div class="row">
		<div class="col-md-6 offset-md-3">
			{{-- Member --}}
			<div class="list-group">
				<a class="list-group-item list-group-item-{{ user()->isMember() ? 'success' : 'danger' }}">
					@lang('profile.member') 
					<span class="pull-right">
						<i class="fa fa-{{ user()->isMember() ? 'check' : 'times' }}" aria-hidden="true"></i>
					</span>
				</a>
			</div>
			{{-- Admin --}}
			<div class="list-group">
				<a class="list-group-item list-group-item-{{ user()->isAdmin() ? 'success' : 'danger' }}">
					@lang('profile.admin') 
					<span class="pull-right">
						<i class="fa fa-{{ user()->isAdmin() ? 'check' : 'times' }}" aria-hidden="true"></i>
					</span>
				</a>
			</div>
			{{-- Blogger --}}
			<div class="list-group">
				<a class="list-group-item list-group-item-{{ user()->isBlogger() ? 'success' : 'danger' }}">
					@lang('profile.blogger') 
					<span class="pull-right">
						<i class="fa fa-{{ user()->isBlogger() ? 'check' : 'times' }}" aria-hidden="true"></i>
					</span>
				</a>
			</div>
			{{-- Master --}}
			<div class="list-group">
				<a class="list-group-item list-group-item-{{ user()->isMaster() ? 'success' : 'danger' }}">
					@lang('profile.master') 
					<span class="pull-right">
						<i class="fa fa-{{ user()->isMaster() ? 'check' : 'times' }}" aria-hidden="true"></i>
					</span>
				</a>
			</div>
		</div>
	</div>
</div>
@endsection
