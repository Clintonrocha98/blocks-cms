<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Testimonials;

use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\Contracts\BlockDefinition;

class TestmonialBlock implements BlockDefinition
{
    public static function type(): string
    {
        return 'testimonials';
    }

    public static function label(): string
    {
        return 'Testimonials';
    }

    public function schema(): array
    {
        return TestimonialsSchema::schema();
    }

    public function fromModel(array $data): BlockData
    {
        return TestimonialsData::fromArray($data);
    }

    public function view(string $variant): string
    {
        return 'cms::blocks.testimonials.'.$variant;
    }
}
