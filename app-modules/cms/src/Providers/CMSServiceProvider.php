<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Providers;

use ClintonRocha\CMS\CmsPanelPlugin;
use Filament\Panel;
use Illuminate\Support\ServiceProvider;

class CMSServiceProvider extends ServiceProvider
{
    public function register(): void
    {
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

    }
}
