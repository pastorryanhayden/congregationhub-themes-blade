@php
    $sp = $speaker ?? [];
    $items = $sermons ?? [];
    $page = $pagination ?? [];
    $filterOptions = $filters ?? [];
    $active = $activeFilters ?? [];
    $hasFilters = !empty($active['year']) || !empty($active['series']);
    $name = $sp['name'] ?? 'Speaker';
@endphp

<div class="min-h-screen bg-base-100" data-theme="corporate">
    @include('themes::components.default.navbar', $__data)

    <main>
        @include('themes::components.default.dark-hero', [
            'heading' => $name,
            'subheading' => $sp['position'] ?? '',
        ])

        @include('themes::components.default.breadcrumb', [
            'parent' => 'Speakers',
            'parentUrl' => '/sermons/speakers',
            'current' => $name,
        ])

        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-12">
            {{-- Speaker Info --}}
            <div class="flex items-start gap-6 mb-8">
                @if(!empty($sp['thumbnail']))
                    <div class="avatar flex-shrink-0">
                        <div class="w-24 sm:w-32 rounded-full">
                            <img src="{{ $sp['thumbnail'] }}" alt="{{ $name }}" />
                        </div>
                    </div>
                @else
                    <div class="avatar avatar-placeholder flex-shrink-0">
                        <div class="bg-primary text-primary-content rounded-full w-24 sm:w-32">
                            <span class="text-4xl">{{ substr($name, 0, 1) }}</span>
                        </div>
                    </div>
                @endif
                <div>
                    <h1 class="text-3xl font-bold">{{ $name }}</h1>
                    @if(!empty($sp['position']))
                        <p class="text-base-content/60 mt-1">{{ $sp['position'] }}</p>
                    @endif
                    <p class="text-sm text-base-content/50 mt-1">{{ $sp['sermonCount'] ?? 0 }} {{ Str::plural('sermon', $sp['sermonCount'] ?? 0) }}</p>
                    @if(!empty($sp['bio']))
                        <div class="prose prose-sm mt-4 max-w-none">{!! $sp['bio'] !!}</div>
                    @endif
                </div>
            </div>

            {{-- Filters --}}
            <form method="GET" class="flex flex-wrap gap-2 mb-6">
                @if(!empty($filterOptions['years']))
                    <select name="year" class="select select-sm w-auto" onchange="this.form.submit()">
                        <option value="">All Years</option>
                        @foreach($filterOptions['years'] as $year)
                            <option value="{{ $year }}" {{ ($active['year'] ?? '') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>
                @endif

                @if(!empty($filterOptions['series']))
                    <select name="series" class="select select-sm w-auto" onchange="this.form.submit()">
                        <option value="">All Series</option>
                        @foreach($filterOptions['series'] as $s)
                            <option value="{{ $s['id'] }}" {{ ($active['series'] ?? '') == $s['id'] ? 'selected' : '' }}>{{ $s['title'] }}</option>
                        @endforeach
                    </select>
                @endif

                @if($hasFilters)
                    <a href="" class="btn btn-ghost btn-sm">Clear Filters</a>
                @endif
            </form>

            {{-- Sermons --}}
            <h2 class="text-xl font-bold mb-4">
                Sermons
                @if($hasFilters)
                    <span class="text-base-content/60 font-normal">({{ $page['total'] ?? count($items) }})</span>
                @endif
            </h2>

            @if(!empty($items))
                <div class="space-y-3">
                    @foreach($items as $sermon)
                        <a href="{{ $sermon['url'] ?? '#' }}" class="flex items-start gap-4 group hover:bg-base-200 p-4 -mx-4 rounded-lg transition-colors">
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-base-content group-hover:text-primary">{{ $sermon['title'] ?? '' }}</p>
                                <div class="flex flex-wrap items-center gap-2 mt-1 text-sm text-base-content/60">
                                    @if(!empty($sermon['series']))
                                        <span class="badge badge-primary badge-outline badge-sm">{{ $sermon['series']['title'] }}</span>
                                    @endif
                                    <span>{{ $sermon['date'] ?? '' }}</span>
                                    @foreach(($sermon['scriptures'] ?? []) as $ref)
                                        <span class="badge badge-ghost badge-sm">{{ $ref }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="flex gap-1 flex-shrink-0 mt-1">
                                @if(!empty($sermon['hasVideo']))
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-base-content/40">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                                    </svg>
                                @endif
                                @if(!empty($sermon['hasAudio']))
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-base-content/40">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
                                    </svg>
                                @endif
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
                                <a href="?{{ http_build_query($params) }}"
                                   class="join-item btn btn-sm {{ $i == ($page['currentPage'] ?? 1) ? 'btn-active' : '' }}">
                                    {{ $i }}
                                </a>
                            @endfor
                        </div>
                    </div>
                @endif
            @else
                <div class="text-center py-12 text-base-content/60">
                    <p>No sermons found.</p>
                    @if($hasFilters)
                        <a href="" class="btn btn-ghost btn-sm mt-4">Clear Filters</a>
                    @endif
                </div>
            @endif

            <div class="mt-12 pt-8 border-t border-base-300 flex gap-3">
                <a href="/sermons/speakers" class="btn btn-ghost gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    All Speakers
                </a>
                <a href="/sermons" class="btn btn-ghost gap-2">All Sermons</a>
            </div>
        </div>
    </main>

    @include('themes::components.default.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.default.footer', $__data)
</div>
