<section class="contact-container">
    @if (isset($gsm) && count($gsm) > 0)
        @foreach ($gsm as $contact)
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
    @endif
</section>