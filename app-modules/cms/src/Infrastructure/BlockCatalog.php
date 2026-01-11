<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Infrastructure;

use ClintonRocha\CMS\Contracts\BlockDefinition;
use Illuminate\Support\Str;

final class BlockCatalog
{
    /** @var array<string, array<string, string>> */
    private static array $variants = [];

    /** @var array<string, string>|null */
    private static ?array $options = null;

    public static function variants(string $type): array
    {
        if (isset(self::$variants[$type])) {
            return self::$variants[$type];
        }

        $viewsPath = config('cms.views.path', resource_path('views/components/blocks'));
        $path = mb_rtrim($viewsPath, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.$type;

        if (! is_dir($path)) {
            return self::$variants[$type] = [];
        }

        return self::$variants[$type] = collect(glob($path.'/*.blade.php'))
            ->mapWithKeys(function (string $file): array {
                $variant = basename($file, '.blade.php');

                return [
                    $variant => Str::headline($variant),
                ];
            })
            ->all();
    }

    public static function options(): array
    {
        if (self::$options !== null) {
            return self::$options;
        }

        $blocksPath = config('cms.blocks.path', app_path('Blocks'));
        $base = mb_rtrim($blocksPath, DIRECTORY_SEPARATOR);

        return self::$options = collect(glob($base.'/*/*Block.php'))
            ->mapWithKeys(function (string $path): array {
                /** @var class-string<BlockDefinition> $class */
                $class = self::classFromPath($path);

                return [
                    $class::type() => $class::label(),
                ];
            })
            ->all();
    }

    private static function classFromPath(string $path): string
    {
        $path = realpath($path);
        $blocksPath = realpath(config('cms.blocks.path', app_path('Blocks')));

        $relative = str_replace(
            $blocksPath.DIRECTORY_SEPARATOR,
            '',
            $path
        );

        $classPath = str_replace(
            [DIRECTORY_SEPARATOR, '.php'],
            ['\\', ''],
            $relative
        );

        return mb_rtrim(config('cms.blocks.namespace', 'App\\Blocks'), '\\').'\\'.$classPath;
    }
}
