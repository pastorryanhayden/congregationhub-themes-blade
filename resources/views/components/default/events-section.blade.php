@props([
    'showEvents' => true,
    'events' => [],
])

@php
    $event = !empty($events) ? $events[0] : null;
@endphp

@if($showEvents && $event)
    <div>
        <div class="w-full bg-neutral text-neutral-content p-12 flex flex-col justify-center items-center">
            @if(!empty($event['url']))
                <a href="{{ $event['url'] }}"><h2 class="text-neutral-content font-serif text-3xl">{{ $event['title'] ?? '' }}</h2></a>
            @else
                <h2 class="text-neutral-content font-serif text-3xl">{{ $event['title'] ?? '' }}</h2>
            @endif
            <p class="text-neutral-content/70 font-sans text-lg mt-2">{{ $event['date'] ?? '' }}</p>
            @if(!empty($event['image']))
                @if(!empty($event['url']))
                    <a href="{{ $event['url'] }}"><img class="w-96 mt-4 border border-neutral-content/20 rounded-lg" src="{{ $event['image'] }}" alt="{{ $event['title'] ?? '' }}" /></a>
                @else
                    <img class="w-96 mt-4 border border-neutral-content/20 rounded-lg" src="{{ $event['image'] }}" alt="{{ $event['title'] ?? '' }}" />
                @endif
            @endif
            @if(!empty($event['url']))
                <a href="{{ $event['url'] }}" class="mt-4 text-neutral-content/80 underline">{{ __('Learn More') }}</a>
            @endif
        </div>
    </div>
@endif
