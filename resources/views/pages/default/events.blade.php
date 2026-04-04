@php
    $month = $currentMonth ?? __('This Month');
    $prev = $prevMonth ?? [];
    $next = $nextMonth ?? [];
    $days = $calendarDays ?? [];
    $upcoming = $upcomingEvents ?? [];
@endphp

<div class="min-h-screen bg-base-100" data-theme="corporate">
    @include('themes::components.default.navbar', $__data)

    <main>
        @include('themes::components.default.dark-hero', [
            'heading' => __('Events & Calendar'),
        ])

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
            {{-- Month Navigation --}}
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold">{{ $month }}</h2>
                <div class="flex gap-2">
                    @if(!empty($prev))
                        <a href="/events?year={{ $prev['year'] }}&month={{ $prev['month'] }}"
                           class="btn btn-ghost btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                        </a>
                    @endif
                    <a href="/events" class="btn btn-ghost btn-sm">{{ __('Today') }}</a>
                    @if(!empty($next))
                        <a href="/events?year={{ $next['year'] }}&month={{ $next['month'] }}"
                           class="btn btn-ghost btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>

            {{-- Calendar Grid --}}
            <div class="card bg-base-100 shadow-xl mb-12">
                <div class="card-body p-2 sm:p-4">
                    {{-- Day Headers --}}
                    <div class="grid grid-cols-7 gap-1 mb-2">
                        @foreach([__('Sun'), __('Mon'), __('Tue'), __('Wed'), __('Thu'), __('Fri'), __('Sat')] as $dayName)
                            <div class="text-center text-sm font-semibold text-base-content/60 py-2">
                                {{ $dayName }}
                            </div>
                        @endforeach
                    </div>

                    {{-- Calendar Days --}}
                    <div class="grid grid-cols-7 gap-1">
                        @foreach($days as $day)
                            <div class="min-h-[80px] sm:min-h-[100px] border border-base-300 rounded-lg p-1 sm:p-2 {{ !($day['isCurrentMonth'] ?? true) ? 'bg-base-200/50 opacity-50' : '' }} {{ ($day['isToday'] ?? false) ? 'ring-2 ring-primary' : '' }}">
                                <div class="text-sm font-medium {{ ($day['isToday'] ?? false) ? 'text-primary' : '' }}">
                                    {{ $day['day'] ?? '' }}
                                </div>

                                <div class="mt-1 space-y-0.5">
                                    {{-- Services (secondary color) --}}
                                    @foreach(($day['services'] ?? []) as $service)
                                        <div class="text-xs truncate bg-secondary/10 text-secondary px-1 py-0.5 rounded">
                                            {{ $service['time'] ?? '' }} {{ $service['description'] ?? '' }}
                                        </div>
                                    @endforeach

                                    {{-- Events (primary color, linked) --}}
                                    @foreach(array_slice($day['events'] ?? [], 0, 2) as $event)
                                        @if(!empty($event['url']))
                                            <a href="{{ $event['url'] }}" class="block text-xs truncate bg-primary/10 text-primary px-1 py-0.5 rounded hover:bg-primary/20">
                                                {{ $event['title'] ?? '' }}
                                            </a>
                                        @else
                                            <div class="text-xs truncate bg-primary/10 text-primary px-1 py-0.5 rounded">
                                                {{ $event['title'] ?? '' }}
                                            </div>
                                        @endif
                                    @endforeach

                                    @php
                                        $hiddenCount = count($day['events'] ?? []) - 2;
                                    @endphp
                                    @if($hiddenCount > 0)
                                        <div class="text-xs text-base-content/60">{{ __(':count more', ['count' => '+' . $hiddenCount]) }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Upcoming Events --}}
            @if(!empty($upcoming))
                <div class="mt-12">
                    <h2 class="text-2xl font-bold mb-6">{{ __('Upcoming Events') }}</h2>

                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($upcoming as $event)
                            <div class="card bg-base-100 shadow-xl">
                                @if(!empty($event['image']))
                                    <figure>
                                        <img src="{{ $event['image'] }}" alt="{{ $event['title'] ?? '' }}" class="h-48 w-full object-cover" />
                                    </figure>
                                @endif
                                <div class="card-body">
                                    <div class="flex items-start gap-4">
                                        <div class="text-center min-w-[50px] bg-primary/10 rounded-lg p-2 flex-shrink-0">
                                            <div class="text-xl font-bold text-primary">{{ $event['startDay'] ?? '' }}</div>
                                            <div class="text-xs text-base-content/60">{{ $event['startMonth'] ?? '' }}</div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="card-title text-base">{{ $event['title'] ?? '' }}</h3>
                                            <p class="text-sm text-base-content/60">{{ $event['date'] ?? '' }}</p>
                                            @if(!empty($event['location']))
                                                <p class="text-sm text-base-content/60 mt-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 inline">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                                    </svg>
                                                    {{ $event['location'] }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    @if(!empty($event['description']))
                                        <p class="text-sm text-base-content/70 mt-2">{{ Str::limit($event['description'], 120) }}</p>
                                    @endif
                                    @if(!empty($event['url']))
                                        <div class="card-actions justify-end mt-2">
                                            <a href="{{ $event['url'] }}" class="btn btn-primary btn-sm">{{ __('Details') }}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </main>

    @include('themes::components.default.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.default.footer', $__data)
</div>
