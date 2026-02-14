@props([
    'churchPhone' => null,
    'churchEmail' => null,
    'churchAddress' => null,
])

@php
    $hasContactInfo = $churchPhone || $churchEmail || $churchAddress;
@endphp

<section class="bg-base-200 px-4 sm:px-6 py-6">
    <div class="bg-neutral text-neutral-content rounded-3xl overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 sm:py-28 text-center">
            <h2 class="text-3xl sm:text-4xl font-serif font-bold mb-4">Get In Touch</h2>
            <p class="mb-8 max-w-2xl mx-auto text-neutral-content/70">We would love to hear from you. Reach out to us anytime.</p>

            @if($hasContactInfo)
                <div class="flex flex-wrap justify-center gap-6 mb-8">
                    @if($churchPhone)
                        <div class="flex items-center gap-2 text-neutral-content/80">
                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>{{ $churchPhone }}</span>
                        </div>
                    @endif
                    @if($churchEmail)
                        <div class="flex items-center gap-2 text-neutral-content/80">
                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>{{ $churchEmail }}</span>
                        </div>
                    @endif
                </div>
            @endif

            <a href="/about" class="btn btn-outline border-neutral-content/30 text-neutral-content hover:bg-neutral-content hover:text-neutral btn-lg rounded-full px-8">Contact Us</a>
        </div>
    </div>
</section>
