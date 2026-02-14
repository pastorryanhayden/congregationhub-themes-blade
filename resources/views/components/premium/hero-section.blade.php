@props([
    'heading' => 'Welcome',
    'headerImage' => 'https://images.unsplash.com/photo-1438232992991-995b7058bbb3?w=1920&q=80',
    'headerVideo' => null,
])

<div class="relative isolate overflow-hidden min-h-[70vh] flex items-center">
    {{-- Background image --}}
    <img
        src="{{ $headerImage }}"
        alt=""
        class="absolute inset-0 -z-20 h-full w-full object-cover"
    />

    {{-- Video (if exists) --}}
    @if($headerVideo)
        <video
            autoplay
            muted
            loop
            playsinline
            poster="{{ $headerImage }}"
            class="absolute inset-0 -z-20 h-full w-full object-cover"
        >
            <source src="{{ $headerVideo }}" type="video/mp4" />
        </video>
    @endif

    {{-- Dark overlay --}}
    <div class="absolute inset-0 -z-10 bg-black opacity-50"></div>

    {{-- Content --}}
    <div class="mx-auto max-w-7xl px-6 lg:px-8 py-32 sm:py-48 lg:py-56 w-full">
        <div class="text-center">
            <h1 class="text-5xl sm:text-7xl font-serif font-bold tracking-tight text-white">
                {{ $heading }}
            </h1>
        </div>
    </div>
</div>
