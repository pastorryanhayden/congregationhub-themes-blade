@php
    $churchName = $siteName ?? 'Our Church';
    $seniorLeaders = $seniorLeaders ?? [];
    $leadershipSections = $leadershipSections ?? [];
    $lookingForPastor = $lookingForPastor ?? false;
    $lookingForPastorHeading = $lookingForPastorHeading ?? 'Pastoral Search';
    $lookingForPastorMessage = $lookingForPastorMessage ?? '';
    $hasContent = count($seniorLeaders) > 0 || count($leadershipSections) > 0;

    function getInitials($name) {
        if (!$name) return '?';
        return strtoupper(implode('', array_map(fn($w) => $w[0] ?? '', explode(' ', $name))));
    }
@endphp

<div class="min-h-screen bg-base-200" data-theme="corporate" x-data="{ menuOpen: false }">
    @include('themes::components.premium.navbar', $__data)
    @include('themes::components.premium.mega-menu', $__data)

    <main>
        {{-- Hero Section --}}
        <section class="bg-base-200 px-4 sm:px-6 py-6">
            <div class="bg-neutral text-neutral-content rounded-3xl overflow-hidden">
                <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20 sm:py-28 text-center">
                    <h1 class="text-4xl sm:text-6xl font-serif font-bold tracking-tight">Our Leadership</h1>
                    <p class="mt-4 text-lg text-neutral-content/70">Meet the people who lead and serve at {{ $churchName }}</p>
                </div>
            </div>
        </section>

        {{-- Looking for Pastor Alert --}}
        @if($lookingForPastor)
            <section class="bg-base-200 py-16 sm:py-20">
                <div class="max-w-3xl mx-auto px-6 lg:px-8">
                    <div class="rounded-2xl bg-blue-50 border border-blue-100 p-8 md:p-12">
                        <div class="flex items-start gap-4">
                            <div class="shrink-0 mt-1">
                                <svg class="size-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-serif font-bold text-blue-900">{{ $lookingForPastorHeading }}</h2>
                                @if($lookingForPastorMessage)
                                    <div class="mt-3 prose prose-sm prose-blue max-w-none text-blue-800">{!! $lookingForPastorMessage !!}</div>
                                @else
                                    <p class="mt-3 text-blue-800">Our church is currently seeking a pastor. Please contact us for more information.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @elseif(!$hasContent)
            {{-- Empty State --}}
            <section class="bg-base-200 py-20 sm:py-28">
                <div class="text-center">
                    <svg class="mx-auto size-12 text-base-content/20 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                    <p class="text-base-content/40">Add leaders and sections to build your leadership page.</p>
                </div>
            </section>
        @endif

        {{-- Featured Senior Leaders --}}
        @if(!$lookingForPastor && count($seniorLeaders) > 0)
            <section class="bg-base-200 py-16 sm:py-20">
                <div class="max-w-7xl mx-auto px-6 lg:px-8">
                    <div class="space-y-8">
                        @foreach($seniorLeaders as $index => $leader)
                            <div class="bg-base-100 rounded-2xl overflow-hidden shadow-lg">
                                <div class="flex flex-col md:flex-row {{ $index % 2 !== 0 ? 'md:flex-row-reverse' : '' }}">
                                    <div class="md:w-2/5 shrink-0">
                                        @if(!empty($leader['image']))
                                            <img src="{{ $leader['image'] }}" alt="{{ $leader['name'] ?? '' }}" class="w-full h-64 md:h-full object-cover" />
                                        @else
                                            <div class="w-full h-64 md:h-full min-h-[300px] bg-base-300 flex items-center justify-center">
                                                <span class="text-5xl font-bold text-base-content/20">{{ getInitials($leader['name'] ?? '') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 p-8 md:p-12 flex flex-col justify-center">
                                        @if(!empty($leader['title']))
                                            <p class="text-sm font-semibold uppercase tracking-wider text-base-content/50">{{ $leader['title'] }}</p>
                                        @endif
                                        <h2 class="mt-2 text-3xl font-serif font-bold tracking-tight">{{ $leader['name'] ?? 'Senior Leader' }}</h2>
                                        @if(!empty($leader['bio']))
                                            <p class="mt-4 text-base leading-7 text-base-content/70">{{ $leader['bio'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Leadership Sections --}}
        @if(count($leadershipSections) > 0)
            @foreach($leadershipSections as $sectionIndex => $section)
                <section class="bg-base-200 py-12 sm:py-16">
                    <div class="max-w-7xl mx-auto px-6 lg:px-8">
                        <div class="mb-10">
                            <h2 class="text-2xl font-serif font-bold tracking-tight">{{ $section['title'] ?? 'Section' }}</h2>
                            <div class="mt-2 h-1 w-16 rounded bg-base-content"></div>
                        </div>

                        @if(!empty($section['members']) && count($section['members']) > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                                @foreach($section['members'] as $member)
                                    <div class="text-center">
                                        <div class="mx-auto mb-4 size-32 rounded-full overflow-hidden bg-base-300">
                                            @if(!empty($member['image']))
                                                <img src="{{ $member['image'] }}" alt="{{ $member['name'] ?? '' }}" class="w-full h-full object-cover" />
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <span class="text-2xl font-bold text-base-content/20">{{ getInitials($member['name'] ?? '') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <h3 class="text-lg font-serif font-semibold">{{ $member['name'] ?? 'Member' }}</h3>
                                        @if(!empty($member['title']))
                                            <p class="mt-1 text-sm text-base-content/50">{{ $member['title'] }}</p>
                                        @endif
                                        @if(!empty($member['bio']))
                                            <p class="mt-2 text-sm text-base-content/60 line-clamp-3">{{ $member['bio'] }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-base-content/40 text-center py-8">No members added to this section yet.</p>
                        @endif

                        @if($sectionIndex < count($leadershipSections) - 1)
                            <hr class="mt-12 border-base-300" />
                        @endif
                    </div>
                </section>
            @endforeach
        @endif
    </main>

    @include('themes::components.premium.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.premium.footer', $__data)
</div>
