<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Footer;

use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\Contracts\BlockDefinition;

class FooterBlock implements BlockDefinition
{
    public static function type(): string
    {
        return 'footer';
    }

    public static function label(): string
    {
        return 'Rodapé';
    }

    public function schema(): array
    {
        return FooterSchema::schema();
    }

    public function fromModel(array $data): BlockData
    {
        return FooterData::fromArray($data);
    }

    public function view(string $variant): string
    {
        return 'cms::blocks.footer.'.$variant;
    }
}
