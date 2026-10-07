@php
    $document = \CongregationHub\Themes\Support\ContentSections::prepare($content);
    $showToc = count($document['toc']) >= 4;
    $groups = [];
    $minimum = $document['toc'] ? min(array_column($document['toc'], 'level')) : 1;
    foreach ($document['toc'] as $entry) {
        if ($entry['level'] === $minimum || !$groups) {
            $groups[] = ['heading' => $entry, 'children' => []];
        } else {
            $groups[array_key_last($groups)]['children'][] = $entry;
        }
    }
@endphp
<div @class(['lg:grid lg:grid-cols-[18rem_minmax(0,1fr)] lg:gap-12' => $showToc, 'max-w-4xl mx-auto' => !$showToc])>
    @if($showToc)
        <aside class="mb-8 lg:mb-0">
            <nav aria-label="{{ __('page_navigation.on_this_page') }}" class="lg:sticky lg:top-24 rounded-box border border-base-300 bg-base-200 p-4">
                <details open>
                    <summary class="cursor-pointer font-semibold">{{ __('page_navigation.on_this_page') }}</summary>
                    <ul class="mt-3 space-y-2 max-h-[60vh] overflow-y-auto text-sm" role="list">
                        @foreach($groups as $group)
                            <li>
                                @if($group['children'])
                                    <details>
                                        <summary class="cursor-pointer py-1">{{ $group['heading']['title'] }}</summary>
                                        <ul class="pl-4 border-l border-base-300 space-y-1" role="list">
                                            <li><a class="link link-hover block py-1" href="#{{ $group['heading']['anchor'] }}">{{ __('page_navigation.section_start') }}</a></li>
                                            @foreach($group['children'] as $entry)
                                                <li @class(['pl-3' => $entry['level'] > $minimum + 1])><a class="link link-hover block py-1" href="#{{ $entry['anchor'] }}">{{ $entry['title'] }}</a></li>
                                            @endforeach
                                        </ul>
                                    </details>
                                @else
                                    <a class="link link-hover block py-1" href="#{{ $group['heading']['anchor'] }}">{{ $group['heading']['title'] }}</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </details>
            </nav>
        </aside>
    @endif
    <div class="prose prose-lg max-w-none min-w-0 [&_h1]:scroll-mt-28 [&_h2]:scroll-mt-28 [&_h3]:scroll-mt-28 [&_h4]:scroll-mt-28 [&_h5]:scroll-mt-28 [&_h6]:scroll-mt-28 [&_:target]:bg-base-200">{!! $document['html'] !!}</div>
</div>
