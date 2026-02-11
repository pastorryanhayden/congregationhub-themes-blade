<?php

namespace CongregationHub\Themes;

use Illuminate\Support\ServiceProvider;

class CongregationHubThemesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'themes');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/themes'),
        ], 'themes-views');
    }
}
