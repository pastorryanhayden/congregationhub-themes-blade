@props([
    'siteName' => 'Your Church',
    'showMinistries' => false,
    'showEvents' => false,
    'showSermons' => false,
    'showGospel' => false,
    'showDoctrine' => false,
    'showConstitution' => false,
    'showLeadership' => false,
    'aboutUsPages' => [],
    'resourcesPages' => [],
    'hasBlogPosts' => false,
    'documentLinks' => [],
])

{{-- Full-screen overlay menu --}}
<div x-show="menuOpen" x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 scale-95"
     x-transition:enter-end="opacity-100 scale-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 scale-100"
     x-transition:leave-end="opacity-0 scale-95"
     class="fixed inset-0 z-[60] bg-neutral text-neutral-content overflow-y-auto"
     x-effect="document.body.style.overflow = menuOpen ? 'hidden' : ''">

    {{-- Close bar --}}
    <div class="flex items-center justify-between max-w-7xl mx-auto px-6 lg:px-8 py-5">
        <a href="/" class="text-lg font-serif font-bold tracking-wide text-neutral-content">{{ $siteName }}</a>
        <button @click="menuOpen = false" class="inline-flex items-center gap-2 text-sm font-bold tracking-widest uppercase text-neutral-content">
            Close
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Menu content --}}
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12 sm:py-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12 lg:gap-16">
            {{-- Column 1: About Us --}}
            <div>
                <h3 class="text-sm font-bold uppercase tracking-widest text-neutral-content/50 mb-6">About Us</h3>
                <ul class="space-y-4">
                    <li>
                        <a href="/about" @click="menuOpen = false" class="text-2xl sm:text-3xl font-serif hover:text-primary transition-colors">Plan Your Visit</a>
                    </li>
                    @if($showLeadership)
                        <li>
                            <a href="/leadership" @click="menuOpen = false" class="text-2xl sm:text-3xl font-serif hover:text-primary transition-colors">Leadership</a>
                        </li>
                    @endif
                    @if($showGospel)
                        <li>
                            <a href="{{ $documentLinks['gospel'] ?? '/gospel' }}" {{ isset($documentLinks['gospel']) ? 'target="_blank" rel="noopener"' : '' }} @click="menuOpen = false" class="text-2xl sm:text-3xl font-serif hover:text-primary transition-colors">
                                The Gospel
                                @if(isset($documentLinks['gospel']))
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-5 h-5 ml-1 -mt-1"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                @endif
                            </a>
                        </li>
                    @endif
                    @if($showDoctrine)
                        <li>
                            <a href="{{ $documentLinks['doctrine'] ?? '/doctrine' }}" {{ isset($documentLinks['doctrine']) ? 'target="_blank" rel="noopener"' : '' }} @click="menuOpen = false" class="text-2xl sm:text-3xl font-serif hover:text-primary transition-colors">
                                Statement of Faith
                                @if(isset($documentLinks['doctrine']))
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-5 h-5 ml-1 -mt-1"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                @endif
                            </a>
                        </li>
                    @endif
                    @if($showConstitution)
                        <li>
                            <a href="{{ $documentLinks['constitution'] ?? '/constitution' }}" {{ isset($documentLinks['constitution']) ? 'target="_blank" rel="noopener"' : '' }} @click="menuOpen = false" class="text-2xl sm:text-3xl font-serif hover:text-primary transition-colors">
                                Constitution &amp; Bylaws
                                @if(isset($documentLinks['constitution']))
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-5 h-5 ml-1 -mt-1"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                                @endif
                            </a>
                        </li>
                    @endif
                    @foreach($aboutUsPages as $page)
                        <li>
                            <a href="{{ $page['url'] ?? '#' }}" @click="menuOpen = false" class="text-2xl sm:text-3xl font-serif hover:text-primary transition-colors">{{ $page['label'] ?? $page['title'] ?? '' }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Column 2: Resources --}}
            <div>
                <h3 class="text-sm font-bold uppercase tracking-widest text-neutral-content/50 mb-6">Resources</h3>
                <ul class="space-y-4">
                    @if($showSermons)
                        <li>
                            <a href="/sermons" @click="menuOpen = false" class="text-2xl sm:text-3xl font-serif hover:text-primary transition-colors">Sermons</a>
                        </li>
                    @endif
                    @if($hasBlogPosts)
                        <li>
                            <a href="/blog" @click="menuOpen = false" class="text-2xl sm:text-3xl font-serif hover:text-primary transition-colors">Articles</a>
                        </li>
                    @endif
                    @foreach($resourcesPages as $page)
                        <li>
                            <a href="{{ $page['url'] ?? '#' }}" @click="menuOpen = false" class="text-2xl sm:text-3xl font-serif hover:text-primary transition-colors">{{ $page['label'] ?? $page['title'] ?? '' }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Column 3: Connect --}}
            <div>
                <h3 class="text-sm font-bold uppercase tracking-widest text-neutral-content/50 mb-6">Connect</h3>
                <ul class="space-y-4">
                    @if($showEvents)
                        <li>
                            <a href="/events" @click="menuOpen = false" class="text-2xl sm:text-3xl font-serif hover:text-primary transition-colors">Events</a>
                        </li>
                    @endif
                    @if($showMinistries)
                        <li>
                            <a href="/ministries" @click="menuOpen = false" class="text-2xl sm:text-3xl font-serif hover:text-primary transition-colors">Ministries</a>
                        </li>
                    @endif
                    <li>
                        <a href="/about" @click="menuOpen = false" class="text-2xl sm:text-3xl font-serif hover:text-primary transition-colors">Visit Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
