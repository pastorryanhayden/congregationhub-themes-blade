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
    'transparent' => false,
    'aboutUsPages' => [],
    'resourcesPages' => [],
    'hasBlogPosts' => false,
    'mapUrl' => null,
    'footerAbout' => 'Building community together.',
    'churchAddress' => '123 Main Street',
    'mailingAddress' => '',
    'churchPhone' => '(555) 123-4567',
    'churchEmail' => 'info@yourchurch.com',
    'scheduleSections' => null,
    'youtubeUrl' => '',
    'facebookUrl' => '',
    'instagramUrl' => '',
])

<div class="min-h-screen bg-base-100" data-theme="corporate">
    @include('themes::components.default.navbar', [
        'siteName' => $siteName,
        'navLogoLight' => $navLogoLight,
        'navLogoDark' => $navLogoDark,
        'showMinistries' => $showMinistries,
        'showEvents' => $showEvents,
        'showSermons' => $showSermons,
        'showGospel' => $showGospel,
        'showDoctrine' => $showDoctrine,
        'showConstitution' => $showConstitution,
        'transparent' => $transparent,
        'aboutUsPages' => $aboutUsPages,
        'resourcesPages' => $resourcesPages,
        'hasBlogPosts' => $hasBlogPosts,
    ])

    <main>
        {{ $slot }}
    </main>

    @include('themes::components.default.map-section', ['mapUrl' => $mapUrl])

    @include('themes::components.default.footer', [
        'siteName' => $siteName,
        'navLogoLight' => $navLogoLight,
        'footerAbout' => $footerAbout,
        'churchAddress' => $churchAddress,
        'mailingAddress' => $mailingAddress,
        'churchPhone' => $churchPhone,
        'churchEmail' => $churchEmail,
        'scheduleSections' => $scheduleSections,
        'youtubeUrl' => $youtubeUrl,
        'facebookUrl' => $facebookUrl,
        'instagramUrl' => $instagramUrl,
    ])
</div>
