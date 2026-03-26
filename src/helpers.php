<?php

if (! function_exists('markdown_to_html')) {
    /**
     * Convert Markdown to HTML, with auto-detection for legacy HTML content
     *
     * @param  string|null  $text
     * @return string
     */
    function markdown_to_html(?string $text): string
    {
        if (! $text) {
            return '';
        }

        // If content is already HTML (legacy Trix/Tiptap content), return as-is
        if (preg_match('/^<(p|div|h[1-6]|ul|ol|li|blockquote|strong|em|a|br|img)[\s>]/im', trim($text))) {
            return $text;
        }

        // Encode spaces in markdown image/link URLs so CommonMark can parse them
        $text = preg_replace_callback('/(!?\[[^\]]*\])\(([^)]+)\)/', function ($matches) {
            $url = str_replace(' ', '%20', $matches[2]);

            return $matches[1].'('.$url.')';
        }, $text);

        return \Illuminate\Support\Str::markdown($text, [
            'html_input' => 'allow',
            'allow_unsafe_links' => false,
        ]);
    }
}
