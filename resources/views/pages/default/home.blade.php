{{--
    Home page template.
    Expected variables: all app-layout props + heading, headerImage, headerVideo, actionLinks,
    showEvents, events, showSermons, series, showMinistries, ministries
--}}
<div class="min-h-screen bg-base-100" data-theme="corporate">
    @include('themes::components.default.navbar', array_merge($__data ?? [], ['transparent' => true]))

    <main>
        @include('themes::components.default.hero-section', [
            'heading' => $heading ?? __('Welcome'),
            'headerImage' => $headerImage ?? 'https://images.unsplash.com/photo-1438232992991-995b7058bbb3?w=1920&q=80',
            'headerVideo' => $headerVideo ?? null,
        ])

        @include('themes::components.default.features-section', [
            'actionLinks' => $actionLinks ?? [],
        ])

        @include('themes::components.default.events-section', [
            'showEvents' => $showEvents ?? true,
            'events' => $events ?? [],
        ])

        @include('themes::components.default.series-section', [
            'showSermons' => $showSermons ?? false,
            'series' => $series ?? [],
        ])

        @include('themes::components.default.ministries-section', [
            'showMinistries' => $showMinistries ?? false,
            'ministries' => $ministries ?? [],
        ])
    </main>

    @include('themes::components.default.map-section', ['mapUrl' => $mapUrl ?? null])

    @include('themes::components.default.footer', [
        'siteName' => $siteName ?? __('Your Church'),
        'footerAbout' => $footerAbout ?? __('Building community together.'),
        'churchAddress' => $churchAddress ?? '123 Main Street',
        'mailingAddress' => $mailingAddress ?? '',
        'churchPhone' => $churchPhone ?? '(555) 123-4567',
        'churchEmail' => $churchEmail ?? 'info@yourchurch.com',
        'scheduleSections' => $scheduleSections ?? null,
        'youtubeUrl' => $youtubeUrl ?? '',
        'facebookUrl' => $facebookUrl ?? '',
        'instagramUrl' => $instagramUrl ?? '',
        'navLogoLight' => $navLogoLight ?? null,
    ])
</div>
