<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Providers;

use ClintonRocha\CMS\CmsPanelPlugin;
use ClintonRocha\CMS\Console\Helpers\CmsPaths;
use ClintonRocha\CMS\Console\Helpers\StubGenerator;
use Filament\Panel;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class CMSServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../../../config/cms.php', 'cms');

        $this->app->singleton(CmsPaths::class, function ($app) {
            return new CmsPaths($app->make(Filesystem::class));
        });

        $this->app->singleton(StubGenerator::class, function ($app) {
            return new StubGenerator($app->make(Filesystem::class), $app->make(CmsPaths::class));
        });

        Panel::configureUsing(static function (Panel $panel): void {
            match ($panel->getId()) {
                'cms' => $panel->plugin(new CmsPanelPlugin()),
                default => null,
            };
        });
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'cms');

        $this->publishes([
            __DIR__.'/../../../../config/cms.php' => config_path('cms.php'),
        ], 'cms-config');

        $this->publishes([
            __DIR__.'/../../stubs' => resource_path('stubs/cms'),
        ], 'cms-stubs');
    }
}
