@php
    $title = $eventTitle ?? 'Event';
    $date = $eventDate ?? '';
    $description = $eventDescription ?? '';
    $content = $eventContent ?? '';
    $location = $eventLocation ?? null;
    $image = $eventImage ?? null;
@endphp

<div class="min-h-screen bg-base-100" data-theme="corporate">
    @include('themes::components.default.navbar', $__data)

    <main>
        @include('themes::components.default.dark-hero', [
            'heading' => $title,
            'subheading' => $date,
            'image' => $image,
        ])

        @include('themes::components.default.breadcrumb', [
            'parent' => 'Events',
            'parentUrl' => '/events',
            'current' => $title,
        ])

        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-12">
            {{-- Event meta info --}}
            <div class="mb-8 flex flex-wrap gap-4">
                @if($date)
                    <div class="flex items-center gap-2 text-base-content/70">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 9v7.5" />
                        </svg>
                        <span>{{ $date }}</span>
                    </div>
                @endif
                @if($location)
                    <div class="flex items-center gap-2 text-base-content/70">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        <span>{{ $location }}</span>
                    </div>
                @endif
            </div>

            {{-- Event description --}}
            @if($description)
                <div class="text-lg text-base-content/80 mb-8">{!! $description !!}</div>
            @endif

            {{-- Event content --}}
            @if($content)
                <div class="prose prose-lg max-w-none">{!! markdown_to_html($content) !!}</div>
            @endif

            {{-- Back to events link --}}
            <div class="mt-12 pt-8 border-t border-base-300">
                <a href="/events" class="btn btn-ghost gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Back to Events
                </a>
            </div>
        </div>
    </main>

    @include('themes::components.default.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.default.footer', $__data)
</div>
