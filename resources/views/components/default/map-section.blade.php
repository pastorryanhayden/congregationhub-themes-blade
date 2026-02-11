@props([
    'mapUrl' => null,
])

@if($mapUrl)
    <div>
        <iframe
            src="{{ $mapUrl }}"
            width="100%"
            height="450"
            style="border: 0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
    </div>
@endif
