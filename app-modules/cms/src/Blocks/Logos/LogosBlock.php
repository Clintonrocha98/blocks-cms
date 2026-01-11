<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Logos;

use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\Contracts\BlockDefinition;

class LogosBlock implements BlockDefinition
{
    public static function type(): string
    {
        return 'logos';
    }

    public static function label(): string
    {
        return 'Logos de Clientes';
    }

    public function schema(): array
    {
        return LogosSchema::schema();
    }

    public function fromModel(array $data): BlockData
    {
        return LogosData::fromArray($data);
    }

    public function view(string $variant): string
    {
        return config('cms.views.namespace', 'cms::blocks').'.logos.'.$variant;
    }
}
