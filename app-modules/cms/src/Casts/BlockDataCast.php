<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Casts;

use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\ValueObjects\AnchorsBlockData;
use ClintonRocha\CMS\ValueObjects\CtaBlockData;
use ClintonRocha\CMS\ValueObjects\DividerBlockData;
use ClintonRocha\CMS\ValueObjects\FeaturesBlockData;
use ClintonRocha\CMS\ValueObjects\FooterBlockData;
use ClintonRocha\CMS\ValueObjects\FormBlockData;
use ClintonRocha\CMS\ValueObjects\HeroBlockData;
use ClintonRocha\CMS\ValueObjects\ImageBlockData;
use ClintonRocha\CMS\ValueObjects\LogosBlockData;
use ClintonRocha\CMS\ValueObjects\TestimonialsBlockData;
use ClintonRocha\CMS\ValueObjects\TextBlockData;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class BlockDataCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): BlockData
    {
        $data = json_decode((string) $value, true) ?? [];

        return match ($model->type) {
            'hero' => HeroBlockData::fromArray($data),
            'text' => TextBlockData::fromArray($data),
            'cta' => CtaBlockData::fromArray($data),
            'form' => FormBlockData::fromArray($data),
            'features' => FeaturesBlockData::fromArray($data),
            'testimonials' => TestimonialsBlockData::fromArray($data),
            'logos' => LogosBlockData::fromArray($data),
            'image' => ImageBlockData::fromArray($data),
            'anchors' => AnchorsBlockData::fromArray($data),
            'divider' => DividerBlockData::fromArray($data),
            'footer' => FooterBlockData::fromArray($data),

        };
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return json_encode($value instanceof BlockData
            ? $value->toArray()
            : $value
        );
    }
}
