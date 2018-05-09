@isset($contacts)
	@forelse ($contacts as $contact)
		<section class="contact-container">
			<div class="contact-item">
				@empty(! $contact->icon_id)
					<img src="{{ asset('storage/img/' . $contact->icon->image) }}" alt="{{ $contact->icon->name }}" title="{{ $contact->icon->name }}" width="35" height="35" class="gsm-operator">
				@endempty
				<span>{{ $contact->phone }}</span>
			</div>
		</section>
	@empty @endforelse
@endisset