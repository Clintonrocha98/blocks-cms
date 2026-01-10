<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Infrastructure;

use ClintonRocha\CMS\Contracts\BlockDefinition;
use Illuminate\Support\Str;
use InvalidArgumentException;

final class BlockFactory
{
    private static array $instances = [];

    public static function make(string $type): BlockDefinition
    {
        if (isset(self::$instances[$type])) {
            return self::$instances[$type];
        }

        $studly = Str::studly($type);
        $class = sprintf(
            'ClintonRocha\\CMS\\Blocks\\%s\\%sBlock',
            $studly,
            $studly
        );

        throw_unless(
            class_exists($class),
            InvalidArgumentException::class,
            sprintf('Block %s não encontrado', $type)
        );

        return self::$instances[$type] = new $class;
    }
}
