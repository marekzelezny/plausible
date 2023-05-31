<?php

declare(strict_types=1);

namespace MarekZelezny\Plausible;

use Illuminate\Support\ServiceProvider;

class PlausibleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/plausible.php', 'plausible');
        $this->app->singleton('plausible', Plausible::class);
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'plausible');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/plausible'),
        ], 'plausible-views');

        $this->publishes([
            __DIR__.'/../config/plausible.php' => config_path('plausible.php'),
        ], 'plausible-config');
    }
}
