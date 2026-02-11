@php
    $heading = $aboutHeading ?? 'About Us';
    $subheading = $aboutSubheading ?? '';
    $image = $aboutImage ?? null;
    $sections = $aboutSections ?? [];

    function slugify($text) {
        return \Illuminate\Support\Str::slug($text);
    }
@endphp

<div class="min-h-screen bg-base-100" data-theme="corporate">
    @include('themes::components.default.navbar', $__data)

    <main>
        {{-- Dark Hero Section --}}
        <div class="relative isolate overflow-hidden bg-gray-900">
            @if($image)
                <img src="{{ $image }}" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover" />
                <div class="absolute inset-0 -z-10 bg-gray-700 opacity-80"></div>
            @else
                <div class="absolute inset-0 -z-10 bg-gradient-to-br from-gray-900 to-gray-800"></div>
            @endif

            <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
                <div class="max-w-2xl">
                    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">{{ $heading }}</h1>
                    @if($subheading)
                        <p class="mt-6 text-lg leading-8 text-gray-300">{{ $subheading }}</p>
                    @endif
                </div>

                @if(count($sections) > 0)
                    <div class="mt-12 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach($sections as $section)
                            <a href="#{{ slugify($section['title'] ?? '') }}"
                               class="group rounded-xl bg-white/5 p-6 ring-1 ring-white/10 hover:bg-white/10 transition">
                                @if(!empty($section['icon']))
                                    <div class="mb-4 text-gray-400 group-hover:text-white transition">
                                        <i class="{{ $section['icon'] }}" style="font-size: 32px;"></i>
                                    </div>
                                @endif
                                <h3 class="text-lg font-semibold text-white">{{ $section['title'] ?? '' }}</h3>
                                @if(!empty($section['description']))
                                    <p class="mt-2 text-sm text-gray-400">{{ $section['description'] }}</p>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- Content Sections --}}
        <div class="bg-white">
            @if(count($sections) === 0)
                <div class="py-24 text-center">
                    <p class="text-gray-400">Add sections to tell your church's story.</p>
                </div>
            @else
                @foreach($sections as $index => $section)
                    <div id="{{ slugify($section['title'] ?? '') }}">
                        <div class="mx-auto max-w-3xl px-6 py-16 lg:py-24">
                            @if(!empty($section['title']))
                                <p class="text-sm font-medium uppercase tracking-wider text-gray-400">{{ $section['title'] }}</p>
                            @endif
                            @if(!empty($section['section_heading']))
                                <h2 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $section['section_heading'] }}</h2>
                            @endif
                            @if(!empty($section['content']))
                                <div class="mt-8 prose prose-lg max-w-none text-gray-600">{!! $section['content'] !!}</div>
                            @endif
                        </div>
                        @if($index < count($sections) - 1)
                            <hr class="border-gray-200 mx-auto max-w-3xl" />
                        @endif
                    </div>
                @endforeach
                <div class="pb-24"></div>
            @endif
        </div>
    </main>

    @include('themes::components.default.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.default.footer', $__data)
</div>
