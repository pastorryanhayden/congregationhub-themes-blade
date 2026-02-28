@props([
    'heading' => 'Page Title',
    'subheading' => null,
    'image' => null,
])

<div class="relative isolate overflow-hidden bg-neutral py-24 sm:py-32">
    @if($image)
        <img src="{{ $image }}" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover opacity-20" />
    @endif
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl lg:mx-0">
            <h2 class="text-4xl font-bold tracking-tight text-neutral-content sm:text-6xl">{{ $heading }}</h2>
            @if($subheading)
                <p class="mt-6 text-lg leading-8 text-neutral-content/70">{{ $subheading }}</p>
            @endif
        </div>
    </div>
</div>
