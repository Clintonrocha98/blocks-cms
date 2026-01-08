<?php
declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Hero;

use ClintonRocha\CMS\Contracts\BlockData;

final class HeroData implements BlockData
{
    private function __construct(
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
            $data['title'] ?? '',
            $data['subtitle'] ?? null,
            $data['variant'] ?? 'center',
            $data['cta_label'] ?? null,
            $data['cta_url'] ?? null,
            $data['image'] ?? null,
        );
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
