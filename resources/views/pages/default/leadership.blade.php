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

<div class="min-h-screen bg-base-100" data-theme="corporate">
    @include('themes::components.default.navbar', $__data)

    <main>
        {{-- Hero Section --}}
        <div class="bg-gray-50 py-16 lg:py-24">
            <div class="mx-auto max-w-7xl px-6 text-center">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Our Leadership</h1>
                <p class="mt-4 text-lg text-gray-600">Meet the people who lead and serve at {{ $churchName }}</p>
            </div>
        </div>

        <div class="bg-white">
            {{-- Looking for Pastor Alert --}}
            @if($lookingForPastor)
                <div class="mx-auto max-w-3xl px-6 py-16 lg:py-24">
                    <div class="rounded-2xl bg-blue-50 border border-blue-100 p-8 md:p-12">
                        <div class="flex items-start gap-4">
                            <div class="shrink-0 mt-1">
                                <svg class="size-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-blue-900">{{ $lookingForPastorHeading }}</h2>
                                @if($lookingForPastorMessage)
                                    <div class="mt-3 prose prose-sm prose-blue max-w-none text-blue-800">{!! $lookingForPastorMessage !!}</div>
                                @else
                                    <p class="mt-3 text-blue-800">Our church is currently seeking a pastor. Please contact us for more information.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @elseif(!$hasContent)
                {{-- Empty State --}}
                <div class="py-24 text-center">
                    <svg class="mx-auto size-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                    <p class="text-gray-400">Add leaders and sections to build your leadership page.</p>
                </div>
            @endif

            {{-- Featured Senior Leaders --}}
            @if(!$lookingForPastor && count($seniorLeaders) > 0)
                <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
                    <div class="space-y-16">
                        @foreach($seniorLeaders as $index => $leader)
                            <div class="bg-gray-50 rounded-2xl overflow-hidden">
                                <div class="flex flex-col md:flex-row {{ $index % 2 !== 0 ? 'md:flex-row-reverse' : '' }}">
                                    <div class="md:w-2/5 shrink-0">
                                        @if(!empty($leader['image']))
                                            <img src="{{ $leader['image'] }}" alt="{{ $leader['name'] ?? '' }}" class="w-full h-64 md:h-full object-cover" />
                                        @else
                                            <div class="w-full h-64 md:h-full min-h-[300px] bg-gray-200 flex items-center justify-center">
                                                <span class="text-5xl font-bold text-gray-400">{{ getInitials($leader['name'] ?? '') }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1 p-8 md:p-12 flex flex-col justify-center">
                                        @if(!empty($leader['title']))
                                            <p class="text-sm font-semibold uppercase tracking-wider text-gray-500">{{ $leader['title'] }}</p>
                                        @endif
                                        <h2 class="mt-2 text-3xl font-bold tracking-tight text-gray-900">{{ $leader['name'] ?? 'Senior Leader' }}</h2>
                                        @if(!empty($leader['bio']))
                                            <p class="mt-4 text-base leading-7 text-gray-600">{{ $leader['bio'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Leadership Sections --}}
            @if(count($leadershipSections) > 0)
                @foreach($leadershipSections as $sectionIndex => $section)
                    <div class="mx-auto max-w-7xl px-6 py-12 lg:py-16">
                        <div class="mb-10">
                            <h2 class="text-2xl font-bold tracking-tight text-gray-900">{{ $section['title'] ?? 'Section' }}</h2>
                            <div class="mt-2 h-1 w-16 rounded bg-gray-900"></div>
                        </div>

                        @if(!empty($section['members']) && count($section['members']) > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                                @foreach($section['members'] as $member)
                                    <div class="text-center">
                                        <div class="mx-auto mb-4 size-32 rounded-full overflow-hidden bg-gray-200">
                                            @if(!empty($member['image']))
                                                <img src="{{ $member['image'] }}" alt="{{ $member['name'] ?? '' }}" class="w-full h-full object-cover" />
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <span class="text-2xl font-bold text-gray-400">{{ getInitials($member['name'] ?? '') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $member['name'] ?? 'Member' }}</h3>
                                        @if(!empty($member['title']))
                                            <p class="mt-1 text-sm text-gray-500">{{ $member['title'] }}</p>
                                        @endif
                                        @if(!empty($member['bio']))
                                            <p class="mt-2 text-sm text-gray-600 line-clamp-3">{{ $member['bio'] }}</p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-400 text-center py-8">No members added to this section yet.</p>
                        @endif

                        @if($sectionIndex < count($leadershipSections) - 1)
                            <hr class="mt-12 border-gray-200" />
                        @endif
                    </div>
                @endforeach
                <div class="pb-16"></div>
            @endif
        </div>
    </main>

    @include('themes::components.default.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.default.footer', $__data)
</div>
