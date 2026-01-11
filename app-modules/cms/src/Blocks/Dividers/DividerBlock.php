<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Dividers;

use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\Contracts\BlockDefinition;

class DividerBlock implements BlockDefinition
{
    public static function type(): string
    {
        return 'divider';
    }

    public static function label(): string
    {
        return 'Divisor';
    }

    public function schema(): array
    {
        return DividerSchema::schema();
    }

    public function fromModel(array $data): BlockData
    {
        return DividerData::fromArray($data);
    }

    public function view(string $variant): string
    {
        return config('cms.views.namespace', 'cms::blocks').'.divider.'.$variant;
    }
}
