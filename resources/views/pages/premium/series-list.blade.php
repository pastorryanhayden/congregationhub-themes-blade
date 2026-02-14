@php
    $title = $pageTitle ?? 'Sermon Series';
    $items = $series ?? [];
@endphp

<div class="min-h-screen bg-base-200" data-theme="corporate" x-data="{ menuOpen: false }">
    @include('themes::components.premium.navbar', $__data)
    @include('themes::components.premium.mega-menu', $__data)

    <main>
        @include('themes::components.premium.dark-hero', [
            'heading' => $title,
        ])

        <section class="bg-base-200 py-20 sm:py-28">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                @if(count($items) > 0)
                    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($items as $s)
                            <a href="{{ $s['url'] ?? '#' }}" class="card bg-base-100 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow overflow-hidden">
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
                                    <h2 class="card-title font-serif">
                                        {{ $s['title'] ?? '' }}
                                        @if(!empty($s['featured']))
                                            <span class="badge badge-primary badge-sm">Featured</span>
                                        @endif
                                        @if(!empty($s['completed']))
                                            <span class="badge badge-ghost badge-sm">Complete</span>
                                        @endif
                                    </h2>
                                    @if(!empty($s['description']))
                                        <p class="text-base-content/70">{{ Str::limit($s['description'], 120) }}</p>
                                    @endif
                                    <div class="flex items-center justify-between mt-2 text-sm text-base-content/60">
                                        <span>{{ $s['sermonCount'] ?? 0 }} {{ Str::plural('sermon', $s['sermonCount'] ?? 0) }}</span>
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
                        <p>No sermon series to display.</p>
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
        </section>
    </main>

    @include('themes::components.premium.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.premium.footer', $__data)
</div>
