@props([
    'showSermons' => true,
    'series' => [],
])

@php
    $bgColors = ['bg-neutral', 'bg-primary', 'bg-secondary'];
@endphp

@if($showSermons && count($series) > 0)
    <div class="bg-base-200">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-24 lg:px-8">
            <div class="sm:flex sm:items-baseline sm:justify-between">
                <h2 class="text-2xl font-bold tracking-tight text-base-content">Featured Series</h2>
                <a href="/sermons/series" class="hidden text-sm font-semibold text-base-content/60 hover:text-primary sm:block">
                    View All Series
                    <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:grid-rows-2 sm:gap-x-6 lg:gap-8">
                @foreach($series as $index => $single)
                    @if(count($series) === 1 && $index === 0)
                        {{-- Only 1 series: full width --}}
                        <div class="group overflow-hidden rounded-lg sm:row-span-2 sm:col-span-2 relative {{ !empty($single['image']) ? '' : $bgColors[0] }}" style="min-height: 300px;">
                            @if(!empty($single['image']))
                                <img src="{{ $single['image'] }}" alt="{{ $single['description'] ?? '' }}" class="object-cover object-center group-hover:opacity-75 absolute inset-0 h-full w-full" />
                            @endif
                            <div aria-hidden="true" class="bg-gradient-to-b from-transparent to-black opacity-50 absolute inset-0"></div>
                            <div class="flex items-end p-6 absolute inset-0">
                                <div>
                                    <h3 class="font-semibold text-white text-lg">
                                        <a href="{{ $single['url'] ?? '#' }}"><span class="absolute inset-0"></span>{{ $single['title'] ?? '' }}</a>
                                    </h3>
                                    @if(!empty($single['description']))
                                        <p aria-hidden="true" class="mt-1 text-sm text-white">{{ strip_tags($single['description']) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @elseif(count($series) === 2)
                        {{-- 2 series: both tall --}}
                        <div class="group overflow-hidden rounded-lg sm:row-span-2 relative {{ !empty($single['image']) ? '' : $bgColors[$index] }}" style="min-height: 300px;">
                            @if(!empty($single['image']))
                                <img src="{{ $single['image'] }}" alt="{{ $single['description'] ?? '' }}" class="object-cover object-center group-hover:opacity-75 absolute inset-0 h-full w-full" />
                            @endif
                            <div aria-hidden="true" class="bg-gradient-to-b from-transparent to-black opacity-50 absolute inset-0"></div>
                            <div class="flex items-end p-6 absolute inset-0">
                                <div>
                                    <h3 class="font-semibold text-white text-lg">
                                        <a href="{{ $single['url'] ?? '#' }}"><span class="absolute inset-0"></span>{{ $single['title'] ?? '' }}</a>
                                    </h3>
                                    @if(!empty($single['description']))
                                        <p aria-hidden="true" class="mt-1 text-sm text-white">{{ strip_tags($single['description']) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @elseif($index === 0)
                        {{-- 3+ series: first is tall --}}
                        <div class="group overflow-hidden rounded-lg sm:row-span-2 relative {{ !empty($single['image']) ? '' : $bgColors[0] }}" style="min-height: 300px;">
                            @if(!empty($single['image']))
                                <img src="{{ $single['image'] }}" alt="{{ $single['description'] ?? '' }}" class="object-cover object-center group-hover:opacity-75 absolute inset-0 h-full w-full" />
                            @endif
                            <div aria-hidden="true" class="bg-gradient-to-b from-transparent to-black opacity-50 absolute inset-0"></div>
                            <div class="flex items-end p-6 absolute inset-0">
                                <div>
                                    <h3 class="font-semibold text-white text-lg">
                                        <a href="{{ $single['url'] ?? '#' }}"><span class="absolute inset-0"></span>{{ $single['title'] ?? '' }}</a>
                                    </h3>
                                    @if(!empty($single['description']))
                                        <p aria-hidden="true" class="mt-1 text-sm text-white">{{ strip_tags($single['description']) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- 3+ series: smaller cards --}}
                        <div class="group overflow-hidden rounded-lg relative {{ !empty($single['image']) ? '' : $bgColors[$index % count($bgColors)] }}" style="min-height: 180px;">
                            @if(!empty($single['image']))
                                <img src="{{ $single['image'] }}" alt="{{ $single['description'] ?? '' }}" class="object-cover object-center group-hover:opacity-75 absolute inset-0 h-full w-full" />
                            @endif
                            <div aria-hidden="true" class="bg-gradient-to-b from-transparent to-black opacity-50 absolute inset-0"></div>
                            <div class="flex items-end p-6 absolute inset-0">
                                <div>
                                    <h3 class="font-semibold text-white text-lg">
                                        <a href="{{ $single['url'] ?? '#' }}"><span class="absolute inset-0"></span>{{ $single['title'] ?? '' }}</a>
                                    </h3>
                                    @if(!empty($single['description']))
                                        <p aria-hidden="true" class="mt-1 text-sm text-white">{{ strip_tags($single['description']) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="mt-6 sm:hidden">
                <a href="/sermons/series" class="block text-sm font-semibold text-base-content/60 hover:text-base-content/50">
                    Browse all sermon series
                    <span aria-hidden="true"> &rarr;</span>
                </a>
            </div>
        </div>
    </div>
@endif
