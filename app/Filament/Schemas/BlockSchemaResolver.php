<?php

namespace App\Filament\Schemas;

use App\Enums\BlockType;

final class BlockSchemaResolver
{
    public static function resolve(BlockType $type): array
    {
        return match ($type) {
            BlockType::Hero => HeroBlockSchema::schema(),
            BlockType::Text => TextBlockSchema::schema(),
            BlockType::CTA => CtaBlockSchema::schema(),
        };
    }
}
