@php
    $title = $pageTitle ?? 'Speakers';
    $items = $speakers ?? [];
@endphp

<div class="min-h-screen bg-base-100" data-theme="corporate">
    @include('themes::components.default.navbar', $__data)

    <main>
        @include('themes::components.default.dark-hero', [
            'heading' => $title,
        ])

        @include('themes::components.default.breadcrumb', [
            'parent' => 'Sermons',
            'parentUrl' => '/sermons',
            'current' => $title,
        ])

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
            @if(count($items) > 0)
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach($items as $sp)
                        <a href="{{ $sp['url'] ?? '#' }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                            <div class="card-body items-center text-center">
                                @if(!empty($sp['thumbnail']))
                                    <div class="avatar mb-2">
                                        <div class="w-24 rounded-full">
                                            <img src="{{ $sp['thumbnail'] }}" alt="{{ $sp['name'] ?? '' }}" />
                                        </div>
                                    </div>
                                @else
                                    <div class="avatar avatar-placeholder mb-2">
                                        <div class="bg-primary text-primary-content rounded-full w-24">
                                            <span class="text-3xl">{{ substr($sp['name'] ?? '?', 0, 1) }}</span>
                                        </div>
                                    </div>
                                @endif
                                <h2 class="card-title text-base">{{ $sp['name'] ?? '' }}</h2>
                                @if(!empty($sp['position']))
                                    <p class="text-sm text-base-content/60">{{ $sp['position'] }}</p>
                                @endif
                                <p class="text-sm text-base-content/50 mt-1">{{ $sp['sermonCount'] ?? 0 }} {{ Str::plural('sermon', $sp['sermonCount'] ?? 0) }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 text-base-content/60">
                    <p>No speakers to display.</p>
                </div>
            @endif

            <div class="mt-12 pt-8 border-t border-base-300">
                <a href="/sermons" class="btn btn-ghost gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    Back to Sermons
                </a>
            </div>
        </div>
    </main>

    @include('themes::components.default.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.default.footer', $__data)
</div>
