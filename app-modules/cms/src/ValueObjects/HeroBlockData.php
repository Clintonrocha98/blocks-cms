<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\ValueObjects;

use ClintonRocha\CMS\Contracts\BlockData;

final class HeroBlockData implements BlockData
{
    public function __construct(
        public string $title,
        public ?string $subtitle,
        public string $variant,
        public ?string $ctaLabel,
        public ?string $ctaUrl,
        public ?string $image,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'] ?? '',
            subtitle: $data['subtitle'] ?? null,
            variant: $data['variant'] ?? 'center',
            ctaLabel: $data['cta_label'] ?? null,
            ctaUrl: $data['cta_url'] ?? null,
            image: $data['image'] ?? null,
        );
    }

    public function view(): string
    {
        return 'blocks.hero.'.$this->variant;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'variant' => $this->variant,
            'cta_label' => $this->ctaLabel,
            'cta_url' => $this->ctaUrl,
            'image' => $this->image,
        ];
    }
}
