<div class="min-h-screen bg-base-100" data-theme="corporate">
    @include('themes::components.default.navbar', $__data)
    <main>
        @include('themes::components.default.dark-hero', ['heading' => $pageTitle ?? __('Blog')])
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($posts ?? [] as $post)
                    <article class="card bg-base-100 shadow-xl">
                        @if(!empty($post['image']))
                            <figure><img src="{{ $post['image'] }}" alt="" class="h-48 w-full object-cover" /></figure>
                        @endif
                        <div class="card-body">
                            <h2 class="card-title"><a class="link link-hover" href="{{ $post['url'] }}">{{ $post['title'] }}</a></h2>
                            @if(!empty($post['date']))<p class="text-sm text-base-content/60">{{ $post['date'] }}</p>@endif
                            @if(!empty($post['description']))<p>{{ $post['description'] }}</p>@endif
                        </div>
                    </article>
                @empty
                    <p class="text-base-content/60">{{ __('No articles published yet.') }}</p>
                @endforelse
            </div>
        </div>
    </main>
    @include('themes::components.default.map-section', ['mapUrl' => $mapUrl ?? null])
    @include('themes::components.default.footer', $__data)
</div>
