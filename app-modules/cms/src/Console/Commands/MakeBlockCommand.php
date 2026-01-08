<?php

namespace ClintonRocha\CMS\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakeBlockCommand extends Command
{
    protected $signature = 'cms:make-block {name}';

    protected $description = 'Create a new CMS block';

    public function handle(Filesystem $files): int
    {
        $name = Str::studly($this->argument('name'));
        $slug = Str::kebab($name);

        $blockPath = base_path("app-modules/cms/src/Blocks/{$name}");
        $viewPath = base_path("app-modules/cms/resources/views/components/blocks/{$slug}");

        if ($files->exists($blockPath)) {
            $this->error("Block {$name} already exists.");
            return self::FAILURE;
        }

        $files->makeDirectory($blockPath, 0755, true);
        $files->makeDirectory($viewPath, 0755, true);

        $this->makeFromStub(
            $files,
            'block.stub',
            "{$blockPath}/{$name}Block.php",
            compact('name', 'slug')
        );

        $this->makeFromStub(
            $files,
            'data.stub',
            "{$blockPath}/{$name}Data.php",
            compact('name')
        );

        $this->makeFromStub(
            $files,
            'schema.stub',
            "{$blockPath}/{$name}Schema.php",
            compact('name', 'slug')
        );

        $this->makeFromStub(
            $files,
            'view.stub',
            "{$viewPath}/default.blade.php",
            [
                'name' => $name,
                'slug' => $slug,
            ]
        );

        $this->info("CMS block {$name} created successfully.");

        return self::SUCCESS;
    }

    protected function makeFromStub(
        Filesystem $files,
        string $stub,
        string $target,
        array $data
    ): void {
        $stubPath = base_path("app-modules/cms/stubs/{$stub}");

        $content = $files->get($stubPath);

        foreach ($data as $key => $value) {
            $content = str_replace('{{ '.$key.' }}', $value, $content);
        }

        $files->put($target, $content);
    }
}
