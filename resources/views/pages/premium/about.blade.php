@php
    $heading = $aboutHeading ?? 'About Us';
    $subheading = $aboutSubheading ?? '';
    $image = $aboutImage ?? null;
    $sections = $aboutSections ?? [];

    function slugify($text) {
        return \Illuminate\Support\Str::slug($text);
    }
@endphp

<div class="min-h-screen bg-base-200" data-theme="corporate" x-data="{ menuOpen: false }">
    @include('themes::components.premium.navbar', $__data)
    @include('themes::components.premium.mega-menu', $__data)

    <main>
        {{-- Hero Section --}}
        <section class="bg-base-200 px-4 sm:px-6 py-6">
            <div class="bg-neutral text-neutral-content rounded-3xl overflow-hidden relative">
                @if($image)
                    <img src="{{ $image }}" alt="" class="absolute inset-0 h-full w-full object-cover" />
                    <div class="absolute inset-0 bg-neutral/80"></div>
                @endif

                <div class="relative max-w-7xl mx-auto px-6 lg:px-8 py-20 sm:py-28">
                    <div class="max-w-2xl">
                        <h1 class="text-4xl sm:text-6xl font-serif font-bold tracking-tight">{{ $heading }}</h1>
                        @if($subheading)
                            <p class="mt-6 text-lg leading-8 text-neutral-content/70">{{ $subheading }}</p>
                        @endif
                    </div>

                    @if(count($sections) > 0)
                        <div class="mt-12 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($sections as $section)
                                <a href="#{{ slugify($section['title'] ?? '') }}"
                                   class="group rounded-2xl bg-white/5 p-6 ring-1 ring-white/10 hover:bg-white/10 transition">
                                    @if(!empty($section['icon']))
                                        <div class="mb-4 text-neutral-content/60 group-hover:text-neutral-content transition">
                                            <i class="{{ $section['icon'] }}" style="font-size: 32px;"></i>
                                        </div>
                                    @endif
                                    <h3 class="text-lg font-serif font-semibold">{{ $section['title'] ?? '' }}</h3>
                                    @if(!empty($section['description']))
                                        <p class="mt-2 text-sm text-neutral-content/60">{{ $section['description'] }}</p>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>

        {{-- Content Sections --}}
        @if(count($sections) === 0)
            <section class="bg-base-200 py-20 sm:py-28">
                <div class="text-center text-base-content/40">
                    <p>Add sections to tell your church's story.</p>
                </div>
            </section>
        @else
            @foreach($sections as $index => $section)
                <section id="{{ slugify($section['title'] ?? '') }}" class="bg-base-200 py-16 sm:py-20">
                    <div class="max-w-3xl mx-auto px-6 lg:px-8">
                        @if(!empty($section['title']))
                            <p class="text-sm font-medium uppercase tracking-wider text-base-content/40">{{ $section['title'] }}</p>
                        @endif
                        @if(!empty($section['section_heading']))
                            <h2 class="mt-2 text-3xl font-serif font-bold tracking-tight sm:text-4xl">{{ $section['section_heading'] }}</h2>
                        @endif
                        @if(!empty($section['content']))
                            <div class="mt-8 prose prose-lg max-w-none">{!! $section['content'] !!}</div>
                        @endif
                    </div>
                    @if($index < count($sections) - 1)
                        <hr class="border-base-300 mx-auto max-w-3xl mt-16" />
                    @endif
                </section>
            @endforeach
        @endif
    </main>

    @include('themes::components.premium.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.premium.footer', $__data)
</div>
