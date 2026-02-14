@props([
    'showSermons' => true,
    'series' => [],
])

@if($showSermons && count($series) > 0)
    <section class="bg-base-200 py-20 sm:py-28">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="sm:flex sm:items-baseline sm:justify-between mb-10">
                <h2 class="text-3xl sm:text-4xl font-serif font-bold tracking-tight text-base-content">Featured Series</h2>
                <a href="/sermons/series" class="hidden sm:block text-sm font-semibold text-base-content/60 hover:text-primary transition-colors">
                    View All Series
                    <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($series as $index => $single)
                    <a href="#" class="group block rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-shadow bg-base-100 {{ $index === 0 && count($series) >= 3 ? 'sm:col-span-2 lg:col-span-1' : '' }}">
                        <div class="relative h-56">
                            @if(!empty($single['image']))
                                <img src="{{ $single['image'] }}" alt="{{ $single['description'] ?? '' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                            @else
                                <div class="w-full h-full bg-primary/10 flex items-center justify-center">
                                    <svg class="size-12 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-xl sm:text-2xl font-serif font-bold text-base-content group-hover:text-primary transition-colors">{{ $single['title'] ?? '' }}</h3>
                            @if(!empty($single['description']))
                                <p class="mt-2 text-sm text-base-content/60 line-clamp-2">{{ $single['description'] }}</p>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8 sm:hidden">
                <a href="/sermons/series" class="block text-sm font-semibold text-base-content/60 hover:text-primary">
                    Browse all sermon series
                    <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>
        </div>
    </section>
@endif
