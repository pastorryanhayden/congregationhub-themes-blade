@php
    $title = $ministryTitle ?? 'Ministry Name';
    $image = $ministryImage ?? null;
    $whereMeets = $ministryWhereMeets ?? '';
    $content = $ministryContent ?? '';
@endphp

<div class="min-h-screen bg-base-200" data-theme="corporate" x-data="{ menuOpen: false }">
    @include('themes::components.premium.navbar', $__data)
    @include('themes::components.premium.mega-menu', $__data)

    <main>
        @include('themes::components.premium.dark-hero', [
            'heading' => $title,
            'subheading' => $whereMeets ?: null,
            'image' => $image,
        ])

        <section class="bg-base-200 py-20 sm:py-28">
            <div class="max-w-4xl mx-auto px-6 lg:px-8">
                {{-- Back link --}}
                <div class="mb-8">
                    <a href="/ministries" class="text-sm text-base-content/60 hover:text-primary transition-colors inline-flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        Back to Ministries
                    </a>
                </div>

                @if($content)
                    <div class="prose prose-lg max-w-none">{!! $content !!}</div>
                @else
                    <div class="text-center py-12 text-base-content/40">
                        <p>Add content to see it previewed here.</p>
                    </div>
                @endif
            </div>
        </section>
    </main>

    @include('themes::components.premium.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.premium.footer', $__data)
</div>
