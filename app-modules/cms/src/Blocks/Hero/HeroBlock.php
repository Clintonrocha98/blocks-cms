<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Hero;

use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\Contracts\BlockDefinition;

class HeroBlock implements BlockDefinition
{
    public static function type(): string
    {
        return 'hero';
    }

    public static function label(): string
    {
        return 'Hero';
    }

    public function schema(): array
    {
        return HeroSchema::schema();
    }

    public function fromModel(array $data): BlockData
    {
        return HeroData::fromArray($data);
    }

    public function view(string $variant): string
    {
        return 'cms.blocks.hero.'.$variant;
    }
}
