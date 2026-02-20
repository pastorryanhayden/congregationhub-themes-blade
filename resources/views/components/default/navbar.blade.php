@props([
    'siteName' => 'Your Church',
    'navLogoLight' => null,
    'navLogoDark' => null,
    'showMinistries' => false,
    'showEvents' => false,
    'showSermons' => false,
    'showGospel' => false,
    'showDoctrine' => false,
    'showConstitution' => false,
    'showLeadership' => false,
    'transparent' => false,
    'aboutUsPages' => [],
    'resourcesPages' => [],
    'hasBlogPosts' => false,
    'documentLinks' => [],
])

@php
    $resourceCount = ($showSermons ? 1 : 0) + ($hasBlogPosts ? 1 : 0) + count($resourcesPages);
    $hasMultipleResources = $resourceCount > 1;
    $activeLogo = $transparent ? $navLogoLight : $navLogoDark;
@endphp

<header class="{{ $transparent ? 'absolute inset-x-0 top-0 z-50' : 'bg-base-100' }}"
        x-data="{ showMobileMenu: false, showAboutMenu: false, showResourcesMenu: false }">
    <nav class="flex gap-x-6 justify-between items-center p-6 mx-auto max-w-7xl lg:px-8" aria-label="Global">
        {{-- Logo --}}
        <div class="flex lg:flex-1">
            <a href="/" class="flex items-center gap-2 p-1.5 -m-1.5">
                @if($activeLogo)
                    <img src="{{ $activeLogo }}" alt="{{ $siteName }}" class="w-auto h-8" />
                @else
                    <span class="text-lg font-semibold uppercase {{ $transparent ? 'text-white' : '' }}">{{ $siteName }}</span>
                @endif
            </a>
        </div>

        {{-- Desktop nav links --}}
        <div class="hidden lg:flex lg:gap-x-12 font-sans {{ $transparent ? 'text-white' : '' }}">
            {{-- About Us dropdown --}}
            <div class="relative" @click.outside="showAboutMenu = false">
                <button type="button"
                    @click="showAboutMenu = !showAboutMenu; showResourcesMenu = false"
                    class="flex items-center gap-x-1 text-sm font-semibold leading-6 {{ $transparent ? 'text-white' : '' }}">
                    About Us
                    <svg class="flex-none w-5 h-5 text-base-content/40 transition-transform" :class="showAboutMenu && 'rotate-180'" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
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
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                </div>
                                <div>
                                    <a href="/about" class="font-semibold text-base-content">
                                        Plan Your Visit
                                        <span class="absolute inset-0"></span>
                                    </a>
                                    <p class="mt-1 text-base-content/60">Everything you need to know before visiting.</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-8 bg-base-200">
                            <ul role="list" class="space-y-6">
                                @if($showLeadership)
                                    <li class="relative">
                                        <a href="/leadership" class="block text-sm font-semibold leading-6 text-base-content truncate">
                                            Leadership<span class="absolute inset-0"></span>
                                        </a>
                                    </li>
                                @endif
                                @if($showGospel)
                                    <li class="relative">
                                        <a href="{{ $documentLinks['gospel'] ?? '/gospel' }}" {{ isset($documentLinks['gospel']) ? 'target="_blank" rel="noopener"' : '' }} class="block text-sm font-semibold leading-6 text-base-content truncate">
                                            The Gospel
                                            @if(isset($documentLinks['gospel']))
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-3.5 h-3.5 ml-1 -mt-0.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                            @endif
                                            <span class="absolute inset-0"></span>
                                        </a>
                                    </li>
                                @endif
                                @if($showDoctrine)
                                    <li class="relative">
                                        <a href="{{ $documentLinks['doctrine'] ?? '/doctrine' }}" {{ isset($documentLinks['doctrine']) ? 'target="_blank" rel="noopener"' : '' }} class="block text-sm font-semibold leading-6 text-base-content truncate">
                                            Statement of Faith
                                            @if(isset($documentLinks['doctrine']))
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-3.5 h-3.5 ml-1 -mt-0.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                            @endif
                                            <span class="absolute inset-0"></span>
                                        </a>
                                    </li>
                                @endif
                                @if($showConstitution)
                                    <li class="relative">
                                        <a href="{{ $documentLinks['constitution'] ?? '/constitution' }}" {{ isset($documentLinks['constitution']) ? 'target="_blank" rel="noopener"' : '' }} class="block text-sm font-semibold leading-6 text-base-content truncate">
                                            Constitution &amp; Bylaws
                                            @if(isset($documentLinks['constitution']))
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-3.5 h-3.5 ml-1 -mt-0.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                            @endif
                                            <span class="absolute inset-0"></span>
                                        </a>
                                    </li>
                                @endif
                                @foreach($aboutUsPages as $page)
                                    <li class="relative">
                                        <a href="{{ $page['url'] ?? '#' }}" class="block text-sm font-semibold leading-6 text-base-content truncate">
                                            {{ $page['label'] ?? $page['title'] ?? '' }}<span class="absolute inset-0"></span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Events --}}
            @if($showEvents)
                <a href="/events" class="text-sm font-semibold leading-6 {{ $transparent ? 'text-white' : 'text-base-content' }}">Events</a>
            @endif

            {{-- Ministries --}}
            @if($showMinistries)
                <a href="/ministries" class="text-sm font-semibold leading-6 {{ $transparent ? 'text-white' : 'text-base-content' }}">Ministries</a>
            @endif

            {{-- Resources dropdown (if multiple) --}}
            @if($hasMultipleResources)
                <div class="relative" @click.outside="showResourcesMenu = false">
                    <button type="button"
                        @click="showResourcesMenu = !showResourcesMenu; showAboutMenu = false"
                        class="flex items-center gap-x-1 text-sm font-semibold leading-6 {{ $transparent ? 'text-white' : '' }}">
                        Resources
                        <svg class="flex-none w-5 h-5 text-base-content/40 transition-transform" :class="showResourcesMenu && 'rotate-180'" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
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
                                        <a href="/sermons" class="block font-semibold text-base-content">Sermons<span class="absolute inset-0"></span></a>
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
                                        <a href="/blog" class="block font-semibold text-base-content">Articles<span class="absolute inset-0"></span></a>
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
                                        <a href="{{ $page['url'] ?? '#' }}" class="block font-semibold text-base-content">{{ $page['label'] ?? $page['title'] ?? '' }}<span class="absolute inset-0"></span></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                {{-- Flat links (if only one resource type) --}}
                @if($showSermons)
                    <a href="/sermons" class="text-sm font-semibold leading-6 {{ $transparent ? 'text-white' : 'text-base-content' }}">Sermons</a>
                @endif
                @if($hasBlogPosts)
                    <a href="/blog" class="text-sm font-semibold leading-6 {{ $transparent ? 'text-white' : 'text-base-content' }}">Articles</a>
                @endif
                @foreach($resourcesPages as $page)
                    <a href="{{ $page['url'] ?? '#' }}" class="text-sm font-semibold leading-6 {{ $transparent ? 'text-white' : 'text-base-content' }}">{{ $page['label'] ?? $page['title'] ?? '' }}</a>
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
                        <a href="/about" class="block py-2 px-3 -mx-3 text-base font-semibold leading-7 text-base-content rounded-lg hover:bg-base-200">Plan Your Visit</a>
                        @if($showLeadership)
                            <a href="/leadership" class="block py-2 px-8 -mx-3 text-base font-semibold leading-7 text-base-content/60 rounded-lg hover:bg-base-200">Leadership</a>
                        @endif
                        @if($showGospel)
                            <a href="{{ $documentLinks['gospel'] ?? '/gospel' }}" {{ isset($documentLinks['gospel']) ? 'target="_blank" rel="noopener"' : '' }} class="block py-2 px-8 -mx-3 text-base font-semibold leading-7 text-base-content/60 rounded-lg hover:bg-base-200">
                                The Gospel
                                @if(isset($documentLinks['gospel']))
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-4 h-4 ml-1 -mt-0.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                @endif
                            </a>
                        @endif
                        @if($showDoctrine)
                            <a href="{{ $documentLinks['doctrine'] ?? '/doctrine' }}" {{ isset($documentLinks['doctrine']) ? 'target="_blank" rel="noopener"' : '' }} class="block py-2 px-8 -mx-3 text-base font-semibold leading-7 text-base-content/60 rounded-lg hover:bg-base-200">
                                Statement of Faith
                                @if(isset($documentLinks['doctrine']))
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-4 h-4 ml-1 -mt-0.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                @endif
                            </a>
                        @endif
                        @if($showConstitution)
                            <a href="{{ $documentLinks['constitution'] ?? '/constitution' }}" {{ isset($documentLinks['constitution']) ? 'target="_blank" rel="noopener"' : '' }} class="block py-2 px-8 -mx-3 text-base font-semibold leading-7 text-base-content/60 rounded-lg hover:bg-base-200">
                                Constitution &amp; Bylaws
                                @if(isset($documentLinks['constitution']))
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-4 h-4 ml-1 -mt-0.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                @endif
                            </a>
                        @endif
                        @foreach($aboutUsPages as $page)
                            <a href="{{ $page['url'] ?? '#' }}" class="block py-2 px-8 -mx-3 text-base font-semibold leading-7 text-base-content/60 rounded-lg hover:bg-base-200">{{ $page['label'] ?? $page['title'] ?? '' }}</a>
                        @endforeach
                        @if($showEvents)
                            <a href="/events" class="block py-2 px-3 -mx-3 text-base font-semibold leading-7 text-base-content rounded-lg hover:bg-base-200">Events</a>
                        @endif
                        @if($showMinistries)
                            <a href="/ministries" class="block py-2 px-3 -mx-3 text-base font-semibold leading-7 text-base-content rounded-lg hover:bg-base-200">Ministries</a>
                        @endif
                        @if($showSermons)
                            <a href="/sermons" class="block py-2 px-3 -mx-3 text-base font-semibold leading-7 text-base-content rounded-lg hover:bg-base-200">Sermons</a>
                        @endif
                        @if($hasBlogPosts)
                            <a href="/blog" class="block py-2 px-3 -mx-3 text-base font-semibold leading-7 text-base-content rounded-lg hover:bg-base-200">Articles</a>
                        @endif
                        @foreach($resourcesPages as $page)
                            <a href="{{ $page['url'] ?? '#' }}" class="block py-2 px-3 -mx-3 text-base font-semibold leading-7 text-base-content rounded-lg hover:bg-base-200">{{ $page['label'] ?? $page['title'] ?? '' }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
