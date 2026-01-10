<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Logos;

use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\Contracts\BlockDefinition;

class LogosBlock implements BlockDefinition
{
    public function type(): string
    {
        return 'logos';
    }

    public function label(): string
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
        return 'cms::blocks.logos.'.$variant;
    }
}
