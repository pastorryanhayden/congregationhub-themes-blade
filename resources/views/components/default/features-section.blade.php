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

    $count = $links->count();
    $gridCols = match(true) {
        $count <= 1 => 'lg:grid-cols-1',
        $count === 2 => 'lg:grid-cols-2',
        $count === 3 => 'lg:grid-cols-3',
        default => 'lg:grid-cols-4',
    };
@endphp

@if($links->isNotEmpty())
    <div class="w-full bg-base-100 grid divide-y lg:divide-y-0 lg:divide-x divide-base-300 {{ $gridCols }}">
        @foreach($links as $action)
            <a href="{{ $action['url'] ?? '#' }}" @if(!empty($action['external'])) target="_blank" rel="noopener noreferrer" @endif class="flex flex-col items-center justify-center py-8 hover:bg-base-200 transition-colors">
                <span class="font-sans text-base-content/40 text-sm">{{ $action['subtitle'] ?? '' }}</span>
                <h3 class="text-xl uppercase text-base-content/70">{{ $action['title'] }}</h3>
            </a>
        @endforeach
    </div>
@endif
