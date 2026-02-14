@props([
    'showMinistries' => true,
    'ministries' => [],
])

@if($showMinistries && count($ministries) > 0)
    <div class="bg-neutral text-neutral-content w-full text-center pt-8 px-8">
        <h2 class="font-sans uppercase font-bold text-3xl mb-4">Something for You and Your Family</h2>
        <a class="mb-4 inline-flex items-center" href="/ministries">
            See All Ministries
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 w-6 inline ml-1">
                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
            </svg>
        </a>
        <div class="ministry-grid grid mt-12 mx-auto pb-8">
            @foreach($ministries as $index => $ministry)
                <article
                    class="flex h-48 mb-8 {{ $index % 2 === 1 ? 'flex-row-reverse' : '' }} {{ $index < 2 ? 'lg:flex-row' : 'lg:flex-row-reverse' }}"
                >
                    @if(!empty($ministry['image']))
                        <img src="{{ $ministry['image'] }}" alt="{{ $ministry['name'] ?? '' }}" class="object-cover w-1/2" />
                    @else
                        <div class="w-1/2 bg-base-300 flex items-center justify-center">
                            <svg class="size-12 text-base-content/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z" />
                            </svg>
                        </div>
                    @endif
                    <div class="bg-base-100 text-base-content w-1/2 flex flex-col items-start justify-center p-4 text-left hover:bg-base-200">
                        <h4 class="font-sans text-base-content/40 uppercase">{{ $ministry['for'] ?? '' }}</h4>
                        <h3 class="font-sans font-bold text-2xl text-base-content/70">{{ $ministry['name'] ?? '' }}</h3>
                        <a class="uppercase font-sans text-base-content/40 inline-flex items-center" href="{{ $ministry['url'] ?? '#' }}">
                            Learn More
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4 inline ml-1">
                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>

    <style>
        .ministry-grid { width: 100%; }
        @media screen and (min-width: 1024px) {
            .ministry-grid { width: 90%; grid-template-columns: 50% 50%; grid-template-rows: 12rem 12rem; }
        }
        @media screen and (min-width: 1280px) {
            .ministry-grid { width: 60%; }
        }
    </style>
@endif
