<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Console\Actions;

use ClintonRocha\CMS\Console\Helpers\CmsPaths;
use ClintonRocha\CMS\Console\Helpers\StubGenerator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use RuntimeException;

final readonly class MakeVariantAction
{
    public function __construct(
        private StubGenerator $stubs,
        private Filesystem $files,
        private CmsPaths $paths
    ) {}

    /**
     * @return array{created: array, overwritten: array, skipped: array}
     */
    public function handle(string $blockSlug, string $variant, bool $force = false): array
    {
        $block = Str::kebab($blockSlug);
        $variant = Str::kebab($variant);

        $viewPath = mb_rtrim($this->paths->viewsPath(), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$block;

        if (! $this->files->isDirectory($viewPath)) {
            throw new RuntimeException(sprintf("Block '%s' does not exist.", $block));
        }

        $target = sprintf('%s/%s.blade.php', $viewPath, $variant);

        return $this->stubs->generateFromStub('view.stub', $target, [
            'name' => Str::studly($block),
            'slug' => $block,
            'variant' => $variant,
        ], $force);
    }
}
