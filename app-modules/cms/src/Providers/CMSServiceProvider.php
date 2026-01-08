<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Providers;

use Illuminate\Support\ServiceProvider;

class CMSServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        $this->loadViewsFrom(
            __DIR__.'/../../resources/views',
            'cms'
        );

    }
}
