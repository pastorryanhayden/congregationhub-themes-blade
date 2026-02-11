@props([
    'siteName' => 'Your Church',
    'navLogo' => null,
    'showMinistries' => false,
    'showEvents' => false,
    'showSermons' => false,
    'showGospel' => false,
    'showDoctrine' => false,
    'showConstitution' => false,
    'transparent' => false,
    'aboutUsPages' => [],
    'resourcesPages' => [],
    'hasBlogPosts' => false,
])

@php
    $resourceCount = ($showSermons ? 1 : 0) + ($hasBlogPosts ? 1 : 0) + count($resourcesPages);
    $hasMultipleResources = $resourceCount > 1;
@endphp

<header class="{{ $transparent ? 'absolute inset-x-0 top-0 z-50' : 'bg-base-100' }}"
        x-data="{ showMobileMenu: false, showAboutMenu: false, showResourcesMenu: false }">
    <nav class="flex gap-x-6 justify-between items-center p-6 mx-auto max-w-7xl lg:px-8" aria-label="Global">
        {{-- Logo --}}
        <div class="flex lg:flex-1">
            <a href="#" class="flex items-center gap-2 p-1.5 -m-1.5">
                @if($navLogo)
                    <img src="{{ $navLogo }}" alt="{{ $siteName }}" class="w-auto h-8" />
                @endif
                <span class="text-lg font-semibold uppercase {{ $transparent ? 'text-white' : '' }}">{{ $siteName }}</span>
            </a>
        </div>

        {{-- Desktop nav links --}}
        <div class="hidden lg:flex lg:gap-x-12 font-sans {{ $transparent ? 'text-white' : '' }}">
            {{-- About Us dropdown --}}
            <div class="relative" @mouseenter="showAboutMenu = true" @mouseleave="showAboutMenu = false">
                <button type="button"
                    class="flex items-center gap-x-1 text-sm font-semibold leading-6 {{ $transparent ? 'text-white' : '' }}">
                    About Us
                    <svg class="flex-none w-5 h-5 text-base-content/40" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div x-show="showAboutMenu" x-cloak
                    class="flex absolute left-1/2 z-10 px-4 mt-5 w-screen max-w-max -translate-x-1/2">
                    <div class="overflow-hidden flex-auto w-screen max-w-md text-sm leading-6 bg-base-100 rounded-3xl ring-1 shadow-lg ring-base-content/5">
                        <div class="p-4">
                            <div class="flex relative gap-x-6 p-4 rounded-lg hover:bg-base-200 group">
                                <div class="flex flex-none justify-center items-center mt-1 w-11 h-11 bg-base-200 rounded-lg group-hover:bg-base-100">
                                    <svg class="w-6 h-6 text-base-content/60 group-hover:text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                    </svg>
                                </div>
                                <div>
                                    <a href="#" class="font-semibold text-base-content">
                                        Start Here
                                        <span class="absolute inset-0"></span>
                                    </a>
                                    <p class="mt-1 text-base-content/60">Essential information to know before visiting our church.</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-8 bg-base-200">
                            <div class="flex justify-between">
                                <h3 class="text-sm font-semibold leading-6 text-base-content/50">Other Information</h3>
                                <a href="#" class="text-sm font-semibold leading-6 text-primary">See all <span aria-hidden="true">&rarr;</span></a>
                            </div>
                            <ul role="list" class="mt-6 space-y-6">
                                @if($showDoctrine)
                                    <li class="relative">
                                        <a href="#" class="block text-sm font-semibold leading-6 text-base-content truncate">
                                            What We Believe<span class="absolute inset-0"></span>
                                        </a>
                                    </li>
                                @endif
                                @if($showConstitution)
                                    <li class="relative">
                                        <a href="#" class="block text-sm font-semibold leading-6 text-base-content truncate">
                                            Constitution &amp; Bylaws<span class="absolute inset-0"></span>
                                        </a>
                                    </li>
                                @endif
                                @if($showGospel)
                                    <li class="relative">
                                        <a href="#" class="block text-sm font-semibold leading-6 text-base-content truncate">
                                            The Gospel<span class="absolute inset-0"></span>
                                        </a>
                                    </li>
                                @endif
                                @foreach($aboutUsPages as $page)
                                    <li class="relative">
                                        <a href="#" class="block text-sm font-semibold leading-6 text-base-content truncate">
                                            {{ $page['title'] ?? '' }}<span class="absolute inset-0"></span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ministries --}}
            @if($showMinistries)
                <a href="#" class="text-sm font-semibold leading-6 {{ $transparent ? 'text-white' : 'text-base-content' }}">Ministries</a>
            @endif

            {{-- Events --}}
            @if($showEvents)
                <a href="#" class="text-sm font-semibold leading-6 {{ $transparent ? 'text-white' : 'text-base-content' }}">Upcoming Events</a>
            @endif

            {{-- Resources dropdown (if multiple) --}}
            @if($hasMultipleResources)
                <div class="relative" @mouseenter="showResourcesMenu = true" @mouseleave="showResourcesMenu = false">
                    <button type="button"
                        class="flex items-center gap-x-1 text-sm font-semibold leading-6 {{ $transparent ? 'text-white' : '' }}">
                        Resources
                        <svg class="flex-none w-5 h-5 text-base-content/40" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="showResourcesMenu" x-cloak
                        class="overflow-hidden absolute -right-4 top-full z-10 mt-3 w-screen max-w-md bg-base-100 rounded-3xl ring-1 shadow-lg ring-base-content/5">
                        <div class="p-4">
                            @if($showSermons)
                                <div class="flex relative gap-x-6 items-center p-4 text-sm leading-6 rounded-lg hover:bg-base-200 group">
                                    <div class="flex flex-none justify-center items-center w-11 h-11 bg-base-200 rounded-lg group-hover:bg-base-100">
                                        <svg class="w-6 h-6 text-base-content/60 group-hover:text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
                                        </svg>
                                    </div>
                                    <div class="flex-auto">
                                        <a href="#" class="block font-semibold text-base-content">Sermons<span class="absolute inset-0"></span></a>
                                        <p class="mt-1 text-base-content/60">Listen to our sermons</p>
                                    </div>
                                </div>
                            @endif
                            @if($hasBlogPosts)
                                <div class="flex relative gap-x-6 items-center p-4 text-sm leading-6 rounded-lg hover:bg-base-200 group">
                                    <div class="flex flex-none justify-center items-center w-11 h-11 bg-base-200 rounded-lg group-hover:bg-base-100">
                                        <svg class="w-6 h-6 text-base-content/60 group-hover:text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                    </div>
                                    <div class="flex-auto">
                                        <a href="#" class="block font-semibold text-base-content">Articles<span class="absolute inset-0"></span></a>
                                        <p class="mt-1 text-base-content/60">Articles from our pastor and staff</p>
                                    </div>
                                </div>
                            @endif
                            @foreach($resourcesPages as $page)
                                <div class="flex relative gap-x-6 items-center p-4 text-sm leading-6 rounded-lg hover:bg-base-200 group">
                                    <div class="flex flex-none justify-center items-center w-11 h-11 bg-base-200 rounded-lg group-hover:bg-base-100">
                                        <svg class="w-6 h-6 text-base-content/60 group-hover:text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                    </div>
                                    <div class="flex-auto">
                                        <a href="#" class="block font-semibold text-base-content">{{ $page['title'] ?? '' }}<span class="absolute inset-0"></span></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                {{-- Flat links (if only one resource type) --}}
                @if($showSermons)
                    <a href="#" class="text-sm font-semibold leading-6 {{ $transparent ? 'text-white' : 'text-base-content' }}">Sermons</a>
                @endif
                @if($hasBlogPosts)
                    <a href="#" class="text-sm font-semibold leading-6 {{ $transparent ? 'text-white' : 'text-base-content' }}">Articles</a>
                @endif
                @foreach($resourcesPages as $page)
                    <a href="#" class="text-sm font-semibold leading-6 {{ $transparent ? 'text-white' : 'text-base-content' }}">{{ $page['title'] ?? '' }}</a>
                @endforeach
            @endif
        </div>

        {{-- Mobile hamburger button --}}
        <div class="flex lg:hidden">
            <button type="button"
                class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 {{ $transparent ? 'text-white' : 'text-base-content/70' }}"
                @click="showMobileMenu = !showMobileMenu">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
    </nav>

    {{-- Mobile menu slide-over --}}
    <div x-show="showMobileMenu" x-cloak class="lg:hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 z-10"></div>
        <div class="overflow-y-auto fixed inset-y-0 right-0 z-10 py-6 px-6 w-full bg-base-100 sm:max-w-sm sm:ring-1 sm:ring-base-content/10">
            <div class="flex gap-x-6 justify-end items-center">
                <button type="button" class="p-2.5 -m-2.5 text-base-content/70 rounded-md" @click="showMobileMenu = false">
                    <span class="sr-only">Close menu</span>
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flow-root mt-6">
                <div class="-my-6 divide-y divide-base-content/10">
                    <div class="py-6 space-y-2 font-sans">
                        <a href="#" class="block py-2 px-3 -mx-3 text-base font-semibold leading-7 text-base-content rounded-lg hover:bg-base-200">About Us</a>
                        @if($showDoctrine)
                            <a href="#" class="block py-2 px-8 -mx-3 text-base font-semibold leading-7 text-base-content/60 rounded-lg hover:bg-base-200">What We Believe</a>
                        @endif
                        @if($showConstitution)
                            <a href="#" class="block py-2 px-8 -mx-3 text-base font-semibold leading-7 text-base-content/60 rounded-lg hover:bg-base-200">Constitution &amp; Bylaws</a>
                        @endif
                        @if($showGospel)
                            <a href="#" class="block py-2 px-8 -mx-3 text-base font-semibold leading-7 text-base-content/60 rounded-lg hover:bg-base-200">The Gospel</a>
                        @endif
                        @foreach($aboutUsPages as $page)
                            <a href="#" class="block py-2 px-8 -mx-3 text-base font-semibold leading-7 text-base-content/60 rounded-lg hover:bg-base-200">{{ $page['title'] ?? '' }}</a>
                        @endforeach
                        @if($showMinistries)
                            <a href="#" class="block py-2 px-3 -mx-3 text-base font-semibold leading-7 text-base-content rounded-lg hover:bg-base-200">Ministries</a>
                        @endif
                        @if($showEvents)
                            <a href="#" class="block py-2 px-3 -mx-3 text-base font-semibold leading-7 text-base-content rounded-lg hover:bg-base-200">Upcoming Events</a>
                        @endif
                        @if($showSermons)
                            <a href="#" class="block py-2 px-3 -mx-3 text-base font-semibold leading-7 text-base-content rounded-lg hover:bg-base-200">Sermons</a>
                        @endif
                        @if($hasBlogPosts)
                            <a href="#" class="block py-2 px-3 -mx-3 text-base font-semibold leading-7 text-base-content rounded-lg hover:bg-base-200">Articles</a>
                        @endif
                        @foreach($resourcesPages as $page)
                            <a href="#" class="block py-2 px-3 -mx-3 text-base font-semibold leading-7 text-base-content rounded-lg hover:bg-base-200">{{ $page['title'] ?? '' }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
