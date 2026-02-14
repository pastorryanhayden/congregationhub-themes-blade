@props([
    'siteName' => 'Your Church',
    'navLogo' => null,
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
    $hasAbout = $showLeadership || $showGospel || $showDoctrine || $showConstitution || count($aboutUsPages) > 0;
    $hasResources = $showSermons || $hasBlogPosts || count($resourcesPages) > 0;
@endphp

<header class="{{ $transparent ? 'absolute inset-x-0 top-0 z-50' : 'bg-base-100 border-b border-base-300' }}">
    <nav class="flex items-center justify-between max-w-7xl mx-auto px-6 lg:px-8 py-5" aria-label="Global">
        {{-- Logo --}}
        <div class="flex-1">
            <a href="/" class="flex items-center gap-2">
                @if($navLogo)
                    <img src="{{ $navLogo }}" alt="{{ $siteName }}" class="w-auto h-8" />
                @endif
                <span class="text-lg font-serif font-bold tracking-wide {{ $transparent ? 'text-white' : 'text-base-content' }}">{{ $siteName }}</span>
            </a>
        </div>

        {{-- Center inline links (desktop) --}}
        <div class="hidden lg:flex lg:items-center lg:gap-x-10">
            <a href="/about" class="text-sm font-semibold {{ $transparent ? 'text-white/90 hover:text-white' : 'text-base-content/70 hover:text-base-content' }} transition-colors">About</a>
            @if($showEvents)
                <a href="/events" class="text-sm font-semibold {{ $transparent ? 'text-white/90 hover:text-white' : 'text-base-content/70 hover:text-base-content' }} transition-colors">Events</a>
            @endif
            @if($showSermons)
                <a href="/sermons" class="text-sm font-semibold {{ $transparent ? 'text-white/90 hover:text-white' : 'text-base-content/70 hover:text-base-content' }} transition-colors">Sermons</a>
            @endif
            @if($showMinistries)
                <a href="/ministries" class="text-sm font-semibold {{ $transparent ? 'text-white/90 hover:text-white' : 'text-base-content/70 hover:text-base-content' }} transition-colors">Ministries</a>
            @endif
        </div>

        {{-- Right side: Visit CTA + MENU button --}}
        <div class="flex items-center gap-4 flex-1 justify-end">
            <a href="/about" class="hidden lg:inline-flex btn btn-sm {{ $transparent ? 'btn-outline border-white text-white hover:bg-white hover:text-base-content' : 'btn-primary' }}">
                Plan Your Visit
            </a>
            <button type="button"
                @click="menuOpen = true"
                class="inline-flex items-center gap-2 text-sm font-bold tracking-widest uppercase {{ $transparent ? 'text-white' : 'text-base-content' }}">
                Menu
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
    </nav>
</header>
