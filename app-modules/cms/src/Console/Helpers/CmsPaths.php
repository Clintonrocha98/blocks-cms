<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Console\Helpers;

use Illuminate\Filesystem\Filesystem;

final readonly class CmsPaths
{
    public function __construct(private Filesystem $files) {}

    public function blockPath(): string
    {
        return config('cms.blocks.path', app_path('Blocks'));
    }

    public function blockNamespace(): string
    {
        return config('cms.blocks.namespace', 'App\\Blocks');
    }

    public function viewsPath(): string
    {
        return config('cms.views.path', resource_path('views/components/blocks'));
    }

    public function viewsNamespace(): string
    {
        return config('cms.views.namespace', 'components.blocks');
    }

    public function stubsPath(): string
    {
        $project = config('cms.stubs.path');

        if ($project && $this->files->exists($project)) {
            return $project;
        }

        return config('cms.stubs.package_path', base_path('app-modules/cms/stubs'));
    }
}
