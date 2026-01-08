<?php

namespace ClintonRocha\CMS\ValueObjects;

use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\Contracts\BlockDefinition;
use ClintonRocha\CMS\Filament\Schemas\AnchorsBlockSchema;

class AnchorBlock implements BlockDefinition
{
    public static function type(): string
    {
        return 'anchors';
    }

    public static function variants(): array
    {
        return [
            'menu' => 'Menu horizontal',
            'list' => 'Lista',
            'buttons' => 'Botões',
        ];
    }

    public static function label(): string
    {
        return 'Âncoras';
    }

    public static function schema(): array
    {
        return AnchorsBlockSchema::schema();
    }

    public static function fromModel(array $data): BlockData
    {
        return AnchorsData::fromArray($data);
    }

    public static function view(BlockData $data): string
    {
        /** @var AnchorsData $data */
        return 'cms::blocks.anchors.'.$data->variant;
    }
}
