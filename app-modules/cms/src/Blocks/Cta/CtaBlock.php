<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Cta;

use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\Contracts\BlockDefinition;

class CtaBlock implements BlockDefinition
{
    public static function type(): string
    {
        return 'cta';
    }

    public static function label(): string
    {
        return 'Call to Action';
    }

    public function schema(): array
    {
        return CtaSchema::schema();
    }

    public function fromModel(array $data): BlockData
    {
        return CtaData::fromArray($data);
    }

    public function view(string $variant): string
    {
        return 'cms::blocks.cta.'.$variant;
    }
}
