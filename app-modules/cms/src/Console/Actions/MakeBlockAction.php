<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Console\Actions;

use ClintonRocha\CMS\Console\Helpers\CmsPaths;
use ClintonRocha\CMS\Console\Helpers\StubGenerator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

final readonly class MakeBlockAction
{
    public function __construct(
        private StubGenerator $stubs,
        private Filesystem $files,
        private CmsPaths $paths
    ) {}

    /**
     * @return array{created: array, overwritten: array, skipped: array}
     */
    public function handle(string $name, array $variants = ['default'], bool $force = false): array
    {
        $name = Str::studly($name);
        $slug = Str::kebab($name);

        $created = [];
        $overwritten = [];
        $skipped = [];

        $blockPath = mb_rtrim($this->paths->blockPath(), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$name;
        $viewPath = mb_rtrim($this->paths->viewsPath(), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$slug;

        if (! $this->files->isDirectory($blockPath)) {
            $this->files->makeDirectory($blockPath, 0755, true);
        }

        if (! $this->files->isDirectory($viewPath)) {
            $this->files->makeDirectory($viewPath, 0755, true);
        }

        $res = $this->stubs->generateFromStub('block.stub', sprintf('%s/%sBlock.php', $blockPath, $name), [
            'name' => $name,
            'slug' => $slug,
            'namespace' => $this->paths->blockNamespace(),
        ], $force);

        $created = array_merge($created, $res['created']);
        $overwritten = array_merge($overwritten, $res['overwritten']);
        $skipped = array_merge($skipped, $res['skipped']);

        $res = $this->stubs->generateFromStub('data.stub', sprintf('%s/%sData.php', $blockPath, $name), [
            'name' => $name,
            'namespace' => $this->paths->blockNamespace(),
        ], $force);

        $created = array_merge($created, $res['created']);
        $overwritten = array_merge($overwritten, $res['overwritten']);
        $skipped = array_merge($skipped, $res['skipped']);

        $res = $this->stubs->generateFromStub('schema.stub', sprintf('%s/%sSchema.php', $blockPath, $name), [
            'name' => $name,
            'slug' => $slug,
            'namespace' => $this->paths->blockNamespace(),
        ], $force);

        $created = array_merge($created, $res['created']);
        $overwritten = array_merge($overwritten, $res['overwritten']);
        $skipped = array_merge($skipped, $res['skipped']);

        foreach ($variants as $variant) {
            $variant = Str::kebab($variant);

            $res = $this->stubs->generateFromStub(
                'view.stub',
                sprintf('%s/%s.blade.php', $viewPath, $variant),
                [
                    'name' => $name,
                    'slug' => $slug,
                    'variant' => $variant,
                ],
                $force
            );

            $created = array_merge($created, $res['created']);
            $overwritten = array_merge($overwritten, $res['overwritten']);
            $skipped = array_merge($skipped, $res['skipped']);
        }

        return ['created' => $created, 'overwritten' => $overwritten, 'skipped' => $skipped];
    }
}
