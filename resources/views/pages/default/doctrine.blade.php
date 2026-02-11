@php
    $heading = $doctrineHeading ?? 'Statement of Faith';
    $content = $doctrineContent ?? '';
@endphp

<div class="min-h-screen bg-base-100" data-theme="corporate">
    @include('themes::components.default.navbar', $__data)

    <main>
        @include('themes::components.default.dark-hero', ['heading' => $heading])

        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-12">
            @if($content)
                <div class="prose prose-lg max-w-none">{!! $content !!}</div>
            @else
                <div class="text-center py-12 text-gray-400">
                    <p>Add content to see it previewed here.</p>
                </div>
            @endif
        </div>
    </main>

    @include('themes::components.default.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.default.footer', $__data)
</div>
