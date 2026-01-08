<?php

namespace ClintonRocha\CMS\ValueObjects;

use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\Contracts\BlockDefinition;
use ClintonRocha\CMS\Models\PageBlock;

class AnchorBlock implements BlockDefinition
{

    public static function type(): string
    {
        return 'anchor';
    }

    public static function variants(): array
    {
        // TODO: Implement variants() method.
    }

    public static function label(): string
    {
        // TODO: Implement label() method.
    }

    public static function schema(): array
    {
        // TODO: Implement schema() method.
    }

    public static function fromModel(PageBlock $block): BlockData
    {
        // TODO: Implement fromModel() method.
    }

    public static function view(BlockData $data): string
    {
        // TODO: Implement view() method.
    }
}
