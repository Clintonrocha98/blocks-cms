<?php
declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Hero;

use ClintonRocha\CMS\Contracts\BlockDefinition;
use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\Models\PageBlock;

final class HeroBlock implements BlockDefinition
{
    public static function type(): string
    {
        return 'hero';
    }

    public static function label(): string
    {
        return 'Hero';
    }

    public static function variants(): array
    {
        return [
            'center' => 'Centralizado',
            'split' => 'Texto + Imagem',
        ];
    }

    public static function schema(): array
    {
        return HeroSchema::schema();
    }

    public static function fromModel(PageBlock $block): BlockData
    {
        return HeroData::fromArray($block->data);
    }

    public static function view(BlockData $data): string
    {
        /** @var HeroData $data */
        return "cms::blocks.hero.{$data->variant}";
    }
}
