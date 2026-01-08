<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Filament\Schemas;

use ClintonRocha\CMS\Enums\BlockType;

final class BlockSchemaResolver
{
    public static function resolve(BlockType $type): array
    {
        return match ($type) {
            BlockType::Hero => HeroBlockSchema::schema(),
            BlockType::Text => TextBlockSchema::schema(),
            BlockType::CTA => CtaBlockSchema::schema(),
            BlockType::Features => FeaturesBlockSchema::schema(),
            BlockType::Form => FormBlockSchema::schema(),
            BlockType::Testimonials => TestimonialsBlockSchema::schema(),
            BlockType::Logos => LogosBlockSchema::schema(),
            BlockType::Image => ImageBlockSchema::schema(),
            BlockType::Anchors => AnchorsBlockSchema::schema(),
            BlockType::Divider => DividerBlockSchema::schema(),
            BlockType::Footer => FooterBlockSchema::schema(),
        };
    }
}
