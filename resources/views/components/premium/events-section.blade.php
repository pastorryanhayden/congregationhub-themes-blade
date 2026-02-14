@props([
    'showEvents' => true,
    'events' => [],
])

@php
    $event = !empty($events) ? $events[0] : null;
@endphp

@if($showEvents && $event)
    <section class="bg-base-200 px-4 sm:px-6 py-6">
        <div class="bg-neutral text-neutral-content rounded-3xl overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 sm:py-28">
                <div class="flex flex-col items-center text-center">
                    <p class="text-sm font-bold uppercase tracking-widest text-neutral-content/50 mb-4">Upcoming Event</p>
                    <a href="#"><h2 class="text-3xl sm:text-4xl font-serif font-bold">{{ $event['title'] ?? '' }}</h2></a>
                    <p class="text-neutral-content/70 font-sans text-lg mt-3">{{ $event['date'] ?? '' }}</p>
                    @if(!empty($event['image']))
                        <a href="#"><img class="max-w-md w-full mt-8 rounded-2xl" src="{{ $event['image'] }}" alt="{{ $event['title'] ?? '' }}" /></a>
                    @endif
                    <a href="#" class="mt-6 btn btn-outline btn-sm border-neutral-content/30 text-neutral-content hover:bg-neutral-content hover:text-neutral rounded-full px-6">Learn More</a>
                </div>
            </div>
        </div>
    </section>
@endif
