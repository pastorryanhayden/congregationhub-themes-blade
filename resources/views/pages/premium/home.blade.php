{{--
    Home page template (premium theme).
    Expected variables: all app-layout props + heading, headerImage, headerVideo, actionLinks,
    showEvents, events, showSermons, series, showMinistries, ministries
--}}
<div class="min-h-screen bg-base-200" data-theme="corporate" x-data="{ menuOpen: false }">
    @include('themes::components.premium.navbar', array_merge($__data ?? [], ['transparent' => true]))
    @include('themes::components.premium.mega-menu', $__data ?? [])

    <main>
        @include('themes::components.premium.hero-section', [
            'heading' => $heading ?? 'Welcome',
            'headerImage' => $headerImage ?? 'https://images.unsplash.com/photo-1438232992991-995b7058bbb3?w=1920&q=80',
            'headerVideo' => $headerVideo ?? null,
        ])

        @include('themes::components.premium.features-section', [
            'actionLinks' => $actionLinks ?? [],
        ])

        @include('themes::components.premium.events-section', [
            'showEvents' => $showEvents ?? true,
            'events' => $events ?? [],
        ])

        @include('themes::components.premium.series-section', [
            'showSermons' => $showSermons ?? false,
            'series' => $series ?? [],
        ])

        @include('themes::components.premium.ministries-section', [
            'showMinistries' => $showMinistries ?? false,
            'ministries' => $ministries ?? [],
        ])
    </main>

    @include('themes::components.premium.map-section', ['mapUrl' => $mapUrl ?? null])

    @include('themes::components.premium.footer', [
        'siteName' => $siteName ?? 'Your Church',
        'footerAbout' => $footerAbout ?? 'Building community together.',
        'churchAddress' => $churchAddress ?? '123 Main Street',
        'mailingAddress' => $mailingAddress ?? '',
        'churchPhone' => $churchPhone ?? '(555) 123-4567',
        'churchEmail' => $churchEmail ?? 'info@yourchurch.com',
        'scheduleSections' => $scheduleSections ?? null,
        'youtubeUrl' => $youtubeUrl ?? '',
        'facebookUrl' => $facebookUrl ?? '',
        'instagramUrl' => $instagramUrl ?? '',
    ])
</div>
