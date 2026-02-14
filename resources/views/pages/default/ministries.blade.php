@php
    $title = $pageTitle ?? 'Our Ministries';
    $items = $ministries ?? [];
@endphp

<div class="min-h-screen bg-base-100" data-theme="corporate">
    @include('themes::components.default.navbar', $__data)

    <main>
        @include('themes::components.default.dark-hero', [
            'heading' => $title,
        ])

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
            @if(count($items) > 0)
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($items as $ministry)
                        <a href="{{ $ministry['url'] ?? '#' }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                            @if(!empty($ministry['image']))
                                <figure>
                                    <img src="{{ $ministry['image'] }}" alt="{{ $ministry['title'] ?? '' }}" class="h-48 w-full object-cover" />
                                </figure>
                            @else
                                <figure>
                                    <div class="h-48 w-full bg-base-300 flex items-center justify-center">
                                        <svg class="size-12 text-base-content/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z" />
                                        </svg>
                                    </div>
                                </figure>
                            @endif
                            <div class="card-body">
                                <h2 class="card-title">{{ $ministry['title'] ?? '' }}</h2>
                                @if(!empty($ministry['whoFor']))
                                    <p class="text-sm text-base-content/60">{{ $ministry['whoFor'] }}</p>
                                @endif
                                @if(!empty($ministry['description']))
                                    <p class="text-base-content/70">{{ Str::limit($ministry['description'], 150) }}</p>
                                @endif
                                @if(!empty($ministry['whereMeets']))
                                    <p class="text-sm text-base-content/60 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 inline">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                        </svg>
                                        {{ $ministry['whereMeets'] }}
                                    </p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 text-base-content/60">
                    <p>No ministries to display.</p>
                </div>
            @endif
        </div>
    </main>

    @include('themes::components.default.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.default.footer', $__data)
</div>
