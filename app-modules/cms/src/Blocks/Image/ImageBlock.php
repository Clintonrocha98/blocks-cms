<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Image;

use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\Contracts\BlockDefinition;

class ImageBlock implements BlockDefinition
{
    public static function type(): string
    {
        return 'image';
    }

    public static function label(): string
    {
        return 'Imagem';
    }

    public function schema(): array
    {
        return ImageSchema::schema();
    }

    public function fromModel(array $data): BlockData
    {
        return ImageData::fromArray($data);
    }

    public function view(string $variant): string
    {
        return 'cms::blocks.image.'.$variant;
    }
}
