<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakeVariantCommand extends Command
{
    protected $signature = 'cms:make-variant
    {block : Block name (slug ou StudlyCase)}
    {variant : Variant name}
    {--force : Overwrite if exists}';

    protected $description = 'Create a new variant for an existing CMS block';

    private array $createdFiles = [];

    public function handle(Filesystem $files): int
    {
        $block = Str::kebab($this->argument('block'));
        $variant = Str::kebab($this->argument('variant'));

        $viewPath = base_path(
            'app-modules/cms/resources/views/components/blocks/'.$block
        );

        if (! $files->isDirectory($viewPath)) {
            $this->components->error(sprintf("Block '%s' does not exist.", $block));

            return self::FAILURE;
        }

        $target = sprintf('%s/%s.blade.php', $viewPath, $variant);

        if ($files->exists($target) && ! $this->option('force')) {
            $this->components->error(sprintf("Variant '%s' already exists.", $variant));

            return self::FAILURE;
        }

        $this->makeFromStub(
            $files,
            'view.stub',
            $target,
            [
                'name' => Str::studly($block),
                'slug' => $block,
                'variant' => $variant,
            ]
        );

        $this->components->info(
            sprintf("Variant '%s' created for block '%s'.", $variant, $block)
        );

        $this->line('');
        $this->line('Created files:');

        foreach ($this->createdFiles as $file) {
            $this->line('  • '.$file);
        }

        return self::SUCCESS;
    }

    protected function makeFromStub(
        Filesystem $files,
        string $stub,
        string $target,
        array $data
    ): void {
        $stubPath = base_path('app-modules/cms/stubs/'.$stub);

        $content = $files->get($stubPath);

        foreach ($data as $key => $value) {
            $content = str_replace('{{ '.$key.' }}', $value, $content);
        }

        $files->put($target, $content);
        $this->createdFiles[] = $this->relativePath($target);
    }

    protected function relativePath(string $path): string
    {
        return str_replace(base_path().DIRECTORY_SEPARATOR, '', $path);
    }
}
