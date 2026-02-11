@props([
    'showEvents' => true,
    'events' => [],
])

@php
    $event = !empty($events) ? $events[0] : null;
@endphp

@if($showEvents && $event)
    <div>
        <div class="w-full bg-base-content/60 p-12 flex flex-col justify-center items-center">
            <a href="#"><h2 class="text-white font-serif text-3xl">{{ $event['title'] ?? '' }}</h2></a>
            <p class="text-white/70 font-sans text-lg mt-2">{{ $event['date'] ?? '' }}</p>
            @if(!empty($event['image']))
                <a href="#"><img class="w-96 mt-4 border border-base-content/80" src="{{ $event['image'] }}" alt="{{ $event['title'] ?? '' }}" /></a>
            @endif
            <a href="#" class="mt-4 text-white/80 underline">Learn More</a>
        </div>
    </div>
@endif
