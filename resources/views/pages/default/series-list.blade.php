@php
    $title = $pageTitle ?? __('Sermon Series');
    $items = $series ?? [];
@endphp

<div class="min-h-screen bg-base-100" data-theme="corporate">
    @include('themes::components.default.navbar', $__data)

    <main>
        @include('themes::components.default.dark-hero', [
            'heading' => $title,
        ])

        @include('themes::components.default.breadcrumb', [
            'parent' => __('Sermons'),
            'parentUrl' => '/sermons',
            'current' => $title,
        ])

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
            @if(count($items) > 0)
                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($items as $s)
                        <a href="{{ $s['url'] ?? '#' }}" class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                            @if(!empty($s['image']))
                                <figure>
                                    <img src="{{ $s['image'] }}" alt="{{ $s['title'] ?? '' }}" class="h-48 w-full object-cover" />
                                </figure>
                            @else
                                <figure>
                                    <div class="h-48 w-full bg-primary/10 flex items-center justify-center">
                                        <svg class="size-12 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                        </svg>
                                    </div>
                                </figure>
                            @endif
                            <div class="card-body">
                                <h2 class="card-title">
                                    {{ $s['title'] ?? '' }}
                                    @if(!empty($s['featured']))
                                        <span class="badge badge-primary badge-sm">{{ __('Featured') }}</span>
                                    @endif
                                    @if(!empty($s['completed']))
                                        <span class="badge badge-ghost badge-sm">{{ __('Complete') }}</span>
                                    @endif
                                </h2>
                                @if(!empty($s['description']))
                                    <p class="text-base-content/70">{{ Str::limit(strip_tags($s['description']), 120) }}</p>
                                @endif
                                <div class="flex items-center justify-between mt-2 text-sm text-base-content/60">
                                    <span>{{ trans_choice('{0} :count sermons|{1} :count sermon|[2,*] :count sermons', $s['sermonCount'] ?? 0, ['count' => $s['sermonCount'] ?? 0]) }}</span>
                                    @if(!empty($s['dateRange']))
                                        <span>{{ $s['dateRange'] }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 text-base-content/60">
                    <p>{{ __('No sermon series to display.') }}</p>
                </div>
            @endif

            <div class="mt-12 pt-8 border-t border-base-300">
                <a href="/sermons" class="btn btn-ghost gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    {{ __('Back to Sermons') }}
                </a>
            </div>
        </div>
    </main>

    @include('themes::components.default.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.default.footer', $__data)
</div>
