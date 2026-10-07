<?php

namespace CongregationHub\Themes\Support;

use DOMDocument;
use DOMElement;
use DOMNode;
use Illuminate\Support\Str;

/** One heading/anchor contract shared by rendered pages and search citations. */
class ContentSections
{
    public static function prepare(string $content): array
    {
        $html = markdown_to_html($content);
        $dom = new DOMDocument('1.0', 'UTF-8');
        $previous = libxml_use_internal_errors(true);
        try {
            $dom->loadHTML('<?xml encoding="UTF-8"><html><body>'.$html.'</body></html>', LIBXML_NONET);
        } finally {
            libxml_clear_errors();
            libxml_use_internal_errors($previous);
        }
        $body = $dom->getElementsByTagName('body')->item(0);
        $xpath = new \DOMXPath($dom);
        $used = [];
        foreach ($xpath->query('//*[@id]') as $element) {
            $used[$element->getAttribute('id')] = true;
        }
        $headings = $xpath->query('//body//*[self::h1 or self::h2 or self::h3 or self::h4 or self::h5 or self::h6]');
        $articleMode = false;
        foreach ($headings as $heading) {
            $articleMode = $articleMode || (bool) preg_match('/^Article\s+\d+\b/i', trim($heading->textContent));
        }
        $toc = [];
        $parents = [];
        $sectionTitles = [];
        $assigned = [];
        foreach ($xpath->query('//*[@id and not(self::h1 or self::h2 or self::h3 or self::h4 or self::h5 or self::h6)]') as $element) {
            $assigned[$element->getAttribute('id')] = true;
        }
        foreach ($headings as $heading) {
            $title = trim(preg_replace('/\s+/u', ' ', $heading->textContent));
            if ($title === '') {
                continue;
            }
            $id = $heading->getAttribute('id');
            if (isset($assigned[$id])) {
                $id = '';
            }
            if ($id === '') {
                $base = 'section-'.(Str::slug(mb_substr($title, 0, 120)) ?: 'heading');
                $id = $base;
                for ($suffix = 2; isset($used[$id]); $suffix++) {
                    $id = $base.'-'.$suffix;
                }
                $heading->setAttribute('id', $id);
            }
            $used[$id] = true;
            $assigned[$id] = true;
            $heading->setAttribute('tabindex', '-1');
            $heading->setAttribute('class', trim($heading->getAttribute('class').' scroll-mt-28 target:bg-base-200'));
            $level = (int) substr($heading->tagName, 1);
            if ($articleMode) {
                $level = preg_match('/^Article\s+\d+\b/i', $title) ? 1 : (preg_match('/^Section\s+\d+/i', $title) ? 2 : 3);
            }
            $toc[] = ['anchor' => $id, 'title' => $title, 'level' => $level];
            foreach (array_keys($parents) as $depth) {
                if ($depth >= $level) {
                    unset($parents[$depth]);
                }
            }
            $parents[$level] = $title;
            $sectionTitles[$id] = implode(' — ', $parents);
        }
        $sections = [['anchor' => null, 'title' => null, 'text' => '']];
        $walk = function (DOMNode $node) use (&$walk, &$sections, $sectionTitles): void {
            if ($node instanceof DOMElement && in_array(strtolower($node->tagName), ['script', 'style'])) {
                return;
            }
            if ($node instanceof DOMElement && preg_match('/^h[1-6]$/', $node->tagName) && $node->hasAttribute('id')) {
                $sections[] = ['anchor' => $node->getAttribute('id'), 'title' => $sectionTitles[$node->getAttribute('id')] ?? trim($node->textContent), 'text' => ''];
            }
            if ($node->nodeType === XML_TEXT_NODE) {
                $sections[array_key_last($sections)]['text'] .= $node->textContent.' ';
            }
            foreach ($node->childNodes as $child) {
                $walk($child);
            }
        };
        if ($body) {
            $walk($body);
        }
        foreach ($sections as &$section) {
            $section['text'] = trim(preg_replace('/\s+/u', ' ', $section['text']));
        }
        unset($section);
        $rendered = '';
        foreach ($body?->childNodes ?? [] as $child) {
            $rendered .= $dom->saveHTML($child);
        }

        return ['html' => $rendered, 'toc' => $toc, 'sections' => array_values(array_filter($sections, fn ($s) => $s['text'] !== ''))];
    }
}
