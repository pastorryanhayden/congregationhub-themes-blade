@props([
    'siteName' => 'Your Church',
    'navLogo' => null,
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

<div class="min-h-screen bg-base-200" data-theme="corporate" x-data="{ menuOpen: false }">
    @include('themes::components.premium.navbar', [
        'siteName' => $siteName,
        'navLogo' => $navLogo,
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

    @include('themes::components.premium.mega-menu', [
        'siteName' => $siteName,
        'showMinistries' => $showMinistries,
        'showEvents' => $showEvents,
        'showSermons' => $showSermons,
        'showGospel' => $showGospel,
        'showDoctrine' => $showDoctrine,
        'showConstitution' => $showConstitution,
        'aboutUsPages' => $aboutUsPages,
        'resourcesPages' => $resourcesPages,
        'hasBlogPosts' => $hasBlogPosts,
    ])

    <main>
        {{ $slot }}
    </main>

    @include('themes::components.premium.map-section', ['mapUrl' => $mapUrl])

    @include('themes::components.premium.footer', [
        'siteName' => $siteName,
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
