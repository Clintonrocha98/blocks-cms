<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Console\Helpers;

use Illuminate\Filesystem\Filesystem;
use RuntimeException;

final readonly class StubGenerator
{
    public function __construct(private Filesystem $files, private CmsPaths $paths) {}

    /**
     * Generate a file from a stub.
     * Returns an array with keys: created, overwritten, skipped (each may contain the relative path)
     *
     * @return array{created: array, overwritten: array, skipped: array}
     */
    public function generateFromStub(string $stub, string $target, array $data = [], bool $force = false): array
    {
        $defaults = [
            'namespace' => $this->paths->blockNamespace(),
            'view' => $this->paths->viewsNamespace(),
        ];

        $data = array_merge($defaults, $data);

        $stubPath = $this->paths->stubsPath().DIRECTORY_SEPARATOR.$stub;

        if (! $this->files->exists($stubPath)) {
            throw new RuntimeException(sprintf('Stub not found: %s', $stubPath));
        }

        $content = $this->files->get($stubPath);

        foreach ($data as $key => $value) {
            $content = str_replace('{{ '.$key.' }}', (string) $value, $content);
        }

        $dir = dirname($target);

        if (! $this->files->isDirectory($dir)) {
            $this->files->makeDirectory($dir, 0755, true);
        }

        $relative = $this->relativePath($target);

        if ($this->files->exists($target)) {
            if (! $force) {
                return ['created' => [], 'overwritten' => [], 'skipped' => [$relative]];
            }

            $this->files->put($target, $content);

            return ['created' => [], 'overwritten' => [$relative], 'skipped' => []];
        }

        $this->files->put($target, $content);

        return ['created' => [$relative], 'overwritten' => [], 'skipped' => []];
    }

    private function relativePath(string $path): string
    {
        return str_replace(base_path().DIRECTORY_SEPARATOR, '', $path);
    }
}
