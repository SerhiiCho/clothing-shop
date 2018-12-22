@if (isset($contacts) && count($contacts) > 0)
    <section class="contact-container">
        @foreach ($contacts as $contact)
            <div class="contact-item mr-3">
                @empty(! $contact['icon_id'])
                    <img src="{{ asset("storage/img/gsm/{$contact['icon']['image']}") }}"
                        alt="{{ $contact['icon']['name'] }}"
                        width="35" 
                        height="35" 
                        class="gsm-operator"
                    >
                @endempty
                <span>{{ $contact['phone'] }}</span>
            </div>
        @endforeach
    </section>
@endif