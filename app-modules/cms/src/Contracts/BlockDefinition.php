<?php
declare(strict_types=1);

namespace ClintonRocha\CMS\Contracts;

interface BlockDefinition
{
    public static function type(): string;

    public static function variants(): array;

    public static function label(): string;

    public static function schema(): array;

    public static function fromModel(array $data): BlockData;

    public static function view(BlockData $data): string;
}
