<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Text;

use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\Contracts\BlockDefinition;

final class TextBlock implements BlockDefinition
{
    public function type(): string
    {
        return 'text';
    }

    public function label(): string
    {
        return 'Text';
    }

    public function schema(): array
    {
        return TextSchema::schema();
    }

    public function fromModel(array $data): BlockData
    {
        return TextData::fromArray($data);
    }

    public function view(string $variant): string
    {
        return 'cms::blocks.text.'.$variant;
    }
}
