<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Contracts;

interface BlockDefinition
{
    public static function type(): string;

    public static function label(): string;

    public function schema(): array;

    public function fromModel(array $data): BlockData;

    public function view(string $variant): string;
}
