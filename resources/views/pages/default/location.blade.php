<div class="min-h-screen bg-base-100 flex flex-col" data-theme="corporate">
    <main class="flex-1"></main>
    @include('themes::components.default.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.default.footer', $__data)
</div>
