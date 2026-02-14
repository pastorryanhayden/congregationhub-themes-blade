<div class="min-h-screen bg-base-200 flex flex-col" data-theme="corporate">
    <main class="flex-1"></main>
    @include('themes::components.premium.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.premium.footer', $__data)
</div>
