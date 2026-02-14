@props([
    'heading' => 'Page Title',
    'subheading' => null,
    'image' => null,
])

<section class="bg-base-200 px-4 sm:px-6 py-6">
    <div class="bg-neutral text-neutral-content rounded-3xl overflow-hidden relative">
        @if($image)
            <img src="{{ $image }}" alt="" class="absolute inset-0 h-full w-full object-cover opacity-20" />
        @endif
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 py-20 sm:py-28">
            <div class="max-w-2xl">
                <h2 class="text-4xl sm:text-6xl font-serif font-bold tracking-tight">{{ $heading }}</h2>
                @if($subheading)
                    <p class="mt-6 text-lg leading-8 text-neutral-content/70">{{ $subheading }}</p>
                @endif
            </div>
        </div>
    </div>
</section>
