<?php

namespace CongregationHub\Themes;

use Illuminate\Support\ServiceProvider;

class CongregationHubThemesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        require_once __DIR__ . '/helpers.php';
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'themes');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../resources/lang');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/themes'),
        ], 'themes-views');
    }
}
