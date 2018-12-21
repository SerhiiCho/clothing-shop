@isset($contacts)
    <section class="contact-container">
        @forelse ($contacts as $contact)
            <div class="contact-item mr-3">
                @empty(! $contact->icon_id)
                    <img src="{{ asset("storage/img/gsm/{$contact->icon->image}") }}"
                        alt="{{ $contact->icon->name }}"
                        title="{{ $contact->icon->name }}" 
                        width="35" 
                        height="35" 
                        class="gsm-operator"
                    >
                @endempty
                <span>{{ $contact->phone }}</span>
            </div>
        @empty @endforelse
    </section>
@endisset