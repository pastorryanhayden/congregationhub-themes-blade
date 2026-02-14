@php
    $heading = $constitutionHeading ?? 'Constitution & Bylaws';
    $content = $constitutionContent ?? '';
@endphp

<div class="min-h-screen bg-base-200" data-theme="corporate" x-data="{ menuOpen: false }">
    @include('themes::components.premium.navbar', $__data)
    @include('themes::components.premium.mega-menu', $__data)

    <main>
        @include('themes::components.premium.dark-hero', ['heading' => $heading])

        <section class="bg-base-200 py-20 sm:py-28">
            <div class="max-w-4xl mx-auto px-6 lg:px-8">
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
