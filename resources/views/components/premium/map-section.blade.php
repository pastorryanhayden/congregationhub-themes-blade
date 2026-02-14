@props([
    'mapUrl' => null,
])

@if($mapUrl)
    <section class="bg-base-200 px-4 sm:px-6 py-6">
        <div class="rounded-3xl overflow-hidden">
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
    </section>
@endif
