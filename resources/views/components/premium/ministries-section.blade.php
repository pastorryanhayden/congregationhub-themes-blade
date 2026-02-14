@props([
    'showMinistries' => true,
    'ministries' => [],
])

@if($showMinistries && count($ministries) > 0)
    <section class="bg-base-200 px-4 sm:px-6 py-6">
        <div class="bg-neutral text-neutral-content rounded-3xl overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 sm:py-28">
                <div class="text-center mb-12">
                    <h2 class="text-3xl sm:text-4xl font-serif font-bold">Something for You and Your Family</h2>
                    <a class="mt-4 inline-flex items-center text-neutral-content/70 hover:text-neutral-content transition-colors" href="/ministries">
                        See All Ministries
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 ml-1">
                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($ministries as $index => $ministry)
                        <div class="flex h-48 rounded-2xl overflow-hidden {{ $index % 2 === 1 ? 'flex-row-reverse' : '' }}">
                            @if(!empty($ministry['image']))
                                <img src="{{ $ministry['image'] }}" alt="{{ $ministry['name'] ?? '' }}" class="object-cover w-1/2" />
                            @else
                                <div class="w-1/2 bg-base-300 flex items-center justify-center">
                                    <svg class="size-12 text-base-content/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 21h16.5A2.25 2.25 0 0 0 22.5 18.75V5.25A2.25 2.25 0 0 0 20.25 3H3.75A2.25 2.25 0 0 0 1.5 5.25v13.5A2.25 2.25 0 0 0 3.75 21Z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="bg-base-100 text-base-content w-1/2 flex flex-col items-start justify-center p-5 hover:bg-base-200 transition-colors">
                                <h4 class="font-sans text-base-content/40 uppercase text-sm">{{ $ministry['for'] ?? '' }}</h4>
                                <h3 class="font-sans font-bold text-xl sm:text-2xl text-base-content/80 mt-1">{{ $ministry['name'] ?? '' }}</h3>
                                <a class="uppercase font-sans text-base-content/40 text-sm inline-flex items-center mt-2 hover:text-primary transition-colors" href="{{ $ministry['url'] ?? '#' }}">
                                    Learn More
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4 inline ml-1">
                                        <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
