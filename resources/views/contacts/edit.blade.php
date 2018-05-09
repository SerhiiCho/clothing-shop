@extends('layouts.app')

@section('title', trans('contacts.change_contact'))

@section('content')

<div class="container pb-5">
	<h4 class="display-4 text-center p-3">@lang('contacts.change_contact')</h4>
	<div class="row">
		<div class="col-12 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
			<form action="{{ action('ContactController@update', ['contact' => $contact->id]) }}" method="POST">
				@csrf @method('put')
				<div class="form-group">
					<label for="phone">@lang('contacts.write_phone_number')</label>
					<input type="text" value="{{ $contact->phone }}" name="phone" class="form-control" id="phone" placeholder="(095) 777-77-77" required>
				</div>

				@isset($contact->icon)
					<div class="form-group">
						<label for="icon">@lang('contacts.choose_icon')</label>
						<select class="form-control" id="icon" name="icon">
							<option value="{{ $contact->icon_id }}">{{ $contact->icon->name }}</option>
							<option value="">---------------------------</option>
							@foreach ($icons as $icon)
								<option value="{{ $icon->id }}">{{ $icon->name }}</option>
							@endforeach
						</select>
					</div>
				@endisset

				<button type="submit" class="btn btn-primary" title="@lang('contacts.change_contact')">
					@lang('contacts.change_contact')
				</button>
			</form>
			<form action="{{ action('ContactController@destroy', ['contact' => $contact->id]) }}" method="post" class="mt-2" onsubmit='return confirm("@lang('contacts.confirm_delete')")'>
				@csrf @method('delete')
				<button class="btn btn-danger" title="@lang('contacts.delete')">
					@lang('contacts.delete')
				</button>
			</form>
		</div>
	</div>
</div>

@endsection