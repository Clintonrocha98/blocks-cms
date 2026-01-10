<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Features;

use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\Contracts\BlockDefinition;

class FeaturesBlock implements BlockDefinition
{
    public function type(): string
    {
        return 'features';
    }

    public function label(): string
    {
        return 'Recursos';
    }

    public function schema(): array
    {
        return FeaturesSchema::schema();
    }

    public function fromModel(array $data): BlockData
    {
        return FeaturesData::fromArray($data);
    }

    public function view(string $variant): string
    {
        return 'cms::blocks.features.'.$variant;
    }
}
