<?php
declare(strict_types=1);

namespace ClintonRocha\CMS\Contracts;

use ClintonRocha\CMS\Models\PageBlock;

interface BlockDefinition
{
    public static function type(): string;

    public static function variants(): array;

    public static function label(): string;

    public static function schema(): array;

    public static function fromModel(PageBlock $block): BlockData;

    public static function view(BlockData $data): string;
}
