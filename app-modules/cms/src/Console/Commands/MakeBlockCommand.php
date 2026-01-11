<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Console\Commands;

use ClintonRocha\CMS\Console\Actions\MakeBlockAction;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;

class MakeBlockCommand extends Command implements PromptsForMissingInput
{
    protected $signature = 'cms:make-block
        {name : Nome do bloco (StudlyCase)}
        {--variants=* : Variações (opção repetível, ex: --variants=default --variants=grid)}
        {--force : Sobrescrever bloco existente}';

    protected $description = 'Cria um novo bloco do CMS';

    /**
     * Customize the prompt used when Laravel needs to collect missing arguments.
     * Returning a string uses that string as the question for the argument.
     * You may also return a closure that performs a custom prompt (eg. search).
     *
     * @return array<string, string|callable>
     */
    public function promptForMissingArgumentsUsing(): array
    {
        return [
            'name' => 'Nome do bloco (StudlyCase)',
        ];
    }

    /**
     * Called after missing arguments were prompted. Use this to prompt for related options.
     */
    public function afterPromptingForMissingArguments(InputInterface $input, OutputInterface $output): void
    {
        $variants = $input->getOption('variants') ?: [];

        if (empty($variants)) {
            $raw = text(label: 'Variants (comma separated)', placeholder: 'default');

            $parsed = array_filter(array_map('trim', explode(',', (string) $raw)));

            $input->setOption('variants', $parsed ?: ['default']);
        }
    }

    public function handle(MakeBlockAction $action, Filesystem $files): int
    {
        $name = Str::studly($this->argument('name'));

        $variants = $this->option('variants') ?? [];

        $variants = array_values(array_unique(array_filter(array_map(fn ($v) => Str::kebab((string) $v), $variants))));

        $force = (bool) $this->option('force');

        $result = $action->handle($name, $variants);

        if (! empty($result['skipped']) && ! $force) {
            $this->components->warn('The following files already exist:');
            foreach ($result['skipped'] as $file) {
                $this->line('  • ' . $file);
            }

            if (confirm(label: 'Overwrite existing files?', default: false)) {
                $result = $action->handle($name, $variants, true);
            } else {
                $this->components->info('Operation cancelled. No files were overwritten.');

                return self::SUCCESS;
            }
        }

        $this->components->info(sprintf('CMS block %s created successfully.', $name));
        $this->line('');
        $this->line('Created files:');

        foreach ($result['created'] as $file) {
            $this->line('  • ' . $file);
        }

        if (! empty($result['overwritten'])) {
            $this->line('');
            $this->line('Overwritten files:');
            foreach ($result['overwritten'] as $file) {
                $this->line('  • ' . $file);
            }
        }

        return self::SUCCESS;
    }
}
