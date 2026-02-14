@props([
    'actionLinks' => [],
])

@php
    $links = collect($actionLinks)->filter(fn($l) => !empty($l['title']));
    if ($links->isEmpty()) {
        $links = collect([
            ['title' => 'Plan Your Visit', 'subtitle' => 'Learn About Our Church'],
            ['title' => 'Watch Live', 'subtitle' => 'View our Services'],
            ['title' => 'Give Online', 'subtitle' => 'For Members'],
        ]);
    }
@endphp

@if($links->isNotEmpty())
    <section class="bg-base-200 py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-4">
                @foreach($links as $action)
                    <a href="{{ $action['url'] ?? '#' }}" @if(!empty($action['external'])) target="_blank" rel="noopener noreferrer" @endif
                       class="btn btn-lg btn-neutral rounded-full px-8 font-sans text-sm uppercase tracking-wider">
                        {{ $action['title'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif
