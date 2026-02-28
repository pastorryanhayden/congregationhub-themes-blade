@props([
    'heading' => 'Welcome',
    'headerImage' => 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1920&q=80',
    'headerVideo' => null,
])

<div class="relative isolate overflow-hidden">
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
    <div class="absolute inset-0 -z-10 bg-black opacity-30"></div>

    {{-- Content --}}
    <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
        <div class="text-center">
            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">
                {{ $heading }}
            </h1>
        </div>
    </div>
</div>
