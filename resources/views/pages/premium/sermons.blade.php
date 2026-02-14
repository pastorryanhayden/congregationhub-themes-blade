@php
    $title = $pageTitle ?? 'Sermons';
    $items = $sermons ?? [];
    $page = $pagination ?? [];
    $featured = $featuredSeries ?? [];
    $filterOptions = $filters ?? [];
    $active = $activeFilters ?? [];
    $hasFilters = !empty($active['search']) || !empty($active['year']) || !empty($active['speaker']) || !empty($active['series']) || !empty($active['book']);
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
                {{-- Search & Filters --}}
                <form method="GET" action="/sermons" class="mb-8">
                    <div class="relative mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 absolute left-3 top-1/2 -translate-y-1/2 text-base-content/40">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <input
                            type="text"
                            name="search"
                            value="{{ $active['search'] ?? '' }}"
                            placeholder="Search sermons..."
                            class="input w-full pl-10 rounded-full"
                        >
                    </div>

                    <div class="flex flex-wrap gap-2">
                        @if(!empty($filterOptions['years']))
                            <select name="year" class="select select-sm w-auto rounded-full" onchange="this.form.submit()">
                                <option value="">All Years</option>
                                @foreach($filterOptions['years'] as $year)
                                    <option value="{{ $year }}" {{ ($active['year'] ?? '') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endforeach
                            </select>
                        @endif

                        @if(!empty($filterOptions['books']))
                            <select name="book" class="select select-sm w-auto rounded-full" onchange="this.form.submit()">
                                <option value="">All Scripture</option>
                                @foreach($filterOptions['books'] as $book)
                                    <option value="{{ $book['id'] }}" {{ ($active['book'] ?? '') == $book['id'] ? 'selected' : '' }}>{{ $book['name'] }}</option>
                                @endforeach
                            </select>
                        @endif

                        @if(!empty($filterOptions['speakers']))
                            <select name="speaker" class="select select-sm w-auto rounded-full" onchange="this.form.submit()">
                                <option value="">All Speakers</option>
                                @foreach($filterOptions['speakers'] as $sp)
                                    <option value="{{ $sp['id'] }}" {{ ($active['speaker'] ?? '') == $sp['id'] ? 'selected' : '' }}>{{ $sp['name'] }}</option>
                                @endforeach
                            </select>
                        @endif

                        @if(!empty($filterOptions['series']))
                            <select name="series" class="select select-sm w-auto rounded-full" onchange="this.form.submit()">
                                <option value="">All Series</option>
                                @foreach($filterOptions['series'] as $s)
                                    <option value="{{ $s['id'] }}" {{ ($active['series'] ?? '') == $s['id'] ? 'selected' : '' }}>{{ $s['title'] }}</option>
                                @endforeach
                            </select>
                        @endif

                        @if($hasFilters)
                            <a href="/sermons" class="btn btn-ghost btn-sm rounded-full">Clear Filters</a>
                        @endif
                    </div>
                </form>

                {{-- Browse Links --}}
                <div class="flex gap-3 mb-8">
                    <a href="/sermons/series" class="btn btn-outline btn-sm rounded-full">Browse Series</a>
                    <a href="/sermons/speakers" class="btn btn-outline btn-sm rounded-full">Browse Speakers</a>
                </div>

                {{-- Featured Series --}}
                @if(!empty($featured) && !$hasFilters)
                    <div class="mb-12">
                        <h2 class="text-xl font-serif font-bold mb-4">Featured Series</h2>
                        <div class="flex gap-4 overflow-x-auto pb-4 -mx-4 px-4 scrollbar-hide">
                            @foreach($featured as $s)
                                <a href="{{ $s['url'] ?? '#' }}" class="flex-shrink-0 w-64 card bg-base-100 rounded-2xl shadow-lg hover:shadow-2xl transition-shadow overflow-hidden">
                                    @if(!empty($s['image']))
                                        <figure><img src="{{ $s['image'] }}" alt="{{ $s['title'] ?? '' }}" class="h-36 w-full object-cover" /></figure>
                                    @else
                                        <figure>
                                            <div class="h-36 w-full bg-primary/10 flex items-center justify-center">
                                                <svg class="size-10 text-primary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                                </svg>
                                            </div>
                                        </figure>
                                    @endif
                                    <div class="card-body p-4">
                                        <h3 class="card-title text-sm font-serif">{{ $s['title'] ?? '' }}</h3>
                                        <p class="text-xs text-base-content/60">{{ $s['sermonCount'] ?? 0 }} {{ Str::plural('sermon', $s['sermonCount'] ?? 0) }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Sermon List --}}
                <div>
                    <h2 class="text-xl font-serif font-bold mb-4">
                        @if($hasFilters)
                            Search Results
                            <span class="text-base-content/60 font-normal">({{ $page['total'] ?? count($items) }})</span>
                        @else
                            Recent Sermons
                        @endif
                    </h2>

                    @if(empty($items))
                        <div class="text-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto size-12 text-base-content/30">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium">No sermons found</h3>
                            <p class="mt-1 text-base-content/60">
                                @if($hasFilters)
                                    Try adjusting your search or filters.
                                @else
                                    Sermons will appear here once published.
                                @endif
                            </p>
                            @if($hasFilters)
                                <a href="/sermons" class="btn btn-ghost btn-sm mt-4 rounded-full">Clear Filters</a>
                            @endif
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($items as $sermon)
                                <a href="{{ $sermon['url'] ?? '#' }}" class="card card-side bg-base-100 rounded-2xl shadow-lg hover:shadow-xl transition-shadow block overflow-hidden">
                                    <div class="flex w-full">
                                        @if(!empty($sermon['thumbnail']))
                                            <figure class="flex-shrink-0 w-32 sm:w-48 hidden sm:block">
                                                <img src="{{ $sermon['thumbnail'] }}" alt="{{ $sermon['title'] ?? '' }}" class="h-full w-full object-cover" />
                                            </figure>
                                        @endif
                                        <div class="card-body p-4 sm:p-6 flex-1">
                                            <div class="flex items-start justify-between gap-2">
                                                <div class="flex-1 min-w-0">
                                                    <h3 class="font-bold font-serif text-base-content line-clamp-1">{{ $sermon['title'] ?? '' }}</h3>
                                                    <div class="flex flex-wrap items-center gap-2 mt-1">
                                                        @if(!empty($sermon['series']))
                                                            <span class="badge badge-primary badge-outline badge-sm">{{ $sermon['series']['title'] }}</span>
                                                        @endif
                                                        @foreach(($sermon['scriptures'] ?? []) as $ref)
                                                            <span class="badge badge-ghost badge-sm">{{ $ref }}</span>
                                                        @endforeach
                                                    </div>
                                                    <p class="text-sm text-base-content/60 mt-1">
                                                        @if(!empty($sermon['speaker']))
                                                            {{ $sermon['speaker']['name'] }} &middot;
                                                        @endif
                                                        {{ $sermon['date'] ?? '' }}
                                                    </p>
                                                </div>
                                                <div class="flex gap-1 flex-shrink-0">
                                                    @if(!empty($sermon['hasVideo']))
                                                        <div class="badge badge-ghost badge-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                                                            </svg>
                                                        </div>
                                                    @endif
                                                    @if(!empty($sermon['hasAudio']))
                                                        <div class="badge badge-ghost badge-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3.5">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
                                                            </svg>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>

                        {{-- Pagination --}}
                        @if(($page['lastPage'] ?? 1) > 1)
                            <div class="flex justify-center mt-8">
                                <div class="join">
                                    @for($i = 1; $i <= $page['lastPage']; $i++)
                                        @php
                                            $params = array_filter($active ?? []);
                                            $params['page'] = $i;
                                        @endphp
                                        <a href="/sermons?{{ http_build_query($params) }}"
                                           class="join-item btn btn-sm {{ $i == ($page['currentPage'] ?? 1) ? 'btn-active' : '' }}">
                                            {{ $i }}
                                        </a>
                                    @endfor
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </section>
    </main>

    @include('themes::components.premium.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.premium.footer', $__data)
</div>
