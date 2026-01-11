<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Console\Commands;

use ClintonRocha\CMS\Console\Actions\MakeVariantAction;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;
use function Laravel\Prompts\confirm;

class MakeVariantCommand extends Command implements PromptsForMissingInput
{
    protected $signature = 'cms:make-variant
        {block : Nome do bloco (slug ou StudlyCase)}
        {variant : Nome da variação}
        {--force : Sobrescrever se existir}';

    protected $description = 'Cria uma nova variação para um bloco existente do CMS';

    public function promptForMissingArgumentsUsing(): array
    {
        return [
            'block' => function () {
                $dir = base_path('app-modules/cms/resources/views/components/blocks');

                $choices = [];
                if (is_dir($dir)) {
                    foreach (scandir($dir) as $item) {
                        if ($item === '.' || $item === '..') {
                            continue;
                        }

                        if (is_dir($dir.DIRECTORY_SEPARATOR.$item)) {
                            $choices[] = $item;
                        }
                    }
                }

                if (! empty($choices)) {
                    return select(label: 'Escolha o bloco', options: $choices);
                }

                return text(label: 'Escolha o bloco', placeholder: 'Digite o slug ou nome do bloco');
            },
            'variant' => 'Nome da variação',
        ];
    }

    public function handle(MakeVariantAction $action, Filesystem $files): int
    {
        $block = $this->argument('block');
        $variant = $this->argument('variant');

        $blockSlug = Str::kebab($block);
        $variant = Str::kebab($variant);

        $viewPath = base_path('app-modules/cms/resources/views/components/blocks/'.$blockSlug);

        if (!$files->isDirectory($viewPath)) {
            $this->components->error(sprintf("O bloco '%s' não existe.", $blockSlug));

            return self::FAILURE;
        }

        $force = (bool) $this->option('force');

        $result = $action->handle($blockSlug, $variant, false);

        if (!empty($result['skipped']) && !$force) {
            $this->components->warn('Os seguintes arquivos já existem:');
            foreach ($result['skipped'] as $file) {
                $this->line('  • '.$file);
            }

            if (confirm(label: 'Deseja sobrescrever os arquivos existentes?', default: false)) {
                $result = $action->handle($blockSlug, $variant, true);
            } else {
                $this->components->info('Operação cancelada. Nenhum arquivo foi sobrescrito.');

                return self::SUCCESS;
            }
        }

        $this->components->info(sprintf("Variação '%s' criada para o bloco '%s'.", $variant, $blockSlug));

        $this->line('');
        $this->line('Arquivos criados:');

        foreach ($result['created'] as $file) {
            $this->line('  • '.$file);
        }

        return self::SUCCESS;
    }
}
