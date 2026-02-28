@php
    $s = $sermon ?? [];
    $related = $relatedSermons ?? [];
    $title = $s['title'] ?? 'Sermon';
    $speaker = $s['speaker'] ?? null;
    $seriesData = $s['series'] ?? null;
    $scriptures = $s['scriptures'] ?? [];
@endphp

<div class="min-h-screen bg-base-100" data-theme="corporate">
    @include('themes::components.default.navbar', $__data)

    <main>
        @include('themes::components.default.dark-hero', [
            'heading' => $title,
            'subheading' => $s['date'] ?? '',
        ])

        @include('themes::components.default.breadcrumb', [
            'parent' => 'Sermons',
            'parentUrl' => '/sermons',
            'current' => $title,
        ])

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Main Column --}}
                <div class="lg:col-span-2 space-y-6">
                    {{-- Video Embed --}}
                    @if(!empty($s['youtubeId']))
                        <div class="relative w-full aspect-video bg-black rounded-lg overflow-hidden shadow-xl">
                            <iframe
                                src="https://www.youtube.com/embed/{{ $s['youtubeId'] }}"
                                class="w-full h-full"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    @elseif(!empty($s['facebookVideoId']))
                        <div class="relative w-full aspect-video bg-black rounded-lg overflow-hidden shadow-xl">
                            <iframe
                                src="https://www.facebook.com/plugins/video.php?href=https://www.facebook.com/watch/?v={{ $s['facebookVideoId'] }}&show_text=false"
                                class="w-full h-full"
                                style="border:none;overflow:hidden"
                                scrolling="no"
                                frameborder="0"
                                allowfullscreen="true"
                                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                            </iframe>
                        </div>
                    @elseif(!empty($seriesData['image']))
                        <div class="relative w-full aspect-[21/9] rounded-lg overflow-hidden shadow-xl">
                            <img src="{{ $seriesData['image'] }}" alt="{{ $seriesData['title'] ?? '' }}" class="w-full h-full object-cover" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        </div>
                    @endif

                    {{-- Title & Meta --}}
                    <div>
                        <h1 class="text-3xl lg:text-4xl font-bold text-base-content mb-3">{{ $title }}</h1>

                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            @if($seriesData)
                                <a href="/sermons/series/{{ $seriesData['slug'] }}" class="badge badge-primary badge-outline">{{ $seriesData['title'] }}</a>
                            @endif
                            @foreach($scriptures as $ref)
                                <span class="badge badge-ghost">{{ $ref }}</span>
                            @endforeach
                        </div>

                        <p class="text-base-content/60">
                            @if($speaker)
                                Preached by <a href="/sermons/speakers/{{ $speaker['slug'] }}" class="font-medium text-base-content hover:text-primary transition-colors">{{ $speaker['name'] }}</a>
                            @endif
                            @if(!empty($s['date']))
                                on <span class="font-medium text-base-content">{{ $s['date'] }}</span>
                            @endif
                        </p>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-wrap gap-3">
                        @if(!empty($s['mp3Url']))
                            <a href="{{ $s['mp3Url'] }}" class="btn btn-primary" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                                </svg>
                                Play Audio
                            </a>
                            <a href="{{ $s['mp3Url'] }}" download class="btn btn-outline">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                Download MP3
                            </a>
                        @endif

                        @if(!empty($s['handoutUrl']))
                            <a href="{{ $s['handoutUrl'] }}" download class="btn btn-outline">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                Handout
                            </a>
                        @endif

                        @if(!empty($s['slidesUrl']))
                            <a href="{{ $s['slidesUrl'] }}" download class="btn btn-outline">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5" />
                                </svg>
                                Slides
                            </a>
                        @endif
                    </div>

                    {{-- Description --}}
                    @if(!empty($s['description']))
                        <div class="card bg-base-200 border-l-4 border-primary">
                            <div class="card-body py-4">
                                <p class="text-base-content italic">{{ $s['description'] }}</p>
                            </div>
                        </div>
                    @endif

                    {{-- Manuscript --}}
                    @if(!empty($s['manuscript']))
                        <div class="divider">Manuscript</div>
                        <article class="prose prose-lg max-w-none">{!! $s['manuscript'] !!}</article>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">
                    {{-- More from Series --}}
                    @if($seriesData && !empty($related))
                        <div class="card bg-base-100 shadow">
                            <div class="card-body">
                                <h3 class="card-title text-lg">
                                    <a href="/sermons/series/{{ $seriesData['slug'] }}" class="hover:text-primary transition-colors">More from this series</a>
                                </h3>
                                <ul class="space-y-3">
                                    @foreach($related as $rel)
                                        <li>
                                            <a href="{{ $rel['url'] ?? '#' }}" class="flex items-start gap-3 group hover:bg-base-200 p-2 -mx-2 rounded-lg transition-colors">
                                                <div class="flex-1 min-w-0">
                                                    <p class="font-medium text-base-content group-hover:text-primary truncate">{{ $rel['title'] }}</p>
                                                    <p class="text-sm text-base-content/60">
                                                        {{ $rel['date'] ?? '' }}
                                                        @if(!empty($rel['scriptures']))
                                                            &middot; {{ implode(', ', $rel['scriptures']) }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-base-content/40 group-hover:text-primary flex-shrink-0 mt-0.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                                </svg>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    {{-- Speaker Card --}}
                    @if($speaker)
                        <a href="/sermons/speakers/{{ $speaker['slug'] }}" class="card bg-base-100 shadow hover:shadow-lg transition-shadow block group">
                            <div class="card-body">
                                <div class="flex items-center gap-4">
                                    @if(!empty($speaker['thumbnail']))
                                        <div class="avatar">
                                            <div class="w-16 rounded-full">
                                                <img src="{{ $speaker['thumbnail'] }}" alt="{{ $speaker['name'] }}" />
                                            </div>
                                        </div>
                                    @else
                                        <div class="avatar avatar-placeholder">
                                            <div class="bg-primary text-primary-content rounded-full w-16">
                                                <span class="text-xl">{{ substr($speaker['name'], 0, 1) }}</span>
                                            </div>
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="font-bold text-base-content group-hover:text-primary transition-colors">{{ $speaker['name'] }}</h3>
                                        @if(!empty($speaker['position']))
                                            <p class="text-sm text-base-content/60">{{ $speaker['position'] }}</p>
                                        @endif
                                    </div>
                                </div>
                                @if(!empty($speaker['bio']))
                                    <p class="text-sm text-base-content/70 mt-3 line-clamp-3">{{ strip_tags($speaker['bio']) }}</p>
                                @endif
                            </div>
                        </a>
                    @endif

                    {{-- Back to Sermons --}}
                    <a href="/sermons" class="btn btn-ghost gap-2 w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        All Sermons
                    </a>
                </div>
            </div>
        </div>
    </main>

    @include('themes::components.default.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.default.footer', $__data)
</div>
