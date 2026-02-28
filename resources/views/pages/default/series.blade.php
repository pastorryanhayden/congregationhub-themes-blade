@php
    $s = $series ?? [];
    $items = $sermons ?? [];
    $title = $s['title'] ?? 'Series';
@endphp

<div class="min-h-screen bg-base-100" data-theme="corporate">
    @include('themes::components.default.navbar', $__data)

    <main>
        @include('themes::components.default.dark-hero', [
            'heading' => $title,
            'image' => $s['image'] ?? null,
        ])

        @include('themes::components.default.breadcrumb', [
            'parent' => 'Sermon Series',
            'current' => $title,
        ])

        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-12">
            {{-- Series Info --}}
            <div class="mb-8">
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <h1 class="text-3xl font-bold">{{ $title }}</h1>
                    @if(!empty($s['featured']))
                        <span class="badge badge-primary">Featured</span>
                    @endif
                    @if(!empty($s['completed']))
                        <span class="badge badge-ghost">Complete</span>
                    @endif
                </div>

                @if(!empty($s['description']))
                    <p class="text-lg text-base-content/70 mb-4">{{ strip_tags($s['description']) }}</p>
                @endif

                <div class="flex flex-wrap gap-4 text-sm text-base-content/60">
                    <span>{{ $s['sermonCount'] ?? 0 }} {{ Str::plural('sermon', $s['sermonCount'] ?? 0) }}</span>
                    @if(!empty($s['primarySpeaker']))
                        <span>&middot;</span>
                        <a href="/sermons/speakers/{{ $s['primarySpeaker']['slug'] }}" class="hover:text-primary transition-colors">
                            {{ $s['primarySpeaker']['name'] }}
                        </a>
                    @endif
                </div>
            </div>

            @if(!empty($s['body']))
                <div class="prose max-w-none mb-8">{!! $s['body'] !!}</div>
            @endif

            {{-- Sermons in Series --}}
            @if(!empty($items))
                <h2 class="text-xl font-bold mb-4">Sermons in this Series</h2>
                <div class="space-y-3">
                    @foreach($items as $index => $sermon)
                        <a href="{{ $sermon['url'] ?? '#' }}" class="flex items-start gap-4 group hover:bg-base-200 p-4 -mx-4 rounded-lg transition-colors">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center text-sm font-bold">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-base-content group-hover:text-primary">{{ $sermon['title'] ?? '' }}</p>
                                <div class="flex flex-wrap items-center gap-2 mt-1 text-sm text-base-content/60">
                                    @if(!empty($sermon['speaker']))
                                        <span>{{ $sermon['speaker']['name'] }}</span>
                                        <span>&middot;</span>
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
            @else
                <div class="text-center py-12 text-base-content/60">
                    <p>No sermons in this series yet.</p>
                </div>
            @endif

            <div class="mt-12 pt-8 border-t border-base-300 flex gap-3">
                <a href="/sermons/series" class="btn btn-ghost gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    All Series
                </a>
                <a href="/sermons" class="btn btn-ghost gap-2">All Sermons</a>
            </div>
        </div>
    </main>

    @include('themes::components.default.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.default.footer', $__data)
</div>
