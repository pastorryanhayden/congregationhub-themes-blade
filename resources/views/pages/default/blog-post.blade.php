@php
    $title = $blogPostTitle ?? __('Blog Post Title');
    $image = $blogPostImage ?? null;
    $authorName = $blogPostAuthorName ?? '';
    $content = $blogPostContent ?? '';
@endphp

<div class="min-h-screen bg-base-100" data-theme="corporate">
    @include('themes::components.default.navbar', $__data)

    <main>
        @include('themes::components.default.dark-hero', [
            'heading' => $title,
            'subheading' => $authorName ? __('By :name', ['name' => $authorName]) : null,
            'image' => $image,
        ])

        @include('themes::components.default.breadcrumb', [
            'parent' => __('Blog'),
            'parentUrl' => '/blog',
            'current' => $title,
        ])

        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 py-12">
            @if($content)
                <div class="prose prose-lg max-w-none">{!! markdown_to_html($content) !!}</div>
            @else
                <div class="text-center py-12 text-base-content/40">
                    <p>{{ __('Add content to see it previewed here.') }}</p>
                </div>
            @endif
        </div>
    </main>

    @include('themes::components.default.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.default.footer', $__data)
</div>
