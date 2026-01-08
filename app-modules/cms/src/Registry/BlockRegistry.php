<?php

namespace ClintonRocha\CMS\Registry;

use ClintonRocha\CMS\Contracts\BlockDefinition;
use Illuminate\Support\Str;
use InvalidArgumentException;

final class BlockRegistry
{
    public static function resolve(string $type): BlockDefinition
    {
        $studly = Str::studly($type);

        $class = "ClintonRocha\\CMS\\Blocks\\{$studly}\\{$studly}Block";

        if (!class_exists($class)) {
            throw new InvalidArgumentException("Block {$type} não encontrado");
        }

        return new $class;
    }

    public static function options(): array
    {
        $base = base_path('app-modules/cms/src/Blocks');

        return collect(glob($base.'/*/*Block.php'))
            ->mapWithKeys(function ($path) {
                /** @var BlockDefinition $class */
                $class = self::classFromPath($path);

                return [
                    $class::type() => $class::label(),
                ];
            })
            ->toArray();
    }

    protected static function classFromPath(string $path): string
    {
        $path = realpath($path);

        $srcPath = realpath(base_path('app-modules/cms/src'));

        $relative = str_replace($srcPath.DIRECTORY_SEPARATOR, '', $path);

        return 'ClintonRocha\\CMS\\'.str_replace(
                [DIRECTORY_SEPARATOR, '.php'],
                ['\\', ''],
                $relative
            );
    }
}
