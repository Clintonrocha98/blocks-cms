<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Anchors;

use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\Contracts\BlockDefinition;

class AnchorBlock implements BlockDefinition
{
    public static function type(): string
    {
        return 'anchors';
    }

    public static function label(): string
    {
        return 'Âncoras';
    }

    public function schema(): array
    {
        return AnchorsSchema::schema();
    }

    public function fromModel(array $data): BlockData
    {
        return AnchorsData::fromArray($data);
    }

    public function view(string $variant): string
    {
        return 'cms::blocks.anchors.'.$variant;
    }
}
